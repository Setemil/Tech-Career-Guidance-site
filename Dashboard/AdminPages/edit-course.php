<?php
session_start();
require_once '../../LoginPage/conn.php';

$course_id = $_GET['course_id'] ?? null;
if (!$course_id) {
    die("No course selected.");
}

// Fetch existing course data
$course_stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$course_stmt->bind_param("i", $course_id);
$course_stmt->execute();
$course_data = $course_stmt->get_result()->fetch_assoc();

if (!$course_data) {
    die("Course not found.");
}

// Fetch associated interests and languages
$selected_interests = [];
$res = $conn->query("SELECT interest_id FROM course_interests WHERE course_id = $course_id");
while ($row = $res->fetch_assoc()) $selected_interests[] = $row['interest_id'];

$selected_languages = [];
$res = $conn->query("SELECT language_id FROM course_languages WHERE course_id = $course_id");
while ($row = $res->fetch_assoc()) $selected_languages[] = $row['language_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Course</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
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
<?php include 'sidebar.php'?>


<div class="main-content">
<header>
    <h2>Edit Course</h2>
    <a href="resources.php" class="add-course-btn">Go back</a>

</header>
<form method="POST" enctype="multipart/form-data" action="edit-course-process.php">
    <input type="hidden" name="course_id" value="<?= $course_data['id'] ?>">

    <div class="form-group">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required value="<?= htmlspecialchars($course_data['course_name']) ?>">
    </div>

    <div class="form-group">
        <label>Current Image:</label><br>
        <img src="../../<?= htmlspecialchars($course_data['course_image']) ?>" width="150">
    </div>

    <div class="form-group">
        <label for="course_image">Change Image (optional):</label>
        <input type="file" id="course_image" name="course_image">
    </div>

    <div class="form-group">
        <label for="difficulty_level">Difficulty Level:</label>
        <select id="difficulty_level" name="difficulty_level">
            <option value="beginner" <?= $course_data['difficulty_level'] == 'beginner' ? 'selected' : '' ?>>Beginner</option>
            <option value="intermediate" <?= $course_data['difficulty_level'] == 'intermediate' ? 'selected' : '' ?>>Intermediate</option>
            <option value="advanced" <?= $course_data['difficulty_level'] == 'advanced' ? 'selected' : '' ?>>Advanced</option>
        </select>
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?= htmlspecialchars($course_data['description']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="learning_style">Learning Style:</label>
        <select id="learning_style" name="learning_style">
            <option value="visual" <?= $course_data['learning_style'] == 'visual' ? 'selected' : '' ?>>Visual</option>
            <option value="reading" <?= $course_data['learning_style'] == 'reading' ? 'selected' : '' ?>>Reading</option>
            <option value="interactive" <?= $course_data['learning_style'] == 'interactive' ? 'selected' : '' ?>>Interactive</option>
            <option value="combination" <?= $course_data['learning_style'] == 'combination' ? 'selected' : '' ?>>Combination</option>
        </select>
    </div>

    <div class="form-group">
        <label for="career_path">Career Path:</label>
        <select id="career_path" name="career_path">
            <option value="entry_level" <?= $course_data['career_path'] == 'entry_level' ? 'selected' : '' ?>>Entry Level</option>
            <option value="career_switch" <?= $course_data['career_path'] == 'career_switch' ? 'selected' : '' ?>>Career Switch</option>
            <option value="skill_enhancement" <?= $course_data['career_path'] == 'skill_enhancement' ? 'selected' : '' ?>>Skill Enhancement</option>
            <option value="personal_projects" <?= $course_data['career_path'] == 'personal_projects' ? 'selected' : '' ?>>Personal Projects</option>
            <option value="entrepreneurship" <?= $course_data['career_path'] == 'entrepreneurship' ? 'selected' : '' ?>>Entrepreneurship</option>
        </select>
    </div>

    <div class="form-group">
        <label>Related Interests:</label>
        <div class="checkbox-group">
            <?php
            $interests = $conn->query("SELECT * FROM interest_areas");
            while ($row = $interests->fetch_assoc()) {
                $checked = in_array($row['id'], $selected_interests) ? 'checked' : '';
                echo "<div class='checkbox-item'>";
                echo "<input type='checkbox' id='interest_{$row['id']}' name='interests[]' value='{$row['id']}' $checked>";
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
                $checked = in_array($row['id'], $selected_languages) ? 'checked' : '';
                echo "<div class='checkbox-item'>";
                echo "<input type='checkbox' id='language_{$row['id']}' name='languages[]' value='{$row['id']}' $checked>";
                echo "<label for='language_{$row['id']}'>{$row['name']}</label>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <button type="submit">Update Course</button>
</form>
</div>

</body>
</html>
