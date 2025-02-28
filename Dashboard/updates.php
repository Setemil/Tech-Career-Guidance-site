<?php
session_start();
require_once '../LoginPage/conn.php';

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: ../LoginPage/index.php");
    exit();
}

// Retrieve the logged-in student's name
$username = $_SESSION['name'];
$stmt = $conn->prepare("SELECT name FROM student WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$resultUser = $stmt->get_result();

// Fetch user details
if ($resultUser->num_rows === 1) {
    $student = $resultUser->fetch_assoc();
} else {
    session_destroy();
    header("Location: ../LoginPage/index.php?error=" . urlencode("Session expired. Please log in again."));
    exit();
}
$stmt->close();

// Fetch news updates from the database
$query = "SELECT * FROM news_updates ORDER BY created_at DESC";
$result = $conn->query($query);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Updates</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f4f4f4;
        }
        .news-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .news-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }
        .news-card:hover {
            transform: scale(1.05);
        }
        .news-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .news-title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        /* Popup styles */
        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            text-align: left;
            position: relative;
        }
        .popup img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .close-btn {
            background: red;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .no-news {
            font-size: 18px;
            color: gray;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php'; ?>
    <div class="main-content">
        <header>
            <h2>Tech Updates</h2>
        </header>
        <div class="news-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="news-card" onclick="openPopup('<?php echo addslashes(htmlspecialchars($row['title'])); ?>', '<?php echo addslashes(nl2br(htmlspecialchars($row['content']))); ?>', '<?php echo addslashes("../". htmlspecialchars($row['image_path'])); ?>')">
                        <img src="<?php echo '../'. htmlspecialchars($row['image_path']); ?>" alt="News Image">
                        <p class="news-title"><?php echo htmlspecialchars($row['title']); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-news">No tech updates available.</p>
            <?php endif; ?>
        </div>

        <!-- Popup window -->
        <div class="popup" id="popup">
            <div class="popup-content">
                <button class="close-btn" onclick="closePopup()">Close</button>
                <h2 id="popup-title"></h2>
                <img id="popup-image" src="" alt="News Image">
                <p id="popup-content"></p>
            </div>
        </div>
    </div>
    <script>
        function openPopup(title, content, imagePath) {
            document.getElementById("popup-title").innerText = title;
            document.getElementById("popup-content").innerHTML = content;
            document.getElementById("popup-image").src = imagePath;
            document.getElementById("popup").style.visibility = "visible";
            document.getElementById("popup").style.opacity = "1";
        }
        function closePopup() {
            document.getElementById("popup").style.visibility = "hidden";
            document.getElementById("popup").style.opacity = "0";
        }
    </script>
</body>
</html>