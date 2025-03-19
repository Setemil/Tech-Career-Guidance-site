<?php
session_start();
require_once '../../LoginPage/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $instructor_id = intval($_POST['instructor_id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $courses = isset($_POST['courses']) ? $_POST['courses'] : [];

    // Update instructor details
    $sql = "UPDATE instructors SET name = ?, email = ?, phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $phone, $instructor_id);
    $stmt->execute();
    $stmt->close();

    // Remove old course assignments
    $delete_courses_sql = "DELETE FROM instructor_courses WHERE instructor_id = ?";
    $stmt = $conn->prepare($delete_courses_sql);
    $stmt->bind_param("i", $instructor_id);
    $stmt->execute();
    $stmt->close();

    // Insert new course assignments
    if (!empty($courses)) {
        $insert_sql = "INSERT INTO instructor_courses (instructor_id, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        foreach ($courses as $course_id) {
            $stmt->bind_param("ii", $instructor_id, $course_id);
            $stmt->execute();
        }
        $stmt->close();
    }

    $conn->close();
    header("Location: instructors.php?success=Instructor updated successfully");
    exit();
} else {
    header("Location: instructors.php?error=Invalid request");
    exit();
}
?>