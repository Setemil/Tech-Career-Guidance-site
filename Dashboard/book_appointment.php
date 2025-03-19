<?php
session_start();
require_once '../LoginPage/conn.php';


// Retrieve student ID from session
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT student_id FROM student WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
    $student_id = $student['student_id'];
} else {
    session_destroy();
    header("Location: ../LoginPage/index.php?error=" . urlencode("Session expired. Please log in again."));
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $instructor_id = $_POST['instructor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Prevent duplicate appointments
    $check_stmt = $conn->prepare("SELECT * FROM appointments WHERE student_id = ? AND appointment_date = ? AND appointment_time = ?");
    $check_stmt->bind_param("iss", $student_id, $appointment_date, $appointment_time);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_stmt->close();

    if ($check_result->num_rows > 0) {
        header("Location: appointments.php?error=" . urlencode("You already have an appointment at this time."));
        exit();
    }

    // Insert new appointment
    $stmt = $conn->prepare("INSERT INTO appointments (student_id, instructor_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $student_id, $instructor_id, $appointment_date, $appointment_time);

    if ($stmt->execute()) {
        header("Location: appointments.php?success=" . urlencode("Appointment booked successfully!"));
    } else {
        header("Location: appointments.php?error=" . urlencode("Error booking appointment. Please try again."));
    }

    $stmt->close();
}

$conn->close();
?>
