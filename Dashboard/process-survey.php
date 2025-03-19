<?php

// Include database connection
include '../LoginPage/conn.php';

// For debugging during development, you can enable these:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Log function (writes to error log instead of displaying on screen)
function logError($message) {
    error_log($message);
    return $message;
}

// Function to safely redirect with error message
function redirectWithError($url, $message) {
    $_SESSION['survey_error'] = $message;
    header("Location: $url");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    redirectWithError("survey.php", "Form must be submitted properly.");
}

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    redirectWithError("../LoginPage/login.php?redirect=survey", "Please log in to submit your survey.");
}

// Check if student_id exists in session
if (!isset($_SESSION['student_id'])) {
    // Try to get student_id from database based on username
    $username = $_SESSION['username'];
    try {
        $stmt = $conn->prepare("SELECT id FROM student WHERE name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['student_id'] = $row['id'];
            $student_id = $row['id'];
        } else {
            redirectWithError("../LoginPage/login.php", "User account not found. Please log in again.");
        }
    } catch (Exception $e) {
        logError("Database error when getting student_id: " . $e->getMessage());
        redirectWithError("survey.php", "A database error occurred. Please try again later.");
    }
} else {
    $student_id = $_SESSION['student_id'];
}

// Validate required fields
$required_fields = ['experience_level', 'learning_style', 'career_goal', 'learning_time', 'interests', 'languages'];
$missing_fields = [];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        $missing_fields[] = $field;
    }
}

if (!empty($missing_fields)) {
    $fields_string = implode(', ', $missing_fields);
    redirectWithError("survey.php", "Please fill in all required fields. Missing: " . $fields_string);
}

// Get form data
$experience_level = $_POST['experience_level'];
$learning_style = $_POST['learning_style'];
$career_goal = $_POST['career_goal'];
$learning_time = $_POST['learning_time'];
$interests = $_POST['interests'];
$languages = $_POST['languages'];

// Validate the data
$valid_experience_levels = ['none', 'beginner', 'intermediate', 'advanced'];
$valid_learning_styles = ['visual', 'reading', 'interactive', 'combination'];
$valid_career_goals = ['entry_level', 'career_switch', 'skill_enhancement', 'personal_projects', 'entrepreneurship'];
$valid_learning_times = ['less_than_5', '5_to_10', '10_to_20', 'more_than_20'];

if (!in_array($experience_level, $valid_experience_levels)) {
    redirectWithError("survey.php", "Invalid experience level selected.");
}

if (!in_array($learning_style, $valid_learning_styles)) {
    redirectWithError("survey.php", "Invalid learning style selected.");
}

if (!in_array($career_goal, $valid_career_goals)) {
    redirectWithError("survey.php", "Invalid career goal selected.");
}

if (!in_array($learning_time, $valid_learning_times)) {
    redirectWithError("survey.php", "Invalid learning time selected.");
}

// Validate interests and languages (limit to 3 selections)
if (!is_array($interests) || count($interests) < 1 || count($interests) > 3) {
    redirectWithError("survey.php", "Please select between 1 and 3 interest areas.");
}

if (!is_array($languages) || count($languages) < 1 || count($languages) > 3) {
    redirectWithError("survey.php", "Please select between 1 and 3 programming languages.");
}

// Start transaction
$conn->begin_transaction();

try {
    // Check if student already has a survey response
    $check_stmt = $conn->prepare("SELECT id FROM survey_responses WHERE student_id = ?");
    $check_stmt->bind_param("i", $student_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing survey response
        $survey_row = $result->fetch_assoc();
        $survey_id = $survey_row['id'];
        
        $update_stmt = $conn->prepare("UPDATE survey_responses SET 
                                       experience_level = ?, 
                                       learning_style = ?, 
                                       career_goal = ?, 
                                       learning_time = ?, 
                                       survey_date = CURRENT_TIMESTAMP 
                                       WHERE id = ?");
        $update_stmt->bind_param("ssssi", $experience_level, $learning_style, $career_goal, $learning_time, $survey_id);
        $update_stmt->execute();
        
        // Delete existing interest connections
        $delete_interests = $conn->prepare("DELETE FROM student_interests WHERE student_id = ?");
        $delete_interests->bind_param("i", $student_id);
        $delete_interests->execute();
        
        // Delete existing language connections
        $delete_languages = $conn->prepare("DELETE FROM student_languages WHERE student_id = ?");
        $delete_languages->bind_param("i", $student_id);
        $delete_languages->execute();
    } else {
        // Insert new survey response
        $insert_stmt = $conn->prepare("INSERT INTO survey_responses 
                                       (student_id, experience_level, learning_style, career_goal, learning_time) 
                                       VALUES (?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("issss", $student_id, $experience_level, $learning_style, $career_goal, $learning_time);
        $insert_stmt->execute();
        $survey_id = $conn->insert_id;
    }
    
    // Insert new interest connections
    $interest_stmt = $conn->prepare("INSERT INTO student_interests (student_id, interest_id) VALUES (?, ?)");
    foreach ($interests as $interest_id) {
        $interest_id = (int)$interest_id; // Ensure it's an integer
        $interest_stmt->bind_param("ii", $student_id, $interest_id);
        $interest_stmt->execute();
    }
    
    // Insert new language connections
    $language_stmt = $conn->prepare("INSERT INTO student_languages (student_id, language_id) VALUES (?, ?)");
    foreach ($languages as $language_id) {
        $language_id = (int)$language_id; // Ensure it's an integer
        $language_stmt->bind_param("ii", $student_id, $language_id);
        $language_stmt->execute();
    }
    
    // Commit the transaction
    $conn->commit();
    
    // Store success message in session
    $_SESSION['survey_success'] = "Your survey has been submitted successfully. We'll now provide personalized course recommendations!";
    
    // Redirect to dashboard or recommendations page
    header("Location: recommendations.php");
    exit();
    
} catch (Exception $e) {
    // Roll back the transaction in case of error
    $conn->rollback();
    
    // Log the error
    logError("Survey submission error: " . $e->getMessage());
    
    // Redirect back to the survey form with a user-friendly error
    redirectWithError("survey.php", "An error occurred while processing your survey. Please try again later.");
}

// Close the database connection
$conn->close();
?>