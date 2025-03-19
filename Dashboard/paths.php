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

// Fetch courses with their IDs
$courseQuery = "SELECT id, course_name, course_image FROM courses ORDER BY course_name ASC"; 
$courseResult = $conn->query($courseQuery);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Careers Portal - Dashboard</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        .cta-button {
            background-color: #a7a3f0;
            text-decoration: none;
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
        .cta-button:hover {
            background-color: #6a679e;
        }
        .cards {
            width: 100%;
            margin: auto;
            text-align: center;
            padding: 20px;
        }
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card a {
            width: 80%;
            text-align: center;
        }
        @media screen and (max-width: 768px) {
            .cards {
                grid-template-columns: 1fr;
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php' ?>
    
    <div class="main-content">
        <header>
            <h2>Career Paths</h2>
        </header>
        <div class="cards">
            <?php while ($course = $courseResult->fetch_assoc()): ?>
                <div class="card">
                    <img src="../<?= htmlspecialchars($course['course_image']) ?>" alt="<?= htmlspecialchars($course['course_name']) ?>">
                    <div class="card-content">
                        <h3><?= htmlspecialchars($course['course_name']) ?></h3>
                        <a href="roadmap.php?course_id=<?= $course['id'] ?>" class="cta-button">Explore Path</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>