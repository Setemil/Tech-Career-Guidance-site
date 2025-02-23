<?php
session_start();
require_once '../LoginPage/conn.php'; 

if (!isset($_SESSION['name'])) {
    header("Location: ../LoginPage/index.php");
    exit();
}

$username = $_SESSION['name'];

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

$courseQuery = "SELECT course_name, course_image, link FROM courses ORDER BY course_name ASC"; 
$courseResult = $conn->query($courseQuery);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Careers Portal - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        .header {
            background-color: #817ec7;
        }
        .cta-button {
            background-color: #a7a3f0;
        }
        .cta-button:hover {
            background-color: #6a679e;
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php' ?>
    
    <div class="main-content">
        <div class="cards">
            <?php while ($course = $courseResult->fetch_assoc()): ?>
                <div class="card">
                    <img src="../<?= htmlspecialchars($course['course_image']) ?>" alt="<?= htmlspecialchars($course['course_name']) ?>">
                    <div class="card-content">
                        <h3><?= htmlspecialchars($course['course_name']) ?></h3>
                        <a href="<?= htmlspecialchars($course['link']) ?>" class="cta-button">Explore Path</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>