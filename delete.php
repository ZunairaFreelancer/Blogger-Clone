<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // In a real app, verify user permission here
    
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    if ($stmt->execute([$id])) {
        // Success
    } else {
        // Error handling could go here
    }
}

header("Location: index.php");
exit;
?>
