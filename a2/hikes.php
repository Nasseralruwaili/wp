<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Hikes</title>
    <style>
        .castoro-titling-regular {
            font-family: "Castoro Titling", serif;
            font-weight: 400;
            font-style: normal;
        }
        .word-spacing {
            letter-spacing: 0.2em; 
            word-spacing: 0.5em; 
        }
        .stretch-paragraph {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: rgb(9, 46, 48);
            color: white;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left {
            display: flex;
            align-items: center;
        }
        .header-left img {
            width: 50px;
            margin-right: 10px;
        }
        .header-right {
            flex: 1;
            text-align: right;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #b8d0b8;
            color: #333;
            width: 100%;
            box-sizing: border-box;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }
        main table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            background-color: rgb(9, 46, 48);
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <div class="header-left">
        <img src="images/logo.png" alt="Logo">
       
    </div>
    <div class="header-right">
        <input type="text" placeholder="Search...">
    </div>
</header>

<main>
< <h2 class="word-spacing castoro-titling-regular">Discover Victoria your own way!</h2>
    
    <p class="stretch-paragraph">Text: Nestled in the vibrant landscape of Victoria, Australia, hiking enthusiasts can discover a realm of diverse terrains and breathtaking vistas. From the rugged coastline of The Great Ocean Walk to the majestic peaks of The Grampians National Park, Victoria offers a mosaic of trails that cater to adventurers of all skill levels. Hikers can traverse through lush rainforests in The Otways, where the air is fresh and the sound of cascading waterfalls accompanies the rustle of ferns and towering eucalyptus trees. Each step reveals the state’s natural splendor, whether it’s wildflowers blooming in The Alpine National Park or dramatic rock formations dotting landscape on Mornington Peninsula.</p>

    
    <h1 class="word-spacing castoro-titling-regular">List of Hikes</h1>
    <?php
    include 'inc/db_connect.inc.php';
    $sql = "SELECT hikeid, hikename, distance, location, level FROM hikes";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Hike Name</th><th>Distance (KMs)</th><th>Location</th><th>Level</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><a href='details.php?id=" . $row['hikeid'] . "'>" . $row['hikename'] . "</a></td>";
            echo "<td>" . $row['distance'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['level'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    ?>
    
    <a href="index.php" class="back-button">Back to Home</a>
</main>

<footer>
Copyright 2024, Nasser Nahar D. Alruwaili. All Rights Reserved | Designed for Hikes Victoria
</footer>
</body>
</html>
