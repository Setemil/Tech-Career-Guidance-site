<?php
include '../LoginPage/conn.php';
session_start();

$student_id = $_SESSION['student_id'];

if (!isset($_GET['id'])) {
    echo "Course not found.";
    exit;
}

$course_id = $_GET['id'];

// Fetch course details
$course_sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($course_sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$course_result = $stmt->get_result();

if ($course_result->num_rows == 0) {
    echo "Course not found.";
    exit;
}

$course = $course_result->fetch_assoc();

// Fetch programming languages
$lang_sql = "SELECT pl.name 
             FROM course_languages cl
             JOIN programming_languages pl ON cl.language_id = pl.id
             WHERE cl.course_id = ?";
$lang_stmt = $conn->prepare($lang_sql);
$lang_stmt->bind_param("i", $course_id);
$lang_stmt->execute();
$lang_result = $lang_stmt->get_result();

// Fetch instructors
$instructor_sql = "SELECT i.name, i.email, i.phone 
                   FROM instructor_courses ic
                   JOIN instructors i ON ic.instructor_id = i.id
                   WHERE ic.course_id = ?";
$instructor_stmt = $conn->prepare($instructor_sql);
$instructor_stmt->bind_param("i", $course_id);
$instructor_stmt->execute();
$instructor_result = $instructor_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Course Details - <?php echo htmlspecialchars($course['course_name']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .course-container {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.1);
      padding: 30px;
      max-width: 900px;
      margin: auto;
    }
    .course-img {
      width: 100%;
      height: auto;
      max-height: 300px;
      object-fit: cover;
      border-radius: 12px;
    }
    .section-title {
      margin-top: 30px;
    }
    .instructor-card {
      border: 1px solid #dee2e6;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      background-color: #f8f9fa;
    }
    .cta-button {
        background-color: #a7a3f0;
        text-decoration: none;
        display: inline-block;
        padding: 10px 15px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .cta-button:hover {
        background-color: #6a679e;
    }
  </style>
</head>
<body>

<div class="container course-container">
  <div class="container-top" style="display: flex; justify-content: space-between; align-items: center;">
    <h2 class="mb-3"><?php echo htmlspecialchars($course['course_name']); ?></h2>

    <a href="recommendations.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Go back</a>

  </div>
  <?php if (!empty($course['course_image'])): ?>
    <img src="../<?php echo htmlspecialchars($course['course_image']); ?>" class="course-img mb-3" alt="Course Image">
  <?php endif; ?>

  <?php if (!empty($course['description'])): ?>
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
  <?php endif; ?>

  <?php if (!empty($course['duration'])): ?>
    <p><strong>Estimated Duration:</strong> <?php echo htmlspecialchars($course['duration']); ?></p>
  <?php endif; ?>

  <div class="section-title">
    <h4>Programming Languages Required</h4>
    <?php if ($lang_result->num_rows > 0): ?>
      <ul class="list-group">
        <?php while ($lang = $lang_result->fetch_assoc()): ?>
          <li class="list-group-item"><?php echo htmlspecialchars($lang['name']); ?></li>
        <?php endwhile; ?>
      </ul>
    <?php else: ?>
      <p>No programming languages listed for this course.</p>
    <?php endif; ?>
  </div>

  <div class="section-title">
    <h4>Instructors</h4>
    <?php if ($instructor_result->num_rows > 0): ?>
      <?php while ($instructor = $instructor_result->fetch_assoc()): ?>
        <div class="instructor-card">
          <h6><?php echo htmlspecialchars($instructor['name']); ?></h6>
          <p>Email: <?php echo htmlspecialchars($instructor['email']); ?><br>
             Phone: <?php echo htmlspecialchars($instructor['phone']); ?></p>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No instructors registered for this course yet.</p>
    <?php endif; ?>
  </div>

  <?php if (!empty($course['syllabus_pdf'])): ?>
    <div class="mt-4">
      <a href="../../uploads/<?php echo htmlspecialchars($course['syllabus_pdf']); ?>" class="btn btn-primary" download>Download Syllabus (PDF)</a>
    </div>
  <?php endif; ?>
  <a href="roadmap.php?course_id=<?= $course['id'] ?>" class="cta-button">Explore Path</a>
</div>

</body>
</html>
