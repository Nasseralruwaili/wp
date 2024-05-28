<?php
require 'includes/db.php';
session_start();

$sql = 'SELECT * FROM hikes';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(9, 46, 48);
            height: 100px;
            padding: 0 20px;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-right: 1002px;
            margin-left: 0px; 
        }
        .search {
            margin-right: 10px;
            order: 3; 
        }

        .select-options {
            margin-left: 30px;
            order: 1; 
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f9f6; 
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .gallery-item {
            width: 30%;
            margin-bottom: 20px;
            text-align: center;
        }

        .gallery-item img {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .description {
            font-size: 14px;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            padding: 30px;
            background-color: #b8d0b8;
            color: #333;
            width: 150%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <nav>
        <div class="select-options">
            <button>Select Options</button>
        </div>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <div class="search">
            <input type="text" placeholder="Search...">
        </div>
    </nav>

    <div class="gallery">
        <?php foreach ($hikes as $hike): ?>
            <div class="gallery-item">
                <img src="images/<?php echo htmlspecialchars($hike['image']); ?>" alt="<?php echo htmlspecialchars($hike['caption']); ?>">
                <div class="description"><?php echo htmlspecialchars($hike['description']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer>
        © COPYRIGHT Nasser nahar d, Alruwaili. ALL RIGHTS RESERVED | DESIGNED FOR HIKE
    </footer>
</body>
</html>
