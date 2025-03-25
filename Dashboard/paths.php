<?php
session_start();
require_once '../LoginPage/conn.php';

$student_id = $_SESSION['student_id'];

// Fetch user details
$stmt = $conn->prepare("SELECT student_id, name, university_email FROM student WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
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

// Fetch Saved Courses
$savedCourses = [];
$savedCourseIds = [];

$savedQuery = $conn->prepare("
    SELECT c.id, c.course_name, c.course_image
    FROM courses c
    INNER JOIN saved_courses s ON c.id = s.course_id
    WHERE s.student_id = ?
");
$savedQuery->bind_param("i", $student_id);
$savedQuery->execute();
$savedResult = $savedQuery->get_result();

while ($row = $savedResult->fetch_assoc()) {
    $savedCourses[] = $row;
    $savedCourseIds[] = $row['id'];
}
$savedQuery->close();

// Fetch Other Courses (NOT in saved list)
$otherCourses = [];
if (!empty($savedCourseIds)) {
    $placeholders = implode(',', array_fill(0, count($savedCourseIds), '?'));
    $query = "SELECT id, course_name, course_image FROM courses WHERE id NOT IN ($placeholders)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(str_repeat('i', count($savedCourseIds)), ...$savedCourseIds);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $otherCourses[] = $row;
    }
    $stmt->close();
} else {
    // If no saved courses, show all as other
    $result = $conn->query("SELECT id, course_name, course_image FROM courses");
    while ($row = $result->fetch_assoc()) {
        $otherCourses[] = $row;
    }
}

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
        .main-content {
            margin-top: 20px;
            text-align: center;
        }
        .details{
            background-color: skyblue; 
            margin-bottom: 10px; 
            transition: background-color 0.3s;
        }
        .details:hover{
            background-color:rgb(0, 195, 255);
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

        <h3>Your Saved Courses</h3>
        <div class="cards">
            <?php if (!empty($savedCourses)): ?>
                <?php foreach ($savedCourses as $course): ?>
                    <div class="card">
                        <img src="../<?= htmlspecialchars($course['course_image']) ?>" alt="<?= htmlspecialchars($course['course_name']) ?>">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($course['course_name']) ?></h3>
                            <a href="course-details.php?id=<?php echo $course['id']; ?>" class="cta-button details">View Details</a>
                            <a href="roadmap.php?course_id=<?= $course['id'] ?>" class="cta-button">Explore Path</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't saved any courses yet.</p>
            <?php endif; ?>
        </div>

        <section id="others">
        <h3>Explore Other Courses</h3>
        <div class="cards">
            <?php if (!empty($otherCourses)): ?>
                <?php foreach ($otherCourses as $course): ?>
                    <div class="card">
                        <img src="../<?= htmlspecialchars($course['course_image']) ?>" alt="<?= htmlspecialchars($course['course_name']) ?>">
                        <div class="card-content">
                            <h3><?= htmlspecialchars($course['course_name']) ?></h3>
                            <a href="course-details.php?id=<?php echo $course['id']; ?>" class="cta-button details">View Details</a>
                            <a href="roadmap.php?course_id=<?= $course['id'] ?>" class="cta-button">Explore Path</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="margin-left: 20px;">No other courses available.</p>
            <?php endif; ?>
        </div>
        </section>
    </div>


</body>
</html>