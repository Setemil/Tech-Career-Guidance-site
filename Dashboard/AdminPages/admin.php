<?php
// Include database connection
include '../../LoginPage/conn.php';

// Debugging: Check if connection exists
if (!isset($conn)) {
    die("Database connection failed.");
}

// Query to get total users
$sql = "SELECT COUNT(*) AS user_count FROM student";
$result = $conn->query($sql);

// Debugging: Check if query executed successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch result
$row = $result->fetch_assoc();
$user_count = $row['user_count'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <header>
            <h1>Dashboard</h1>
        </header>

        <div class="cards">
            <div class="card">
                <h3>Total Users</h3>
                <p><?php echo $user_count; ?></p>
            </div>
            <div class="card">
                <h3>Active Job Posts</h3>
                <p>0</p>
            </div>
            <div class="card">
                <h3>Scheduled Sessions</h3>
                <p>0</p>
            </div>
            <div class="card">
                <h3>New Signups</h3>
                <p>1</p>
            </div>
        </div>
    </div>
    <script src="../../js/adminscript.js"></script>
</body>
</html>