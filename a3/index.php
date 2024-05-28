<?php
require 'includes/db.php';

$sql = 'SELECT * FROM hikes ORDER BY hikeid DESC LIMIT 4';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        }

        .header {
            text-align: left;
        }

        .header h1 {
            font-size: 88px;
            font-weight: bold;
            color: #4388d1;
            margin: 50;
            margin-bottom: 100px; 
        }

        .header h2 {
            font-size: 66px;
            font-style: italic;
            color: #007bff;
            margin: 0;
        }

        .image-container {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .image-container img {
            width: 200px;
            height: 200px;
            border-radius: 50%; 
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #b8d0b8;
            color: #333; 
        }

        .carousel-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<nav>
    <select onchange="navigateTo(this.value)">
        <option value="">Select an Option...</option>
        <option value="index.php">Home</option>
        <option value="hikes.php">Hikes</option>
        <option value="add.php">Add more</option>
        <option value="gallery.php">Gallery</option>
    </select>
    <img src="images/logo.png" alt="Logo" id="logo">
    <form>
        <input type="text" placeholder="Search...">
    </form>
</nav>

<main>
    <div class="content">
        <div class="header">
            <h1>Hikes Victoria</h1>
            <h2>Welcome to Victoria</h2>
        </div>
    </div>
    <div class="image-container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($hikes as $index => $hike): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($hikes as $index => $hike): ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="images/<?php echo htmlspecialchars($hike['image']); ?>" alt="<?php echo htmlspecialchars($hike['caption']); ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo htmlspecialchars($hike['hikename']); ?></h5>
                            <p><?php echo htmlspecialchars($hike['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</main>

<footer>
   © Copyright 2024, Nasser Nahar D. Alruwaili. All Rights Reserved | Designed for Hikes Victoria
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
