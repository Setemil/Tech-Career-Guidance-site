<?php
session_start();
require_once '../LoginPage/conn.php';

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT name FROM student WHERE name = ?");
$stmt->bind_param("s", $username);
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

// Fetch all booked appointments for the logged-in student
$student_name = $_SESSION['username'];

$query = "SELECT i.name AS instructor_name, c.course_name, a.appointment_time 
          FROM appointments a
          JOIN student s ON a.student_id = s.student_id 
          JOIN instructors i ON a.instructor_id = i.id
          JOIN courses c ON a.course_id = c.id
          WHERE s.name = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_name);
$stmt->execute();
$result = $stmt->get_result();

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        
        .appointments-container {
            width: 60%;
            margin: auto;
            text-align: center;
            padding: 20px;
        }
        .appointment-card {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
        }
        .set-appointment-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #817ec7;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        @media screen and (max-width: 768px) {
            .appointments-container {
                width: 90%;
            }
            
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php'; ?>
    <div class="main-content">
    <div class="appointments-container">
        <header>
        <h2>Appointments</h2>
        </header>        
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <p id="success-message" style="color: green; text-align: center;">Appointment booked successfully.</p>
            <script>
                setTimeout(() => {
                    const url = new URL(window.location.href);
                    url.searchParams.delete('success');
                    window.history.replaceState({}, '', url);
                }, 3000);
            </script>
        <?php endif; ?>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="appointment-card">
                    <p>You booked a session with <strong><?php echo htmlspecialchars($row['instructor_name']); ?></strong></p>
                    <p>Course: <strong><?php echo htmlspecialchars($row['course_name']); ?></strong></p>
                    <p>Time: <?php echo htmlspecialchars($row['appointment_time']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>You haven't booked any Apppointments yet!</p>
        <?php endif; ?>

        <a href="set_appointment.php" class="set-appointment-btn">Set up a new appointment</a>
    </div>
    </div>
</body>
</html>
