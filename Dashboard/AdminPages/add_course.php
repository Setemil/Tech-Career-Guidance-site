<?php
include '../../LoginPage/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    
    // Ensure the uploads directory exists
    $upload_dir = "../../uploads/";
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            die("Failed to create upload directory.");
        }
    }

    // Check if the file was uploaded without errors
    if (isset($_FILES['course_image']) && $_FILES['course_image']['error'] == 0) {
        $image_path = $upload_dir . basename($_FILES['course_image']['name']);
        
        // Move uploaded file
        if (move_uploaded_file($_FILES['course_image']['tmp_name'], $image_path)) {
            // Store relative path in DB
            $relative_path = "uploads/" . basename($_FILES['course_image']['name']);
            
            // Insert into database
            $sql = "INSERT INTO courses (course_name, course_image) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ss", $course_name, $relative_path);

                if ($stmt->execute()) {
                    header("Location: resources.php?success=Course added");
                    exit();
                } else {
                    echo "Error adding course: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error preparing SQL statement: " . $conn->error;
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "Error uploading file: " . $_FILES['course_image']['error'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
            <h1>Add New Course</h1>
            <a href="resources.php" class="add-course-btn">Go back</a>
        </header>

        <form action="add_course.php" method="POST" enctype="multipart/form-data">
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" required>

            <label for="course_image">Course Image:</label>
            <input type="file" name="course_image" accept="image/*" required>

            <button type="submit">Add Course</button>
        </form>
    </div>
</body>
</html>