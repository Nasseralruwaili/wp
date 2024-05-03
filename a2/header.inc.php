<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Hikes Victoria</title>
</head>
<body>
<header>
  <h1>Hikes Victoria</h1>
  <nav>
    <div class="header-left">
        <img src="images/logo.png" alt="Logo" id="logo">
        <select onchange="navigateTo(this.value)">
            <option value="">Select an Option...</option>
            <option value="index.php">Home</option>
            <option value="hikes.php">Hikes</option>
            <option value="add.php">Add</option>
            <option value="gallery.php">Gallery</option>
        </select>
    </div>
    <div class="header-right">
        <input type="text" placeholder="Search...">
    </div>
  </nav>
</header>
