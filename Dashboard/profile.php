<?php
session_start();
require_once '../LoginPage/conn.php';

$student_id = $_SESSION['student_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM student WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
} else {
    session_destroy();
    header("Location: ../LoginPage/index.php?error=" . urlencode("Session expired. Please log in again."));
    exit();
}
$stmt->close();

$selected_gender = isset($student['gender']) ? $student['gender'] : '';
$dob_value = isset($student['dob']) ? $student['dob'] : '';
$phone_value = isset($student['phone']) ? $student['phone'] : '';



// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['name']);
    $new_email = trim($_POST['university_email']);
    $new_password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $age = null;

    // Calculate age from DOB
    if (!empty($dob)) {
        $birthDate = new DateTime($dob);
        $today = new DateTime();
        $age = $birthDate->diff($today)->y;
    }

    if (empty($new_name) || empty($new_email)) {
        $error = "Name and email cannot be empty.";
    } else {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE student SET name = ?, university_email = ?, password = ?, phone = ?, gender = ?, age = ? WHERE student_id = ?");
            $stmt->bind_param("sssssii", $new_name, $new_email, $hashed_password, $phone, $gender, $age, $student_id);
        } else {
            $stmt = $conn->prepare("UPDATE student SET name = ?, university_email = ?, phone = ?, gender = ?, age = ? WHERE student_id = ?");
            $stmt->bind_param("ssssii", $new_name, $new_email, $phone, $gender, $age, $student_id);
        }

        if ($stmt->execute()) {
            $_SESSION['name'] = $new_name;
            $success = "Profile updated successfully.";
        } else {
            $error = "Error updating profile.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        .container {
            width: 30%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 { text-align: center; color: #4a47a3; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        .input, select {
            width: 97%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            width: 100%;
            background-color: #817ec7;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .button:hover { background-color: #6a679e; }
        .message { text-align: center; margin-top: 10px; font-weight: bold; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <?php include 'menu-bar.php'; ?>
    
    <div class="main-content">
    <div class="container">
        <h1>Edit Profile</h1>
        
        <?php if (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php elseif (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

    <!-- HTML Form -->
        <form method="POST">
            <label>Name:</label>
            <input class="input" type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

            <label>Email:</label>
            <input class="input" type="email" name="university_email" value="<?php echo htmlspecialchars($student['university_email']); ?>" required>

            <label>Phone Number:</label>
            <input class="input" type="text" name="phone" value="<?php echo htmlspecialchars($phone_value); ?>">

            <label>Date of Birth:</label>
            <input class="input" type="date" name="dob" value="<?php echo htmlspecialchars($dob_value); ?>">

            <label>Gender:</label>
            <select name="gender" id="gender">
                <option value="male" <?php if ($selected_gender === 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($selected_gender === 'female') echo 'selected'; ?>>Female</option>
                <option value="none" <?php if ($selected_gender === 'none') echo 'selected'; ?>>I'd rather not say</option>
            </select>


            <label>New Password (leave blank to keep current password):</label>
            <input class="input" type="password" name="password">

            <button type="submit" class="button">Update Profile</button>
        </form>
    </div>
    </div>
</body>
</html>