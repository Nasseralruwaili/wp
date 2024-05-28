<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hikeid = $_POST['hikeid'];
    $hikename = $_POST['hikename'];
    $description = $_POST['description'];
    $caption = $_POST['caption'];
    $distance = $_POST['distance'];
    $location = $_POST['location'];
    $level = $_POST['level'];

    $sql = 'UPDATE hikes SET hikename = :hikename, description = :description, caption = :caption, distance = :distance, location = :location, level = :level WHERE hikeid = :hikeid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'hikename' => $hikename,
        'description' => $description,
        'caption' => $caption,
        'distance' => $distance,
        'location' => $location,
        'level' => $level,
        'hikeid' => $hikeid
    ]);

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
    <title>Edit Hike</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h1>Edit Hike</h1>
        <form method="POST" action="">
            <input type="hidden" name="hikeid" value="<?php echo $hike['hikeid']; ?>">
            <div class="mb-3">
                <label for="hikename" class="form-label">Hike Name</label>
                <input type="text" class="form-control" id="hikename" name="hikename" value="<?php echo htmlspecialchars($hike['hikename']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($hike['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <input type="text" class="form-control" id="caption" name="caption" value="<?php echo htmlspecialchars($hike['caption']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="distance" class="form-label">Distance (km)</label>
                <input type="number" step="0.1" class="form-control" id="distance" name="distance" value="<?php echo htmlspecialchars($hike['distance']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($hike['location']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-control" id="level" name="level" required>
                    <option value="Easy" <?php echo $hike['level'] == 'Easy' ? 'selected' : ''; ?>>Easy</option>
                    <option value="Moderate" <?php echo $hike['level'] == 'Moderate' ? 'selected' : ''; ?>>Moderate</option>
                    <option value="Difficult" <?php echo $hike['level'] == 'Difficult' ? 'selected' : ''; ?>>Difficult</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Hike</button>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
