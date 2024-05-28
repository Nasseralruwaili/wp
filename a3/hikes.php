<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hikename = $_POST['hikeName'];
    $description = $_POST['description'];
    $caption = $_POST['imageCaption'];
    $distance = $_POST['distance'];
    $location = $_POST['location'];
    $level = $_POST['level'];
    $username = $_SESSION['username'];

    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    $sql = 'INSERT INTO hikes (hikename, description, image, caption, distance, location, level, username) 
            VALUES (:hikename, :description, :image, :caption, :distance, :location, :level, :username)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'hikename' => $hikename,
        'description' => $description,
        'image' => $image,
        'caption' => $caption,
        'distance' => $distance,
        'location' => $location,
        'level' => $level,
        'username' => $username
    ]);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        header('Location: hikes.php');
    } else {
        $error = "Failed to upload image";
    }
}

$sql = 'SELECT * FROM hikes WHERE username = :username';
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $_SESSION['username']]);
$hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Victoria your own way!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Castoro+Titling&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .castoro-titling-regular {
            font-family: "Castoro Titling", serif;
            font-weight: 400;
            font-style: normal;
        }

        body {
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: rgb(9, 46, 48);
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        #logo {
            width: 50px;
            height: auto;
            margin-right: 12px;
            margin-left: 12px;
        }

        .nav-left ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-left .nav-item {
            margin-left: 20px;
        }

        .nav-left .nav-link {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .nav-left .nav-link:hover {
            color: #007bff;
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-right input[type="text"] {
            width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        main {
            max-width: 800px;
            width: 100%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .hike {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .hike-details {
            flex: 1;
        }

        .hike-actions {
            display: flex;
            gap: 10px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #b8d0b8;
            color: #333;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-left">
        <img src="images/logo.png" alt="logo" id="logo">
        <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="hikes.php">Hikes</a></li>
            <li class="nav-item"><a class="nav-link" href="add.php">Add More</a></li>
            <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
        </ul>
    </div>
    <div class="nav-right">
        <form>
            <input type="text" placeholder="Search...">
        </form>
    </div>
</nav>

<main>
    <h1>Your Hikes</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php foreach ($hikes as $hike): ?>
        <div class="hike">
            <div class="hike-details">
                <h2><?php echo htmlspecialchars($hike['hikename']); ?></h2>
                <p><?php echo htmlspecialchars($hike['description']); ?></p>
            </div>
            <div class="hike-actions">
                <a href="edit.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-primary">Edit</a>
                <a href="delete.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<footer>
    <p>© COPYRIGHT Nasser nahar d, Alruwaili. ALL RIGHTS RESERVED | DESIGNED FOR HIKE</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
