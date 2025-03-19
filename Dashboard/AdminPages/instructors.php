<?php

session_start(); 
require_once '../../LoginPage/conn.php'; 

// Fetch instructors
$sql = "SELECT instructors.id, instructors.name, instructors.email, instructors.phone, 
               GROUP_CONCAT(courses.course_name SEPARATOR ', ') AS courses 
        FROM instructors 
        LEFT JOIN instructor_courses ON instructors.id = instructor_courses.instructor_id 
        LEFT JOIN courses ON instructor_courses.course_id = courses.id 
        GROUP BY instructors.id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Instructors</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .instructor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .instructor-card {
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .delete-btn, .edit-btn {
            display: block;
            padding: 8px 12px;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
            border-radius: 5px;
        }
        .delete-btn {
            background-color: #ff4d4d;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
        .edit-btn {
            background-color: #817ec7;
        }
        .edit-btn:hover {
            background-color:rgb(114, 112, 167);
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <header>
            <h1>Manage Instructors</h1>
            <a href="add_instructor.php" class="add-course-btn">Add New Instructor</a>
        </header>

        <div class="instructor-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="instructor-card">
                        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                        <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
                        <p>Phone: <?php echo htmlspecialchars($row['phone']); ?></p>
                        <p>Courses: <?php echo htmlspecialchars($row['courses'] ?: 'None'); ?></p>
                        
                        <a href="edit_instructor.php?instructor_id=<?php echo $row['id']; ?>" class="edit-btn">
                            Edit Instructor
                        </a>
                        <a href="delete_instructor.php?instructor_id=<?php echo $row['id']; ?>"
                            class="delete-btn"
                            onclick="return confirm('Are you sure you want to delete this instructor?');">
                            Delete Instructor
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No instructors available.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>