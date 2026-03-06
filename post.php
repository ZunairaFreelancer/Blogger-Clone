<?php
require_once 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found.");
}

// Handle Comment Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_content'])) {
    $c_author = $_POST['c_author'];
    $c_content = $_POST['comment_content'];

    if (!empty($c_author) && !empty($c_content)) {
        $cStmt = $pdo->prepare("INSERT INTO comments (post_id, author_name, content) VALUES (?, ?, ?)");
        $cStmt->execute([$id, $c_author, $c_content]);
        // Refresh to show new comment
        header("Location: post.php?id=$id");
        exit;
    }
}

// Fetch Comments
$commentsStmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
$commentsStmt->execute([$id]);
$comments = $commentsStmt->fetchAll();

// Fetch Related Posts
$relatedStmt = $pdo->prepare("SELECT * FROM posts WHERE category = ? AND id != ? LIMIT 3");
$relatedStmt->execute([$post['category'], $id]);
$relatedPosts = $relatedStmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($post['title']) ?> - BloggerClone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <a href="index.php" class="logo">🟠 BloggerClone</a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="create.php" class="btn">Write Post</a>
            </div>
        </nav>
    </header>

    <div class="main-container">
        <article class="post-detail">
            <header class="post-header">
                <span class="post-category" style="font-size: 1rem;"><?= e($post['category']) ?></span>
                <h1 style="font-size: 2.5rem; margin: 0.5rem 0;"><?= e($post['title']) ?></h1>
                <div class="post-meta" style="font-size: 1rem;">
                    <span>By <strong><?= e($post['author_name']) ?></strong></span>
                    <span>Published on <?= date('F d, Y', strtotime($post['created_at'])) ?></span>
                </div>

                <div class="actions">
                    <a href="edit.php?id=<?= $post['id'] ?>" class="btn" style="background: #333;">Edit Post</a>
                    <a href="delete.php?id=<?= $post['id'] ?>" class="btn" style="background: #d32f2f;"
                        onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                </div>
            </header>

            <div class="post-body">
                <?= nl2br($post['content']) ?>
            </div>
        </article>

        <!-- Related Posts -->
        <?php if (!empty($relatedPosts)): ?>
            <div style="margin-top: 3rem;">
                <h3>Related Posts</h3>
                <div class="posts-grid">
                    <?php foreach ($relatedPosts as $related): ?>
                        <div class="post-card">
                            <div class="post-content">
                                <h4><a href="post.php?id=<?= $related['id'] ?>"><?= e($related['title']) ?></a></h4>
                                <p style="font-size: 0.9rem;"><?= e($related['excerpt']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Comments Section -->
        <div class="comments-section" style="max-width: 800px; margin: 3rem auto;">
            <h3>Comments (<?= count($comments) ?>)</h3>

            <form action="" method="POST"
                style="background: #fff; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                <div class="form-group">
                    <input type="text" name="c_author" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <textarea name="comment_content" class="form-control" placeholder="Write a comment..."
                        style="min-height: 80px;" required></textarea>
                </div>
                <button type="submit" class="btn">Post Comment</button>
            </form>

            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <div class="comment-author"><?= e($comment['author_name']) ?> <span
                            style="font-weight: normal; font-size: 0.8rem; color: #888;">•
                            <?= date('M d, Y', strtotime($comment['created_at'])) ?></span></div>
                    <div class="comment-text"><?= nl2br(e($comment['content'])) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>

</html>