<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];

$sql = 'SELECT * FROM hikes WHERE username = :username';
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username]);
$hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Hikes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h1>My Hikes</h1>
        <?php if (empty($hikes)): ?>
            <p>You haven't uploaded any hikes yet.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Hike Name</th>
                        <th>Description</th>
                        <th>Distance (km)</th>
                        <th>Location</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hikes as $hike): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($hike['hikename']); ?></td>
                            <td><?php echo htmlspecialchars($hike['description']); ?></td>
                            <td><?php echo htmlspecialchars($hike['distance']); ?></td>
                            <td><?php echo htmlspecialchars($hike['location']); ?></td>
                            <td><?php echo htmlspecialchars($hike['level']); ?></td>
                            <td>
                                <a href="details.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-info btn-sm">View</a>
                                <a href="edit.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $hike['hikeid']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
