<?php
session_start();
require_once '../../LoginPage/conn.php';

// Fetch admin details and verify role
$admin_name = $_SESSION['username'];
$query = "SELECT student_id, name, university_email, role FROM student WHERE name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $admin_name);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Ensure user is an admin
if (!$admin || $admin['role'] !== 'admin') {
    header("Location: ../../LoginPage/index.php");
    exit();
}

$admin_id = $admin['student_id'];

// Update Admin Details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_admin'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['university_email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    $updateQuery = "UPDATE student SET name = ?, university_email = ? " . ($password ? ", password = ?" : "") . " WHERE student_id = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($password) {
        $stmt->bind_param("sssi", $name, $email, $password, $admin_id);
    } else {
        $stmt->bind_param("ssi", $name, $email, $admin_id);
    }

    if ($stmt->execute()) {
        $_SESSION['name'] = $name; // Update session name if changed
        $_SESSION['success_message'] = "Profile updated successfully.";
        header("Location: settings.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error updating profile.";
    }
}

// Fetch all users
$userQuery = "SELECT 'student' AS type, student_id AS id, name, university_email, role FROM student WHERE role != 'admin' 
              UNION 
              SELECT 'instructor' AS type, id, name, email, NULL AS role FROM instructors";
$users = $conn->query($userQuery);

// Delete User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type'];

    if ($user_type === 'student') {
        $deleteQuery = "DELETE FROM student WHERE student_id = ?";
    } else {
        $deleteQuery = "DELETE FROM instructors WHERE id = ?";
    }

    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "User deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete user.";
    }
    header("Location: settings.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        form {
            max-width: 400px;
            margin: auto;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        form input, form button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        button {
            background: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        button:hover {
            background: #cc0000;
        }
        .update_input{
            width: 94%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
            <h2>Admin Settings</h2>
        </header>

        <?php if (isset($_SESSION['success_message'])): ?>
            <p style="color: green;"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></p>
        <?php elseif (isset($_SESSION['error_message'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
        <?php endif; ?>

        <!-- Update Admin Profile -->
        <h3>Update Profile</h3>
        <form method="POST">
            <label>Name:</label>
            <input class="update_input" type="text" name="name" value="<?php echo htmlspecialchars($admin['name']); ?>" style="width: 94%;"required>
            
            <label>Email:</label>
            <input class="update_input" type="email" name="university_email" value="<?php echo htmlspecialchars($admin['university_email']); ?>" required>

            <label>New Password (leave blank to keep current):</label>
            <input class="update_input" type="password" name="password">
            
            <button type="submit" name="update_admin" onclick="return confirm('Are you sure?');">Update Profile</button>
        </form>

        <!-- View and Delete Users -->
        <h3>Manage Users</h3>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['university_email'] ?? $user['email']); ?></td>
                    <td><?php echo ucfirst($user['type']); ?></td>
                    <td>
                        <?php if ($user['role'] !== 'admin'): ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <input type="hidden" name="user_type" value="<?php echo $user['type']; ?>">
                                <button type="submit" name="delete_user" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        <?php else: ?>
                            <strong>Admin (Cannot be deleted)</strong>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
