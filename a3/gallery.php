<?php
session_start();

// Function to get all image files from the images directory, excluding the logo
function getImages($directory) {
    $images = array();
    if (is_dir($directory)) {
        if ($dir = opendir($directory)) {
            while (($file = readdir($dir)) !== false) {
                if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), array('jpg', 'jpeg', 'png', 'gif')) && $file != 'logo.png') {
                    $images[] = $file;
                }
            }
            closedir($dir);
        }
    }
    return $images;
}

$images = getImages('images');
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

        .nav-right input[type="text"] {
            width: 200px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            margin: 10px;
            text-align: center;
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
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
            width: 100%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-left">
            <img src="images/logo.png" alt="Logo" class="logo">
            <ul class="navbar-nav d-flex flex-row">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="hikes.php">Hikes</a></li>
                <li class="nav-item"><a class="nav-link" href="add.php">Add More</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
            </ul>
        </div>
        <div class="nav-right">
            <input type="text" placeholder="Search...">
        </div>
    </nav>

    <div class="gallery">
        <?php foreach ($images as $image): ?>
            <div class="gallery-item">
                <img src="images/<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars(pathinfo($image, PATHINFO_FILENAME)); ?>">
                <div class="description"><?php echo htmlspecialchars(pathinfo($image, PATHINFO_FILENAME)); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer>
        © COPYRIGHT Nasser nahar d, Alruwaili. ALL RIGHTS RESERVED | DESIGNED FOR HIKE
    </footer>
</body>
</html>
