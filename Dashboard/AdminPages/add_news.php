<?php
session_start();
require_once '../../LoginPage/conn.php'; // Database connection

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image = $_FILES['image'];
    
    if ($title && $content && $image['size'] > 0) {
        // Set upload directory (absolute path) and create it if it doesn't exist
        $uploadDir = __DIR__ . '/../../uploads/news/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Generate a unique filename to prevent overwrites
        $uniqueName = time() . '_' . basename($image['name']);
        $targetFile = $uploadDir . $uniqueName;
        // The path stored in DB (relative to the web root)
        $dbImagePath = 'uploads/news/' . $uniqueName;
        
        // Attempt to move the uploaded file
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Insert news update into the database
            $stmt = $conn->prepare("INSERT INTO news_updates (title, content, image_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $dbImagePath);
            
            if ($stmt->execute()) {
                header("Location: updates.php?success=1");
                exit();
            } else {
                $error = "Error adding news: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Failed to upload the image.";
        }
    } else {
        $error = "All fields are required.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input[type="text"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            background-color: #817ec7;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        button:hover {
            background-color: #6a679e;
        }
        .message {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .add-news-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #817ec7;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <header>
        <h2>Add News</h2>
        <a href="updates.php" class="add-news-btn">Go back</a>
        </header>
        <?php if ($error): ?>
            <p class="message error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="add_news.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" required></textarea>
            
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
            
            <button type="submit">Add News</button>
        </form>
    </div>
</body>
</html>