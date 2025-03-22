<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../LoginPage/conn.php'; // Adjust path

if (isset($_POST['course_id']) && isset($_SESSION['student_id'])) {
    $course_id = $_POST['course_id'];
    $student_id = $_SESSION['student_id'];

    // Prevent duplicate saves
    $check = mysqli_query($conn, "SELECT * FROM saved_courses WHERE student_id='$student_id' AND course_id='$course_id'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO saved_courses (student_id, course_id) VALUES ('$student_id', '$course_id')");
    }
    $_SESSION['message'] = "Course saved successfully!";
    header("Location: recommendations.php");
    exit();
    // Adjust if in a different folder
    exit();
} else {
    echo "Something went wrong. Session or Course ID missing.";
}
?>
