<?php
session_start();
include('../../LoginPage/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_name = $_POST['course_name'];
    $difficulty_level = $_POST['difficulty_level'];
    $description = $_POST['description'];
    $learning_style = $_POST['learning_style'];
    $career_path = $_POST['career_path'];

    // Upload Image
    $target_dir = "../../uploads/";
    $image_name = basename($_FILES["course_image"]["name"]);
    $target_file = "uploads/" . $image_name;

    if (move_uploaded_file($_FILES["course_image"]["tmp_name"], "../../uploads/" . $image_name)) {
        // Insert course into `courses` table
        $insertCourse = "INSERT INTO courses (course_name, course_image, difficulty_level, description, learning_style, career_path)
                         VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertCourse);
        $stmt->bind_param("ssssss", $course_name, $target_file, $difficulty_level, $description, $learning_style, $career_path);
        $stmt->execute();

        $course_id = $conn->insert_id;

        // Insert into course_interests
        if (!empty($_POST['interests'])) {
            foreach ($_POST['interests'] as $interest_id) {
                $conn->query("INSERT INTO course_interests (course_id, interest_id) VALUES ($course_id, $interest_id)");
            }
        }

        // Insert into course_languages
        if (!empty($_POST['languages'])) {
            foreach ($_POST['languages'] as $language_id) {
                $conn->query("INSERT INTO course_languages (course_id, language_id) VALUES ($course_id, $language_id)");
            }
        }

        echo "Course added successfully!";
    } else {
        echo "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        h1 {
            color: #2c3e50;
            font-size: 28px;
        }

        .add-course-btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .add-course-btn:hover {
            background-color: #2980b9;
        }

        /* Form Styles */
        form {
            display: grid;
            gap: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #2c3e50;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        input[type="file"] {
            padding: 8px 0;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Checkbox Section Styles */
        form div.checkbox-group {
            margin-bottom: 15px;
        }

        input[type="checkbox"] {
            margin-right: 8px;
            margin-bottom: 8px;
        }

        /* Add spacing for checkbox labels */
        input[type="checkbox"] + span {
            margin-right: 20px;
        }

        /* Submit Button */
        button[type="submit"] {
            padding: 12px 24px;
            background-color: #817ec7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color:rgb(117, 115, 182);
        }
        /* Form Group Container */
        .form-group {
            margin-bottom: 20px;
        }

        /* Checkbox Group Styling */
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            min-width: 150px;
        }

        .checkbox-item input[type="checkbox"] {
            margin-right: 8px;
        }

        .checkbox-item label {
            margin-bottom: 0;
            font-weight: normal;
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            .main-content {
                padding: 20px;
                margin: 20px auto;
            }
            
            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .add-course-btn {
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
    <header>
        <h1>Add New Course</h1>
        <a href="resources.php" class="add-course-btn">Go back</a>
    </header>

    <!-- Add Course Form -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required>
        </div>

        <div class="form-group">
            <label for="course_image">Course Image:</label>
            <input type="file" id="course_image" name="course_image" required>
        </div>

        <div class="form-group">
            <label for="difficulty_level">Difficulty Level:</label>
            <select id="difficulty_level" name="difficulty_level">
                <option value="beginner">Beginner</option>
                <option value="intermediate">Intermediate</option>
                <option value="advanced">Advanced</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="learning_style">Learning Style:</label>
            <select id="learning_style" name="learning_style">
                <option value="visual">Visual</option>
                <option value="reading">Reading</option>
                <option value="interactive">Interactive</option>
                <option value="combination">Combination</option>
            </select>
        </div>

        <div class="form-group">
            <label for="career_path">Career Path:</label>
            <select id="career_path" name="career_path">
                <option value="entry_level">Entry Level</option>
                <option value="career_switch">Career Switch</option>
                <option value="skill_enhancement">Skill Enhancement</option>
                <option value="personal_projects">Personal Projects</option>
                <option value="entrepreneurship">Entrepreneurship</option>
            </select>
        </div>

        <div class="form-group">
            <label>Related Interests:</label>
            <div class="checkbox-group">
                <?php
                $interests = $conn->query("SELECT * FROM interest_areas");
                while ($row = $interests->fetch_assoc()) {
                    echo "<div class='checkbox-item'>";
                    echo "<input type='checkbox' id='interest_{$row['id']}' name='interests[]' value='{$row['id']}'>";
                    echo "<label for='interest_{$row['id']}'>{$row['name']}</label>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label>Related Programming Languages:</label>
            <div class="checkbox-group">
                <?php
                $languages = $conn->query("SELECT * FROM programming_languages");
                while ($row = $languages->fetch_assoc()) {
                    echo "<div class='checkbox-item'>";
                    echo "<input type='checkbox' id='language_{$row['id']}' name='languages[]' value='{$row['id']}'>";
                    echo "<label for='language_{$row['id']}'>{$row['name']}</label>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>

        <button type="submit">Add Course</button>
    </form>
</div>
</body>
</html>
