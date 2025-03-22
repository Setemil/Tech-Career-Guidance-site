<?php
require_once '../../LoginPage/conn.php';

$course_id = $_POST['course_id'];
$course_name = trim($_POST['course_name']);
$difficulty_level = $_POST['difficulty_level'];
$description = trim($_POST['description']);
$learning_style = $_POST['learning_style'];
$career_path = $_POST['career_path'];

// Handle optional image
$imagePath = null;
if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../../uploads/';
    $fileName = basename($_FILES['course_image']['name']);
    $targetPath = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['course_image']['tmp_name'], $targetPath)) {
        $imagePath = 'uploads/' . $fileName;
    }
}

// Update course info
if ($imagePath) {
    $stmt = $conn->prepare("UPDATE courses SET course_name=?, course_image=?, difficulty_level=?, description=?, learning_style=?, career_path=? WHERE id=?");
    $stmt->bind_param("ssssssi", $course_name, $imagePath, $difficulty_level, $description, $learning_style, $career_path, $course_id);
} else {
    $stmt = $conn->prepare("UPDATE courses SET course_name=?, difficulty_level=?, description=?, learning_style=?, career_path=? WHERE id=?");
    $stmt->bind_param("sssssi", $course_name, $difficulty_level, $description, $learning_style, $career_path, $course_id);
}
$stmt->execute();
$stmt->close();

// Update interests
$conn->query("DELETE FROM course_interests WHERE course_id=$course_id");
if (!empty($_POST['interests'])) {
    foreach ($_POST['interests'] as $interest_id) {
        $conn->query("INSERT INTO course_interests (course_id, interest_id) VALUES ($course_id, $interest_id)");
    }
}

// Update languages
$conn->query("DELETE FROM course_languages WHERE course_id=$course_id");
if (!empty($_POST['languages'])) {
    foreach ($_POST['languages'] as $lang_id) {
        $conn->query("INSERT INTO course_languages (course_id, language_id) VALUES ($course_id, $lang_id)");
    }
}

header("Location: resources.php?success=Course Sucessfully updated");
exit();
?>