<?php
session_start();
require_once '../../LoginPage/conn.php';

if (!isset($_SESSION['name'])) {
    header("Location: ../../LoginPage/index.php");
    exit();
}

if (!isset($_GET['instructor_id'])) {
    header("Location: instructors.php");
    exit();
}

$instructor_id = intval($_GET['instructor_id']);

// Fetch instructor details
$sql = "SELECT * FROM instructors WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();
$instructor = $result->fetch_assoc();

if (!$instructor) {
    header("Location: instructors.php");
    exit();
}

// Fetch all courses
$courses_sql = "SELECT * FROM courses";
$courses_result = $conn->query($courses_sql);

// Fetch assigned courses
$assigned_courses_sql = "SELECT course_id FROM instructor_courses WHERE instructor_id = ?";
$stmt = $conn->prepare($assigned_courses_sql);
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$assigned_result = $stmt->get_result();
$assigned_courses = [];
while ($row = $assigned_result->fetch_assoc()) {
    $assigned_courses[] = $row['course_id'];
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Instructor</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .edit-form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }
        .edit-form label {
            display: block;
            margin-top: 10px;
        }
        .edit-form input, .edit-form select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .edit-form button {
            background-color: #817ec7;
            color: white;
            padding: 10px;
            border: none;
            margin-top: 15px;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }
        .edit-form button:hover {
            background-color:rgb(110, 109, 155);

        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
        <h1>Edit Instructor</h1>
        <a href="instructors.php" class="add-course-btn">Go back</a>
        </header>
        <form action="update_instructor.php" method="post" class="edit-form">
            <input type="hidden" name="instructor_id" value="<?php echo $instructor_id; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($instructor['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($instructor['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($instructor['phone']); ?>" required>

            <label for="courses">Assign Courses:</label>
            <select name="courses[]" id="courses" multiple>
                <?php while ($course = $courses_result->fetch_assoc()): ?>
                    <option value="<?php echo $course['id']; ?>" 
                        <?php echo in_array($course['id'], $assigned_courses) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Update Instructor</button>
        </form>
    </div>
</body>
</html>
<?php $conn->close(); ?>