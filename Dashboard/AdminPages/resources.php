<?php

session_start(); 
require_once '../../LoginPage/conn.php'; 


$sql = "SELECT id, course_name, course_image FROM courses ORDER BY course_name ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
            }

        .course-card {
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);

        }

        .delete-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            text-align: center;
            width: 80%;
            border-radius: 4px;
            margin-top: 10px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #cc0000;
        }
        .cta-button{
            display: block;
            width: 80%;
            padding: 8px 12px;
            text-align: center;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .cta-button:hover{
            background-color:rgb(40, 118, 171);
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <header>
            <h1>Manage Courses</h1>
            <a href="add_course.php" class="add-course-btn">Add New Course</a>
        </header>

        <!-- Display success or error messages -->
            <?php if (isset($_GET['success'])): ?>
                <p style="color: green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

        <div class="course-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="course-card">
                        <img src="<?php echo '/MainBySetemi/' . $row['course_image']; ?>" 
                             alt="<?php echo htmlspecialchars($row['course_name']); ?>">
                        <h3><?php echo htmlspecialchars($row['course_name']); ?></h3>
                        <a href="manage_roadmap.php?course_id=<?= $row['id'] ?>" class="cta-button">Edit Roadmap</a>
                        <!-- Delete Course Button -->
                            <a href="delete_course.php?course_id=<?php echo $row['id']; ?>"
                                class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete this course?');">
                            Delete Course
                            </a>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php $conn->close(); ?>
</body>
</html>