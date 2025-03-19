<?php

session_start(); 
require_once '../../LoginPage/conn.php'; 

// Fetch all courses
$coursesQuery = "SELECT id, course_name FROM courses";
$coursesResult = $conn->query($coursesQuery);

// Fetch roadmaps if a course is selected
$selectedCourse = isset($_GET['course_id']) ? $_GET['course_id'] : '';
$roadmapQuery = "SELECT * FROM course_roadmap WHERE course_id = ?";
$roadmapStmt = $conn->prepare($roadmapQuery);
$roadmapStmt->bind_param("i", $selectedCourse);
$roadmapStmt->execute();
$roadmapResult = $roadmapStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Roadmaps</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        .table th {
            background-color: #817ec7;
            color: white;
        }
        .btn {
            background-color: #817ec7;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            width: 50px;
            margin-bottom: 5px;
        }
        .btn:hover {
            background-color: #6a679e;
        }
        .delete-btn {
            background-color: #ff4d4d;
            padding: 8px 12px;
            width: 50px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            color: white;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
        .form-container {
            width: 50%;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
        }
        .form-container input, 
        .form-container textarea, 
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-container button {
            width: 100%;
            background-color: #817ec7;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        .form-container button:hover {
            background-color: #6a679e;
        }
        .no-roadmap {
            margin-top: 10px;
            padding: 20px;
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        .course-dropdown {
            margin-top: 20px;
            text-align: center;
        }
        .course-dropdown select {
            padding: 8px;
            font-size: 16px;
        }
        @media screen and (max-width: 768px) {
            .form-container {
                width: 90%;
            }
            .course-dropdown{
                width: 90%;
            }
            
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <header>
        <h1>Manage Course Roadmaps</h1>
        </header>
        
        <!-- Course Selection Dropdown -->
        <div class="course-dropdown">
            <form method="GET">
                <label for="course_id">Select Course:</label>
                <select name="course_id" id="course_id" onchange="this.form.submit()">
                    <option value="">-- Select a Course --</option>
                    <?php while ($course = $coursesResult->fetch_assoc()): ?>
                        <option value="<?= $course['id']; ?>" <?= ($selectedCourse == $course['id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($course['course_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>
        </div>

        <!-- Display Roadmap -->
        <div class="table-container">
            <?php if ($selectedCourse && $roadmapResult->num_rows > 0): ?>
                <table class="table">
                    <tr>
                        <th>Topic</th>
                        <th>Description</th>
                        <th>Resources</th>
                        <th>Actions</th>
                    </tr>
                    <?php while ($roadmap = $roadmapResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($roadmap['topic']); ?></td>
                            <td><?= htmlspecialchars($roadmap['description']); ?></td>
                            <td><?= htmlspecialchars($roadmap['resource_links']); ?></td>
                            <td>
                                <a href="edit_roadmap.php?id=<?= $roadmap['id']; ?>" class="btn">Edit</a>
                                <a href="delete_roadmap.php?id=<?= $roadmap['id']; ?>&course_id=<?= $selectedCourse; ?>" class="delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($selectedCourse): ?>
                <div class="no-roadmap">No roadmap entries found for this course.</div>
            <?php endif; ?>
        </div>

        <!-- Add Roadmap Form -->
        <?php if ($selectedCourse): ?>
                <form action="add_roadmap.php" method="POST" class="form-container">
                <h2>Add Roadmap Entry</h2>
                    <input type="hidden" name="course_id" value="<?= $selectedCourse; ?>">
                    <input type="text" name="topic" placeholder="Enter Topic" required>
                    <textarea name="description" placeholder="Enter Description" required></textarea>
                    <textarea name="resource_links" placeholder="Enter Resource Links (comma-separated)" required></textarea>
                    <button type="submit">Add Entry</button>
                </form>
        <?php endif; ?>
    </div>
</body>
</html>