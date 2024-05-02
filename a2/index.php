<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikes Victoria</title>
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
    </style>
</head>
<body>
    <?php include('inc/nav.inc'); ?>

    <main>
        <div class="content">
            <div class="header">
                <h1>Hikes Victoria</h1>
                <h2>Welcome to Victoria</h2>
            </div>
        </div>
        <div class="image-container">
            <img src="images/apostles.jpg" alt="Main Image" id="mainImage">
        </div>
    </main>

    <?php include('inc/footer.inc'); ?>
</body>
</html>
