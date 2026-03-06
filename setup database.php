<?php
require_once 'db.php';

// Prepare query with search and filters
$query = "SELECT * FROM posts WHERE 1=1";
$params = [];

if (isset($_GET['search'])) {
    $search = '%' . $_GET['search'] . '%';
    $query .= " AND (title LIKE ? OR excerpt LIKE ?)";
    $params[] = $search;
    $params[] = $search;
}

if (isset($_GET['category'])) {
    $query .= " AND category = ?";
    $params[] = $_GET['category'];
}

$query .= " ORDER BY created_at DESC";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $posts = $stmt->fetchAll();

    // Get unique categories for sidebar/filter
    $catStmt = $pdo->query("SELECT DISTINCT category FROM posts ORDER BY category");
    $categories = $catStmt->fetchAll(PDO::FETCH_COLUMN);

} catch (PDOException $e) {
    // If table doesn't exist (Error 42S02), redirect to setup script automatically
    if ($e->getCode() == '42S02' || strpos($e->getMessage(), "doesn't exist") !== false) {
        header("Location: setup_database.php");
        exit;
    }
    // Re-throw if it's a different error
    throw $e;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blogger Clone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <a href="index.php" class="logo">🟠 BloggerClone</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="index.php?category=Technology">Tech</a>
                <a href="index.php?category=Travel">Travel</a>
                <a href="index.php?category=Lifestyle">Lifestyle</a>
                <a href="create.php" class="btn">Write Post</a>
            </div>
        </nav>
    </header>

    <div class="main-container">
        <div class="hero">
            <h1>Welcome to the Blog</h1>
            <form action="index.php" method="GET" class="search-bar">
                <input type="text" name="search" placeholder="Search articles..."
                    value="<?= isset($_GET['search']) ? e($_GET['search']) : '' ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="posts-grid">
            <?php foreach ($posts as $post): ?>
                <article class="post-card">
                    <div class="post-content">
                        <span class="post-category"><?= e($post['category']) ?></span>
                        <h2 class="post-title">
                            <a href="post.php?id=<?= $post['id'] ?>"><?= e($post['title']) ?></a>
                        </h2>
                        <p><?= e($post['excerpt']) ?></p>
                        <div class="post-meta">
                            <span>By <?= e($post['author_name']) ?></span>
                            <span><?= date('M d, Y', strtotime($post['created_at'])) ?></span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <?php if (count($posts) === 0): ?>
                <p style="text-align: center; grid-column: 1/-1;">No posts found.</p>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>