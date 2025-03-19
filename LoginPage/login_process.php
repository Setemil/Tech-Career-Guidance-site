<?php
session_start(); // Start the session
require_once 'conn.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $password = $_POST["password"];

    // Check if user exists in student table first
    $stmt = $conn->prepare("SELECT student_id, password, role FROM student WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["student_id"] = $row['student_id'];
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $row["role"];

            if ($row["role"] === "admin") {
                header("Location: ../Dashboard/AdminPages/admin.php");
            } else {
                header("Location: ../Dashboard/main.php"); 
            }
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        // If not in student table, check instructor table
        $stmt = $conn->prepare("SELECT id, password FROM instructors WHERE name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $instructorResult = $stmt->get_result();

        if ($instructorResult->num_rows === 1) {
            $instructor = $instructorResult->fetch_assoc();
            if (password_verify($password, $instructor["password"])) {
                $_SESSION["user_id"] = $instructor["id"];
                $_SESSION["name"] = $username;
                $_SESSION["role"] = "instructor";

                header("Location: ../Dashboard/InstructorPages/main.php"); // instructor dashboard
                exit();
            } else {
                $error = "Incorrect password.";
            }
        } else {
            $error = "Incorrect username.";
        }
    }

    $stmt->close();
}

// Redirect with error
if (isset($error)) {
    header("Location: index.php?error=" . urlencode($error));
    exit();
}
?>
