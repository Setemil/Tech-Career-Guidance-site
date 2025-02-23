<?php
session_start(); // Start the session

// Include the database connection file
require_once 'conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = $_POST["name"];
    $password = $_POST["password"];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT student_id, password, role FROM student WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify the password (using password_verify if you're hashing passwords)
        if (password_verify($password, $row["password"])) {
            $_SESSION["student_id"] = $row['student_id']; 
            $_SESSION["name"] = $username;
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: ../Dashboard/AdminPages/admin.php");
            } else {
                header("Location: ../Dashboard/main.php");
            }
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Incorrect username.";
    }

    $stmt->close();
}

// Redirect if there's an error
if (isset($error)) {
    header("Location: index.php?error=" . urlencode($error)); 
    exit();
}
?>