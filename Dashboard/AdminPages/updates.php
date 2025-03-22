<?php
session_start();
require_once '../../LoginPage/conn.php';

// Fetch news updates from the correct table
$query = "SELECT * FROM news_updates ORDER BY created_at DESC";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest Tech News</title>
    <link rel="stylesheet" href="../../css/adminstyle.css">
    <style>
        .news-container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .news-card {
            background: #f9f9f9;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
            width: 60%;
            text-align: center;
        }
        .news-card img {
            width: 80%;
            max-width: 400px;
            height: auto;
            border-radius: 8px;
            display: block;
            margin: 0 auto;
        }
        .news-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .delete-btn {
            background: red;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .add-news-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #817ec7;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
        <header>
            <h2>Tech Updates</h2>
        </header>
        <a href="add_news.php" class="add-news-btn">Add News</a>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="news-card">
                    <!-- Prepend '../../' to ensure correct relative path to the image file -->
                    <img src="../../<?php echo htmlspecialchars($row['image_path']); ?>" alt="News Image">
                    <p class="news-title"><?php echo htmlspecialchars($row['title']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
                    <form action="delete_news.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this news item?');">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No news updates available.</p>
        <?php endif; ?>
    </div>
</body>
</html>