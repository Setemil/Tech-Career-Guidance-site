<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'instructor') {
    header("Location: ../../LoginPage/login.php");
    exit();
}

require_once("../../LoginPage/conn.php");

$instructor_id = $_SESSION['user_id'];
$instructor_name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <link rel="stylesheet" href="../../css/instructorstyles.css">
    <style>
        .dashboard-container {
            padding: 20px;
        }
        .card {
            background: #f4f4f4;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h4 {
            margin: 0 0 10px;
            color: #444;
        }
        .card p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="main-content dashboard-container">
        <header>
            <h2>Welcome, <?php echo isset($instructor_name) ? htmlspecialchars($instructor_name) : 'Guest'; ?></h2>
        </header>
    <!-- Section: Registered Courses -->
    <div class="card">
        <h4>Your Registered Courses</h4>
        <?php
        $stmt = $conn->prepare("
            SELECT c.course_name
            FROM instructor_courses ic
            JOIN courses c ON ic.course_id = c.id
            WHERE ic.instructor_id = ?
        ");
        $stmt->bind_param("i", $instructor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['course_name']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>You are not yet registered for any courses.</p>";
        }
        ?>
    </div>

    <!-- Section: Latest Appointment -->
    <div class="card">
        <h4>Latest Appointment</h4>
        <?php
        $stmt = $conn->prepare("
            SELECT a.appointment_time, s.name AS student_name, s.university_email AS student_email, c.course_name
            FROM appointments a
            JOIN student s ON a.student_id = s.student_id
            JOIN courses c ON a.course_id = c.id
            WHERE a.instructor_id = ?
            ORDER BY a.appointment_time DESC
            LIMIT 1
        ");
        $stmt->bind_param("i", $instructor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p><strong>Student:</strong> " . htmlspecialchars($row['student_name']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row['student_email']) . "</p>";
            echo "<p><strong>Course:</strong> " . htmlspecialchars($row['course_name']) . "</p>";
            echo "<p><strong>Time:</strong> " . htmlspecialchars(date('d M Y, h:i A', strtotime($row['appointment_time']))) . "</p>";
        } else {
            echo "<p>No appointments scheduled yet.</p>";
        }
        ?>
    </div>

</div>
</body>
</html>
