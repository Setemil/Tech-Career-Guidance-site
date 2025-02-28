<?php
session_start();
require_once '../../LoginPage/conn.php'; // Database connection

// Ensure admin is logged in
if (!isset($_SESSION['name'])) {
    header("Location: ../../LoginPage/index.php");
    exit();
}

// Check if news ID is provided
if (isset($_POST['id'])) {
    $news_id = intval($_POST['id']);
    
    // Retrieve the news update to get the image path
    $stmt = $conn->prepare("SELECT image_path FROM news_updates WHERE id = ?");
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $news = $result->fetch_assoc();
    $stmt->close();
    
    if ($news) {
        // Delete the image file if it exists
        $image_path = __DIR__ . '/../../' . $news['image_path'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        
        // Delete the news update from the database
        $deleteStmt = $conn->prepare("DELETE FROM news_updates WHERE id = ?");
        $deleteStmt->bind_param("i", $news_id);
        if ($deleteStmt->execute()) {
            header("Location: updates.php?success=1");
            exit();
        } else {
            header("Location: updates.php?error=1");
            exit();
        }
    } else {
        header("Location: updates.php?error=1");
        exit();
    }
} else {
    header("Location: updates.php?error=1");
    exit();
}
?>