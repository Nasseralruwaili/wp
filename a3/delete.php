<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hikeid = $_POST['hikeid'];

    $sql = 'DELETE FROM hikes WHERE hikeid = :hikeid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['hikeid' => $hikeid]);

    header('Location: hikes.php');
}

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
    <title>Delete Hike</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h1>Delete Hike</h1>
        <p>Are you sure you want to delete this hike?</p>
        <form method="POST" action="">
            <input type="hidden" name="hikeid" value="<?php echo $hike['hikeid']; ?>">
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="hikes.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
