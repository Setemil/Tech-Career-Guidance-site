<?php

session_start(); 
require_once '../../LoginPage/conn.php'; 

if (!isset($_SESSION['name'])) {
    header("Location: ../../LoginPage/index.php"); // Redirect to login page
    exit();
}
include '../../LoginPage/conn.php'; 

// Check if roadmap ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request.");
}

$roadmapId = $_GET['id'];

// Fetch the roadmap entry
$stmt = $conn->prepare("SELECT * FROM course_roadmap WHERE id = ?");
$stmt->bind_param("i", $roadmapId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Roadmap entry not found.");
}

$roadmap = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic = $_POST['topic'];
    $description = $_POST['description'];
    $resource_links = $_POST['resource_links'];

    // Update the roadmap entry
    $updateStmt = $conn->prepare("UPDATE course_roadmap SET topic = ?, description = ?, resource_links = ? WHERE id = ?");
    $updateStmt->bind_param("sssi", $topic, $description, $resource_links, $roadmapId);

    if ($updateStmt->execute()) {
        header("Location: manage_roadmap.php?course_id=" . $roadmap['course_id'] . "&success=Roadmap updated successfully");
        exit();
    } else {
        echo "Error updating roadmap entry.";
    }

    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Roadmap Entry</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .container {
            width: 50%;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 50px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .container h2 {
            margin-bottom: 15px;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            width: 100%;
            background-color: #817ec7;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }
        button:hover {
            background-color: #6a679e;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Roadmap Entry</h2>
        <a href="manage_roadmap.php" class="add-course-btn">Go back</a>
        <form method="POST">
            <input type="text" name="topic" value="<?= htmlspecialchars($roadmap['topic']) ?>" required>
            <textarea name="description" required><?= htmlspecialchars($roadmap['description']) ?></textarea>
            <textarea name="resource_links" required><?= htmlspecialchars($roadmap['resource_links']) ?></textarea>
            <button type="submit">Update Roadmap</button>
        </form>
    </div>
</body>
</html>