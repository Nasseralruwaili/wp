<?php
require 'includes/db.php';

$searchResults = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['query'])) {
    $query = '%' . $_GET['query'] . '%';
    $sql = 'SELECT * FROM hikes WHERE hikename LIKE :query OR description LIKE :query OR level LIKE :query';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['query' => $query]);
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Hikes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h1>Search Hikes</h1>
        <form method="GET" action="">
            <div class="mb-3">
                <input type="text" class="form-control" name="query" placeholder="Search hikes..." required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <?php if (!empty($searchResults)): ?>
            <h2>Search Results</h2>
            <ul>
                <?php foreach ($searchResults as $hike): ?>
                    <li>
                        <a href="details.php?id=<?php echo $hike['hikeid']; ?>"><?php echo htmlspecialchars($hike['hikename']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'GET'): ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
