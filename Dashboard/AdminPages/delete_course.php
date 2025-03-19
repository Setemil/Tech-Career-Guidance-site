<?php
session_start();
require_once '../../LoginPage/conn.php';

if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    // Prepare and execute the deletion query
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);

    if ($stmt->execute()) {
        // Redirect back to resource.php with success message
        header("Location: resources.php?success=Course deleted successfully");
        exit();
    } else {
        // Redirect with an error message
        header("Location: resources.php?error=Failed to delete course");
        exit();
    }

    $stmt->close();
} else {
    // Redirect if no course ID is provided
    header("Location: resources.php?error=Invalid request");
    exit();
}

$conn->close();
?>