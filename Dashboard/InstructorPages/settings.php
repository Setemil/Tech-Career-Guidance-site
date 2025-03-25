<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header("Location: ../../LoginPage/login.php");
    exit();
}

require_once("../../LoginPage/conn.php");

$instructor_id = $_SESSION['user_id'];
$success = "";
$error = "";

// Fetch current instructor details
$stmt = $conn->prepare("SELECT name, email, phone FROM instructors WHERE id = ?");
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();
$instructor = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $new_password = trim($_POST["new_password"]);

    if (!empty($name) && !empty($email) && !empty($phone)) {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE instructors SET name=?, email=?, phone=?, password=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $hashed_password, $instructor_id);
        } else {
            $stmt = $conn->prepare("UPDATE instructors SET name=?, email=?, phone=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $email, $phone, $instructor_id);
        }

        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
            $_SESSION['name'] = $name; // Update session
        } else {
            $error = "Failed to update profile.";
        }
    } else {
        $error = "All fields (except password) are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor-Settings</title>
    <link rel="stylesheet" href="../../css/instructorstyles.css">
    <style>
        
    .container {
            width: 450px;
            margin: 0 auto;
            background: #fff;
            padding: 25px 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        h3 {
            margin-bottom: 20px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        .submit-button {
            margin-top: 20px;
            background: #5a67d8;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .submot-button:hover {
            background: #4c51bf;
        }
        .msg {
            margin-top: 15px;
            font-weight: bold;
        }
        .msg.success { color: green; }
        .msg.error { color: red; }
    </style>
</head>
<body>
    <?php include'sidebar.php'?>
    <div class="main-content">
        <div class="container">
            <h2>Edit Profile</h2>

            <?php if ($success): ?>
                <p class="msg success"><?php echo $success; ?></p>
            <?php elseif ($error): ?>
                <p class="msg error"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($instructor['name']); ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($instructor['email']); ?>" required>

                <label>Phone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($instructor['phone']); ?>" required>

                <label>New Password (leave blank to keep current password):</label>
                <input type="password" name="new_password" placeholder="Enter new password (optional)">

                <button type="submit" class="submit-button">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>