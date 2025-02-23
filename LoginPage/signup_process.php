<?php

include 'conn.php'; 

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
    echo "Please fill in all fields.";
    exit();
}
if ($password !== $confirmPassword) {
  echo "Passwords do not match.";
  exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO student (name, university_email, password, role) VALUES (?, ?, ?,'student')");
$stmt->bind_param("sss", $username, $email, $hashedPassword);

if ($stmt->execute()) {
  header("Location: index.php"); 
  exit();
} else {
  header("Location: signup.php?error=sqlerror"); 
  exit();
}

$stmt->close();
$conn->close();
?>