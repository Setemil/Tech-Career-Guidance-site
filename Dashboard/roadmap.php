<?php
session_start();
include '../LoginPage/conn.php';

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

if (!isset($_GET['course_id'])) {
    die("Invalid course selection.");
}

$course_id = intval($_GET['course_id']);

// Fetch course name
$courseQuery = $conn->prepare("SELECT course_name FROM courses WHERE id = ?");
$courseQuery->bind_param("i", $course_id);
$courseQuery->execute();
$courseResult = $courseQuery->get_result();
$course = $courseResult->fetch_assoc();

if (!$course) {
    die("Course not found.");
}

// Fetch roadmap steps
$roadmapQuery = $conn->prepare("SELECT topic, description, resource_links FROM course_roadmap WHERE course_id = ? ORDER BY id ASC");
$roadmapQuery->bind_param("i", $course_id);
$roadmapQuery->execute();
$roadmapResult = $roadmapQuery->get_result();

$steps = [];
while ($row = $roadmapResult->fetch_assoc()) {
    $row['resource_links'] = explode(',', $row['resource_links']); // Convert links to an array
    $steps[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['course_name']); ?> Roadmap</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        header{
            background: white;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
            display: flex;
            align-items: center;
        }
        header h2{
            width: 95%;
        }
        .timeline {
            position: relative;
            margin: 20px auto;
            max-width: 800px;
        }
        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background: #817ec7;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }
        .timeline-item {
            position: relative;
            width: 50%;
            padding: 10px 30px;
            box-sizing: border-box;
        }
        .timeline-item:nth-child(odd) {
            left: 0;
        }
        .timeline-item:nth-child(even) {
            left: 50%;
        }
        .timeline-content {
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
            position: relative;
        }
        .timeline-content h3 {
            margin-top: 0;
            color: #817ec7;
        }
        .timeline-content ul {
            padding-left: 20px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            top: 15px;
            width: 16px;
            height: 16px;
            background: #817ec7;
            border-radius: 50%;
            left: calc(50% - 8px);
        }
        /* If problem starts */
        .resource-links {
            padding-left: 0;
            list-style-type: none;
        }

        .resource-links li {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
            max-width: 100%;
        }

        .resource-links a {
            display: inline-block;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #007bff; /* Adjust link color */
            text-decoration: none;
        }

        .resource-links a:hover {
            text-decoration: underline;
        }
        .cta-button{
            display: block;
            padding: 8px 12px;
            width: 7%;  
            text-align: center;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            border: none;
        }
        .cta-button:hover{
            background-color:rgb(40, 118, 171);
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php'; ?>

    <div class="main-content">
        <header>
        <a href="main.php" class="cta-button">Go back</a>
        <h2><?php echo htmlspecialchars($course['course_name']); ?> Roadmap</h2>
        </header>
    <div class="timeline">
            <?php foreach ($steps as $step): ?>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h3><?php echo htmlspecialchars($step['topic']); ?></h3>
                        <p><?php echo htmlspecialchars($step['description']); ?></p>
                        <strong>Resources:</strong>
                        <ul class="resource-links">
                            <?php foreach ($step['resource_links'] as $link): ?>
                                <li>
                                    <a href="<?php echo trim($link); ?>" target="_blank">
                                        <?php echo htmlspecialchars($link); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>