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

        .nav-left select {
            width: 210px;
            height: 30px;
            font-size: 14px;
            background-color: white;
            color: black;
        }

        .nav-left select:hover {
            background-color: #0056b3;
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
    <script src="js/scripts.js"></script>
</head>
<body>

<nav>
    <div class="nav-left">
        <img src="images/logo.png" alt="logo" id="logo">
        <select onchange="navigateTo(this.value)">
            <option value="">Select an Option...</option>
            <option value="index.php">Home</option>
            <option value="hikes.php">Hikes</option>
            <option value="add.php">Add more</option>
            <option value="gallery.php">Gallery</option>
        </select>
    </div>
    <div class="nav-right">
        <form>
            <input type="text" placeholder="Search...">
        </form>
    </div>
</nav>

<main>
    <h1>Add a Hike</h1>
    <p>YOU CAN ADD A NEW HIKE HERE</p>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form id="addForm" method="POST" action="add.php" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="hikeName">HIKE NAME: *</label>
        <input type="text" id="hikeName" name="hikeName" required>

        <label for="description">DESCRIPTION: *</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="image">SELECT AN IMAGE: *</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <label for="imageCaption">IMAGE CAPTION: *</label>
        <input type="text" id="imageCaption" name="imageCaption" required>

        <label for="distance">DISTANCE: *</label>
        <input type="number" id="distance" name="distance" required>

        <label for="location">LOCATION: *</label>
        <input type="text" id="location" name="location" required>

        <label for="level">LEVEL: *</label>
        <select id="level" name="level" required>
            <option value="">-Choose an option-</option>
            <option value="Easy">Easy</option>
            <option value="Moderate">Moderate</option>
            <option value="Difficult">Difficult</option>
        </select>

        <input type="submit" value="Submit">
        <input type="reset" value="Clear">
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

        if (!hikeName || !description || !image || !imageCaption || !distance || !location || !level) {
            alert("All fields are required!");
            return false;
        }

        return true; // Return true if the form is valid, false otherwise
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
