<?php
require 'includes/db.php';
session_start();

if (isset($_GET['id'])) {
    $hikeid = $_GET['id'];

    $sql = 'SELECT * FROM hikes WHERE hikeid = :hikeid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['hikeid' => $hikeid]);
    $hike = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$hike) {
        echo "Hike not found!";
        exit();
    }
} else {
    header('Location: hikes.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hike Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h1>Hike Details</h1>
        <div>
            <img src="images/<?php echo htmlspecialchars($hike['image']); ?>" alt="<?php echo htmlspecialchars($hike['caption']); ?>" class="img-fluid">
            <h2><?php echo htmlspecialchars($hike['hikename']); ?></h2>
            <p><?php echo htmlspecialchars($hike['description']); ?></p>
            <ul>
                <li><strong>Caption:</strong> <?php echo htmlspecialchars($hike['caption']); ?></li>
                <li><strong>Distance:</strong> <?php echo htmlspecialchars($hike['distance']); ?> km</li>
                <li><strong>Location:</strong> <?php echo htmlspecialchars($hike['location']); ?></li>
                <li><strong>Level:</strong> <?php echo htmlspecialchars($hike['level']); ?></li>
            </ul>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="edit.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-primary">Edit</a>
                <a href="delete.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-danger">Delete</a>
            <?php endif; ?>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
