<?php
include('inc/db_connect.inc');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO hikes (hikename, description, image, caption, distance, location, level) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdss", $hikename, $description, $imageName, $imageCaption, $distance, $location, $level);

    $hikename = $_POST['hikeName'];
    $description = $_POST['description'];
    $imageName = $_FILES['image']['name']; 
    $imageCaption = $_POST['imageCaption'];
    $distance = $_POST['distance'];
    $location = $_POST['location'];
    $level = $_POST['level'];

    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "<p>Hike added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Hike</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="main.js"></script>
</head>
<body>
<?php include('inc/nav.inc'); ?>

<main>
    <h1>Add a Hike</h1>
    <form id="addForm" method="post" enctype="multipart/form-data">
        <label for="hikeName">Hike Name:</label>
        <input type="text" id="hikeName" name="hikeName" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <label for="imageCaption">Image Caption:</label>
        <input type="text" id="imageCaption" name="imageCaption" required><br>

        <label for="distance">Distance (km):</label>
        <input type="number" id="distance" name="distance" step="0.1" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="level">Level:</label>
        <select id="level" name="level" required>
            <option value="Easy">Easy</option>
            <option value="Moderate">Moderate</option>
            <option value="Difficult">Difficult</option>
        </select><br>

        <input type="submit" value="Submit">
        <input type="reset" value="Clear">
    </form>
</main>

<?php include('inc/footer.inc'); ?>
</body>
</html>
