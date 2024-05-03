<?php
include('inc/db_connect.inc.php');

$message = ''; // Initialize a message variable to give feedback to the user.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO hikes (hikename, description, image, caption, distance, location, level) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdss", $hikename, $description, $imageName, $imageCaption, $distance, $location, $level);

    // Sanitize the input to prevent SQL Injection and XSS Attacks
    $hikename = htmlspecialchars($_POST['hikeName']);
    $description = htmlspecialchars($_POST['description']);
    $imageCaption = htmlspecialchars($_POST['imageCaption']);
    $distance = (float)$_POST['distance'];
    $location = htmlspecialchars($_POST['location']);
    $level = htmlspecialchars($_POST['level']);

    // Handle file upload
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        move_uploaded_file($tmp_name, "path/to/your/images/$imageName");
    } else {
        $imageName = ''; // Default if no image is uploaded
    }

    if ($stmt->execute()) {
        $message = "<p>Hike added successfully!</p>";
    } else {
        $message = "<p>Error adding hike: " . $conn->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Hike</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d4f7e2;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        main {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 600px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: calc(100% - 22px);
        }
        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            color: white;
            background-color: rgb(9, 46, 48);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: rgb(11, 59, 61);
        }
    </style>
</head>
<body>
<?php include('inc/nav.inc.php'); // Include navigation bar ?>
<main>
    <h1>Add a Hike</h1>
    <?php if (!empty($message)) echo $message; // Display message to the user ?>
    <form id="addForm" method="post" enctype="multipart/form-data">
        
    </form>
    <!-- Go back link -->
    <a href="index.php">Go Back to Home</a>
</main>

<main>
    <h1>Add a Hike</h1>
    <?php if (!empty($message)) echo $message; // Display message to the user ?>
    <form id="addForm" method="post" enctype="multipart/form-data">
        <!-- Your form inputs -->
        <label for="hikeName">Hike Name:</label>
        <input type="text" id="hikeName" name="hikeName" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <label for="imageCaption">Image Caption:</label>
        <input type="text" id="imageCaption" name="imageCaption" required>

        <label for="distance">Distance (km):</label>
        <input type="number" id="distance" name="distance" step="0.1" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="level">Level:</label>
        <select id="level" name="level" required>
            <option value="Easy">Easy</option>
            <option value="Moderate">Moderate</option>
            <option value="Difficult">Difficult</option>
        </select>

        <input type="submit" value="Submit">
        <input type="reset" value="Clear">
    </form>
</main>

<?php include('inc/footer.inc.php'); ?>
</body>
</html>