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
    <title>Appointments</title>
    <link rel="stylesheet" href="../../css/instructorstyles.css">
    <style>
        h3 {
            color: #444;
        }
    </style>
</head>
<body>
    <?php include'sidebar.php'?>
    <div class="main-content">

    <!-- Section: Scheduled Appointments -->
<header>
<h1>Your Scheduled Appointments</h1>

</header>
<?php
$stmt = $conn->prepare("
    SELECT a.appointment_time, s.name AS student_name, s.university_email AS student_email, c.course_name
    FROM appointments a
    JOIN student s ON a.student_id = s.student_id
    JOIN courses c ON a.course_id = c.id
    WHERE a.instructor_id = ?
    ORDER BY a.appointment_time DESC
");
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Course</th>
            <th>Appointment Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                <td><?php echo htmlspecialchars($row['student_email']); ?></td>
                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                <td><?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($row['appointment_time']))); ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No appointments have been scheduled yet.</p>
<?php endif; ?>
    </div>
</body>
</html>