<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gallery</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('inc/header.inc'); ?>

    <div class="gallery">
        <?php
        include('inc/db_connect.inc');
        $sql = "SELECT image_path, description FROM gallery_items"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="gallery-item">';
                echo '<img src="images/' . $row["image_path"] . '" alt="Image Description">';
                echo '<div class="description">' . $row["description"] . '</div>';
                echo '</div>';
            }
        } else {
            echo '<div>No images found</div>';
        }
        $conn->close();
        ?>
    </div>

    <?php include('inc/footer.inc'); ?>
</body>
</html>
