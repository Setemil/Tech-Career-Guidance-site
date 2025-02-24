<?php
// Include database connection
include '../../LoginPage/conn.php';

// Debugging: Check if connection exists
if (!isset($conn)) {
    die("Database connection failed.");
}

// Query to count students
$sql_students = "SELECT COUNT(*) AS user_count FROM student";
$result_students = $conn->query($sql_students);
if (!$result_students) {
    die("Query failed: " . $conn->error);
}
$row_students = $result_students->fetch_assoc();
$user_count = $row_students['user_count'];

// Query to count instructors
$sql_instructors = "SELECT COUNT(*) AS instructor_count FROM instructors";
$result_instructors = $conn->query($sql_instructors);
if (!$result_instructors) {
    die("Query failed: " . $conn->error);
}
$row_instructors = $result_instructors->fetch_assoc();
$instructor_count = $row_instructors['instructor_count'];

// Query to count courses
$sql_courses = "SELECT COUNT(*) AS course_count FROM courses";
$result_courses = $conn->query($sql_courses);
if (!$result_courses) {
    die("Query failed: " . $conn->error);
}
$row_courses = $result_courses->fetch_assoc();
$course_count = $row_courses['course_count'];

// Close database connection
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
                <h3>Active Instructors</h3>
                <p><?php echo $instructor_count; ?></p>
            </div>
            <div class="card">
                <h3>Available Courses</h3>
                <p><?php echo $course_count; ?></p>
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