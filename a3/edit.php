<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $hikeid = $_GET['id'];

    $sql = 'SELECT * FROM hikes WHERE hikeid = :hikeid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['hikeid' => $hikeid]);
    $hike = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$hike) {
        echo "Hike not found!";
        exit();
    }
} else {
    header('Location: hikes.php');
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

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $hike['image'];
    }

    $sql = 'UPDATE hikes SET hikename = :hikename, description = :description, image = :image, caption = :caption, distance = :distance, location = :location, level = :level, username = :username WHERE hikeid = :hikeid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'hikename' => $hikename,
        'description' => $description,
        'image' => $image,
        'caption' => $caption,
        'distance' => $distance,
        'location' => $location,
        'level' => $level,
        'username' => $username,
        'hikeid' => $hikeid
    ]);

    header('Location: hikes.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hike</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
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
            max-width: 600px;
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #0056b3;
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
            <li class="nav-item"><a class="nav-link" href="edit.php">Edit Hike</a></li>
            <li class="nav-item"><a class="nav-link" href="delete.php">Delete Hike</a></li>
        </ul>
    </div>
    <div class="nav-right">
        <form>
            <input type="text" placeholder="Search...">
        </form>
    </div>
</nav>

<main>
    <h1>Edit Hike</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form id="editForm" method="POST" action="edit.php?id=<?php echo $hikeid; ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="hikeName">HIKE NAME: *</label>
        <input type="text" id="hikeName" name="hikeName" value="<?php echo htmlspecialchars($hike['hikename']); ?>" required>

        <label for="description">DESCRIPTION: *</label>
        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($hike['description']); ?></textarea>

        <label for="image">SELECT AN IMAGE: *</label>
        <input type="file" id="image" name="image" accept="image/*">

        <label for="imageCaption">IMAGE CAPTION: *</label>
        <input type="text" id="imageCaption" name="imageCaption" value="<?php echo htmlspecialchars($hike['caption']); ?>" required>

        <label for="distance">DISTANCE: *</label>
        <input type="number" id="distance" name="distance" value="<?php echo htmlspecialchars($hike['distance']); ?>" required>

        <label for="location">LOCATION: *</label>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($hike['location']); ?>" required>

        <label for="level">LEVEL: *</label>
        <select id="level" name="level" required>
            <option value="Easy" <?php if ($hike['level'] == 'Easy') echo 'selected'; ?>>Easy</option>
            <option value="Moderate" <?php if ($hike['level'] == 'Moderate') echo 'selected'; ?>>Moderate</option>
            <option value="Difficult" <?php if ($hike['level'] == 'Difficult') echo 'selected'; ?>>Difficult</option>
        </select>

        <input type="submit" value="Update">
    </form>
</main>

<footer>
    <p>© COPYRIGHT Nasser nahar d, Alruwaili. ALL RIGHTS RESERVED | DESIGNED FOR HIKE</p>
</footer>

<script>
    function validateForm() {
        var hikeName = document.getElementById("hikeName").value;
        var description = document.getElementById("description").value;
        var image = document.getElementById("image").value;
        var imageCaption = document.getElementById("imageCaption").value;
        var distance = document.getElementById("distance").value;
        var location = document.getElementById("location").value;
        var level = document.getElementById("level").value;

        if (!hikeName || !description || !imageCaption || !distance || !location || !level) {
            alert("All fields except image are required!");
            return false;
        }

        return true; // Return true if the form is valid, false otherwise
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
