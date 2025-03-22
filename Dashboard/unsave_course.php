<?php
session_start();
include '../LoginPage/conn.php'; // Adjust path

if (isset($_POST['course_id']) && isset($_SESSION['student_id'])) {
    $course_id = $_POST['course_id'];
    $student_id = $_SESSION['student_id'];

    $delete = mysqli_query($conn, "DELETE FROM saved_courses WHERE student_id='$student_id' AND course_id='$course_id'");
    
    if ($delete) {
        $_SESSION['message'] = "Course unsaved successfully!";
    } else {
        $_SESSION['message'] = "Failed to unsave course.";
    }

    header("Location: recommendations.php");
    exit();
} else {
    echo "Something went wrong.";
}
?>
