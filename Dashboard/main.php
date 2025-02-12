<?php
session_start();
require_once '../LoginPage/conn.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    header("Location: index.php");
    exit();
}

// Retrieve the logged-in student's name
$username = $_SESSION['name'];

$stmt = $conn->prepare("SELECT name FROM student WHERE name = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user details
if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
} else {
    // If no matching user is found, force logout
    session_destroy();
    header("Location: index.php?error=" . urlencode("Session expired. Please log in again."));
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Careers Portal - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/userstyle.css">
    <style>
        .header{
            background-color: #6a679e;
        }
        .cta-button{
            background-color: #a7a3f0;
        }
        .cta-button:hover{
            background-color: #6a679e;
        }
    </style>
 
</head>
<body>
    <?php include 'menu-bar.php'?>
        <div class="main-content">
        <div class="cards">
            <div class="card">
                <img src="web-development-icon.jpeg" alt="Web Development">
                <div class="card-content">
                    <h3>Web Development</h3>
                    <a href="/web-development" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="python.jpeg" alt="Python Programming">
                <div class="card-content">
                    <h3>Python Programming</h3>
                    <a href="/python-programming" class="cta-button">Explore Path</a>
                </div>
            </div>
            
            <div class="card">
                <img src="product-management.jpeg" alt="Product Management">
                <div class="card-content">
                    <h3>Product Management</h3>
                    <a href="/product-management" class="cta-button">Explore Path</a>
                </div>
            </div>
            
            <div class="card">
                <img src="data-science.jpeg" alt="Data Science">
                <div class="card-content">
                    <h3>Data Science</h3>
                    <a href="/data-science" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <!-- Continue for other cards... -->
            <div class="card">
                <img src="product-design.jpeg" alt="Product Design">
                <div class="card-content">
                    <h3>Product Design</h3>
                    <a href="/product-design" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="project-management.jpeg" alt="Project Management">
                <div class="card-content">
                    <h3>Project Management</h3>
                    <a href="/project-management" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="Data-Analytics.jpeg" alt="Data Analytics">
                <div class="card-content">
                    <h3>Data Analytics</h3>
                    <a href="/data-analytics" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="UI-UX.jpeg" alt="UI/UX Design">
                <div class="card-content">
                    <h3>UI/UX Design</h3>
                    <a href="/ui-ux-design" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="Cloud-Computing.jpeg" alt="Cloud Computing">
                <div class="card-content">
                    <h3>Cloud Computing</h3>
                    <a href="/cloud-computing" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="Cybersecurity.jpeg" alt="Cybersecurity">
                <div class="card-content">
                    <h3>Cybersecurity</h3>
                    <a href="/cybersecurity" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="Machine-Learning.jpeg" alt="Machine Learning">
                <div class="card-content">
                    <h3>Machine Learning</h3>
                    <a href="/machine-learning" class="cta-button">Explore Path</a>
                </div>
            </div>
        
            <div class="card">
                <img src="Technical-Writting.jpeg" alt="Technical Writing">
                <div class="card-content">
                    <h3>Technical Writing</h3>
                    <a href="/technical-writing" class="cta-button">Explore Path</a>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>