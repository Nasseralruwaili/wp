<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover Victoria your own way!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('inc/header.inc'); ?>

<main>
    <h1 class="word-spacing castoro-titling-regular">Discover Victoria your own way!</h1>
    <p class="word-spacing castoro-titling-regular stretch-paragraph">NESTLED IN THE VIBRANT LANDSCAPE OF VICTORIA, AUSTRALIA, HIKING ENTHUSIASTS CAN DISCOVER A REALM OF DIVERSE TERRAINS AND BREATHTAKING VISTAS...</p>
       
    <div class="content">
        <img src="images/falls.jpg" alt="Main Image" id="mainImage">
        <table class="trail-info">
            <tr>
                <th>Trail Name</th>
                <th>Distance</th>
                <th>Difficulty</th>
                <th>Starting Point</th>
            </tr>
            <?php
            include('inc/db_connect.inc');
            $sql = "SELECT hikename, distance, level, location FROM hikes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . htmlspecialchars($row["hikename"]) . "</td><td>" . htmlspecialchars($row["distance"]) . " km</td><td>" . htmlspecialchars($row["level"]) . "</td><td>" . htmlspecialchars($row["location"]) . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hikes found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</main>

<?php include('inc/footer.inc'); ?>

</body>
</html>
