<?php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikes Victoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d4f7e2;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(9, 46, 48); 
            height: 100px; 
            padding: 0 20px;
        }

        .nav-left {
            display: flex;
            align-items: center;
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
            color: white; /* Adjust the color as needed */
            font-weight: bold;
        }

        .nav-left .nav-link:hover {
            color: #007bff; /* Adjust the hover color as needed */
        }

        .nav-right {
            display: flex;
            align-items: center;
        }

        .nav-right form {
            display: flex;
            align-items: center;
        }

        .nav-right input[type="text"] {
            padding: 5px;
        }

        .nav-right ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-right .nav-item {
            margin-left: 20px;
        }

        .nav-right .nav-link {
            text-decoration: none;
            color: white; /* Adjust the color as needed */
            font-weight: bold;
        }

        .nav-right .nav-link:hover {
            color: #007bff; /* Adjust the hover color as needed */
        }

        main {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            flex: 1;
        }

        .content {
            flex: 1;
            text-align: left;
        }

        .header {
            text-align: left;
        }

        .header h1 {
            font-size: 88px;
            font-weight: bold;
            color: #4388d1;
            margin: 50;
            margin-bottom: 20px; 
        }

        .header h2 {
            font-size: 66px;
            font-style: italic;
            color: #007bff;
            margin: 0;
        }

        .subtitle {
            font-size: 24px;
            font-weight: bold;
            margin-top: 50px;
        }

        .body-text {
            font-size: 18px;
            margin-top: 20px;
        }

        .image-container {
            position: relative;
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .image-container img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
        }

        .image-selector {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .arrow {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            font-size: 20px;
        }

        .arrow:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #b8d0b8;
            color: #333; 
        }
    </style>
</head>
<body>

<nav>
    <div class="nav-left">
        <img src="images/logo.png" alt="Logo" id="logo" style="width: 50px; height: auto;">
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
        <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Log In</a></li>
        </ul>
    </div>
</nav>

<main>
    <div class="content">
        <div class="header">
            <h1>Hikes Victoria</h1>
            <h2>Welcome to Victoria</h2>
        </div>
        <div class="subtitle">Discover Victoria your own way!</div>
        <div class="body-text">
            Nestled in the vibrant landscape of Victoria, Australia, hiking enthusiasts can discover a realm of diverse terrains and breathtaking vistas from the rugged coastline of the Great Ocean Road to the majestic peaks of the Grampians National Park. Victoria offers a mosaic of trails that cater to adventurers of all skill levels. Hikers can traverse through lush rainforests in the Otways, where the air is fresh and the sound of cascading waterfalls accompanies the rustle of ferns and towering eucalyptus trees. Each step reveals the state's natural splendor, whether it's the wildflowers blooming in the Alpine National Park or the dramatic rock formations dotting the landscape of the Mornington Peninsula. Are you ready to explore?
        </div>
    </div>
    <div class="image-container">
        <img id="mainImage" src="images/apostles.jpg" alt="Apostles">
        <div class="image-selector">
            <button class="arrow" onclick="changeImage('images/prom.jpg')">&lt;</button>
            <button class="arrow" onclick="changeImage('images/werribee.jpg')">&gt;</button>
        </div>
    </div>
</main>

<footer>
   © Copyright 2024, Nasser Nahar D. Alruwaili. All Rights Reserved | Designed for Hikes Victoria
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const images = ['images/apostles.jpg', 'images/image2.jpg', 'images/image3.jpg'];
    let currentIndex = 0;

    function changeImage(direction) {
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % images.length;
        } else if (direction === 'prev') {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
        }
        document.getElementById('mainImage').src = images[currentIndex];
    }
</script>
</body>
</html>
