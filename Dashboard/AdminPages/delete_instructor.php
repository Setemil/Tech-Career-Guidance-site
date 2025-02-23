<?php
include '../../LoginPage/conn.php';

if (isset($_GET['instructor_id'])) {
    $instructor_id = $_GET['instructor_id'];

    // Delete instructor (will also remove related entries in instructor_courses due to ON DELETE CASCADE)
    $stmt = $conn->prepare("DELETE FROM instructors WHERE id = ?");
    $stmt->bind_param("i", $instructor_id);

    if ($stmt->execute()) {
        header("Location: instructors.php?success=Instructor deleted successfully");
        exit();
    } else {
        header("Location: instructors.php?error=Failed to delete instructor");
        exit();
    }

    $stmt->close();
} else {
    header("Location: instructors.php?error=Invalid request");
    exit();
}

$conn->close();
?>