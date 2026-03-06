<?php
require_once 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $excerpt = substr(strip_tags($content), 0, 150) . '...';
    $slug = createSlug($title);

    if (empty($title) || empty($content) || empty($author)) {
        $message = '<div class="alert alert-error">Please fill in all required fields.</div>';
    } else {
        $sql = "INSERT INTO posts (title, slug, excerpt, content, author_name, category) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$title, $slug, $excerpt, $content, $author, $category])) {
            header("Location: index.php");
            exit;
        } else {
            $message = '<div class="alert alert-error">Error saving post.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post - BloggerClone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <a href="index.php" class="logo">🟠 BloggerClone</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
            </div>
        </nav>
    </header>

    <div class="main-container">
        <h1>Create New Post</h1>

        <?= $message ?>

        <form action="create.php" method="POST"
            style="max-width: 800px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="form-group" style="display: flex; gap: 1rem;">
                <div style="flex: 1;">
                    <label for="author">Author Name</label>
                    <input type="text" id="author" name="author" class="form-control" required>
                </div>
                <div style="flex: 1;">
                    <label for="category">Category</label>
                    <select id="category" name="category" class="form-control">
                        <option value="Technology">Technology</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Business">Business</option>
                        <option value="Travel">Travel</option>
                        <option value="Food">Food</option>
                        <option value="General">General</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn">Publish Post</button>
            <a href="index.php" style="margin-left: 1rem; color: #666; text-decoration: none;">Cancel</a>
        </form>
    </div>

</body>

</html>
