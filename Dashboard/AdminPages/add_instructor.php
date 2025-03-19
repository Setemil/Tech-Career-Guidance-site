<?php
session_start();
require_once '../../LoginPage/conn.php';

// Fetch courses for selection
$courseQuery = "SELECT id, course_name FROM courses";
$courseResult = $conn->query($courseQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $courses = $_POST['courses'] ?? [];

    // Set and hash default password
    $defaultPassword = "12345678"; // you can change this to whatever default you prefer
    $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

    // Insert instructor with password
    $stmt = $conn->prepare("INSERT INTO instructors (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $hashedPassword);

    if ($stmt->execute()) {
        $instructor_id = $stmt->insert_id;

        // Insert courses for instructor
        foreach ($courses as $course_id) {
            $linkStmt = $conn->prepare("INSERT INTO instructor_courses (instructor_id, course_id) VALUES (?, ?)");
            $linkStmt->bind_param("ii", $instructor_id, $course_id);
            $linkStmt->execute();
            $linkStmt->close();
        }

        header("Location: instructors.php?success=Instructor added successfully with default password: $defaultPassword");
        exit();
    } else {
        header("Location: add_instructor.php?error=Failed to add instructor");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Instructor</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: 30px auto;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group select {
            height: 100px;
        }
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #817ec7;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .submit-btn:hover {
            background-color: #6b69b2;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
        <h1>Add Instructor</h1>
        <a href="instructors.php" class="add-course-btn">Go back</a>
        </header>
            
            <form action="add_instructor.php" method="POST">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Phone:</label>
                    <input type="text" name="phone" required>
                </div>

                <div class="form-group">
                    <label>Courses (Hold Ctrl to select multiple):</label>
                    <select name="courses[]" multiple>
                        <?php while ($row = $courseResult->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars($row['course_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Add Instructor</button>
            </form>
        
    </div>
</body>
</html>