<?php
// Include the database connection file
require_once 'conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = $_POST["name"];
    $password = $_POST["password"];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM student WHERE name = ?");
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a row is found
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the password (using password_verify if you're hashing passwords)
        if (password_verify($password, $row["password"])) {
            // Password is correct, start a session
            session_start();
            $_SESSION["student_id"] = $student['student_id'];
            $_SESSION["name"] = $username;
            // Redirect to a welcome page or dashboard
            header("Location: ../Dashboard/main.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Incorrect username.";
    }

    $stmt->close();
}


if (isset($error)) {
    // This is a simple way to pass the error. A better way would be to use sessions.
    header("Location: index.php?error=" . urlencode($error)); 
    exit();
}

?>