<?php
session_start(); 
require_once '../../LoginPage/conn.php'; 


$sql = "SELECT name, university_email, gender, phone, age FROM student WHERE role = 'student'";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
</head>
<body>
    <?php include'sidebar.php'?>
    <div class="main-content">        
        <header>
            <h1>Active Students</h1>
        </header>

        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo !empty($row['name']) ? $row['name'] : 'Not provided'; ?></td>
                            <td><?php echo !empty($row['university_email']) ? $row['university_email'] : 'Not provided'; ?></td>
                            <td><?php echo !empty($row['gender']) ? $row['gender'] : 'Not provided'; ?></td>
                            <td><?php echo !empty($row['age']) ? $row['age'] : 'Not provided'; ?></td>
                            <td><?php echo !empty($row['phone']) ? $row['phone'] : 'Not provided'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No active students found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
         </table>
    </div>
</body>
</html>