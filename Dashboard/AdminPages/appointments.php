<?php
session_start();
require_once '../../LoginPage/conn.php';

// Fetch appointments with course details
$query = "SELECT 
            s.name AS student_name, 
            i.name AS instructor_name, 
            c.course_name, 
            a.appointment_time 
          FROM appointments a
          JOIN student s ON a.student_id = s.student_id
          JOIN instructors i ON a.instructor_id = i.id
          JOIN courses c ON a.course_id = c.id
          ORDER BY a.appointment_time";

$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
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
        th {
            background-color: #817ec7;
            color: white;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
            <h2>Appointments</h2>
        </header>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Student</th>
                    <th>Instructor</th>
                    <th>Course</th>
                    <th>Time</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['instructor_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_time']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No appointments have been set.</p>
        <?php endif; ?>
    </div>
</body>
</html>
