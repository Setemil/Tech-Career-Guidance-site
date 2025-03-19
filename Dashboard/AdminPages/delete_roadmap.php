<?php
session_start();
require_once '../../LoginPage/conn.php';

if (isset($_GET['id']) && isset($_GET['course_id'])) {
    $id = $_GET['id'];
    $course_id = $_GET['course_id'];

    $stmt = $conn->prepare("DELETE FROM course_roadmap WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_roadmap.php?course_id=" . $course_id);
    } else {
        echo "Error deleting entry.";
    }

    $stmt->close();
    $conn->close();
}
?>