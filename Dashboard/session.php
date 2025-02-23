<?php
session_start();
require_once '../LoginPage/conn.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: ../LoginPage/index.php");
    exit();
}

// Retrieve the logged-in student's name
$username = $_SESSION['name'];

$stmt = $conn->prepare("SELECT name FROM student WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user details
if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
} else {
    // If no matching user is found, force logout
    session_destroy();
    header("Location: ../LoginPageindex.php?error=" . urlencode("Session expired. Please log in again."));
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Careers Portal - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        .header{
            background-color: #6a679e;
        }
        .cta-button{
            background-color: #a7a3f0;
        }
        .cta-button:hover{
            background-color: #6a679e;
        }
    </style>
 
</head>
<body>
    <?php include 'menu-bar.php'?>
        
</body>
</html>