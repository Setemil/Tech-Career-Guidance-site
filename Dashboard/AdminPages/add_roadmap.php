<?php
include '../../LoginPage/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $topic = $_POST['topic'];
    $description = $_POST['description'];
    $resource_links = $_POST['resource_links'];

    $stmt = $conn->prepare("INSERT INTO course_roadmap (course_id, topic, description, resource_links) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $course_id, $topic, $description, $resource_links);
    
    if ($stmt->execute()) {
        header("Location: manage_roadmap.php?course_id=" . $course_id);
    } else {
        echo "Error adding entry.";
    }

    $stmt->close();
    $conn->close();
}
?>