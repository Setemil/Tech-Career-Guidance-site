<?php
session_start();
require_once '../LoginPage/conn.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: ../LoginPage/index.php");
    exit();
}

// Retrieve the logged-in student's name and ID
$username = $_SESSION['name'];

$stmt = $conn->prepare("SELECT student_id FROM student WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user details
if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
    $student_id = $student['student_id'];
} else {
    // If no matching user is found, force logout
    session_destroy();
    header("Location: ../LoginPage/index.php?error=" . urlencode("Session expired. Please log in again."));
    exit();
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        .main-content{
            padding: 0;
            margin: 0;
            overflow-x: hidden;
        }
        .dashboard-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            padding: 20px;
        }
        .card {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 5px;
        }
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .course-card {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }
        .course-card:hover{
            background:rgb(188, 186, 255);
            color: white;
            font-weight: bold;
            transition: 0.3s ease-in;
        }
        .appointment-btn {
            background-color: #817ec7;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }
        .footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php'; ?>
    <div class="main-content">
        <div class="dashboard-container">
            <div>
            <div class="card">
                    <h2>Recently Viewed Courses</h2>
                    <div class="courses-grid">
                        <?php
                        $sql = "SELECT * FROM courses ORDER BY RAND() LIMIT 4";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='course-card'>
                                        <a href='roadmap.php?course_id=" . htmlspecialchars($row['id']) . "' style='text-decoration: none; color: inherit;'>
                                            <p>" . htmlspecialchars($row['course_name']) . "</p>
                                        </a>
                                    </div>";
                            }
                        } else {
                            echo "<p>No recent courses viewed.</p>";
                        }
                        ?>
                    </div>
                </div>

                <div class="card">
                    <h2>Upcoming Appointments</h2>
                    <?php
                        $sql = "SELECT a.appointment_time, i.name AS instructor_name 
                                FROM appointments a
                                JOIN instructors i ON a.instructor_id = i.id 
                                WHERE a.student_id = ?
                                ORDER BY a.appointment_time ASC 
                                LIMIT 1";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $student_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "<p>With: " . htmlspecialchars($row['instructor_name']) . "</p>";
                            echo "<p>Date: " . htmlspecialchars($row['appointment_time']) . "</p>";
                        } else {
                            echo "<p>No upcoming appointments.</p>";
                        }

                        $stmt->close();
                    ?>
                    <a href="set_appointment.php" class="appointment-btn">Set New Appointment</a>
                </div>
            </div>
            <div>
                <div class="card">
                    <h2>Latest Tech News</h2>
                    <?php
                    $sql = "SELECT * FROM news_updates ORDER BY created_at DESC LIMIT 3";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<p><strong>" . htmlspecialchars($row['title']) . "</strong></p>";
                            echo "<p>" . htmlspecialchars(substr($row['content'], 0, 100)) . "...</p>";
                        }
                    } else {
                        echo "<p>No tech news available.</p>";
                    }
                    ?>
                </div>

                <div class="card">
                    <h2>FAQs & Help Center</h2>
                    <p><strong>How do I book a consultation?</strong><br>Go to 'Set New Appointment' and choose an instructor.</p>
                    <p><strong>Where do I find learning resources?</strong><br>All courses contain links to external learning platforms.</p>
                    <p><strong>Who can I contact for support?</strong><br>Email us at support@yourwebsite.com</p>
                </div>

        </div>
        </div>
        <footer class="footer">
            <p>&copy; 2025 Tech Career Guidance. All rights reserved.</p>
        </footer>

    </div>
</body>
</html>