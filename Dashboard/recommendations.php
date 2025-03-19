<?php
// Start session
session_start();

// Include database connection
include '../LoginPage/conn.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if student_id exists in session
if (!isset($_SESSION['student_id'])) {
    // Try to get student_id from database based on username
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT id, name FROM student WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['student_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $student_id = $row['id'];
        $student_name = $row['name'];
    } else {
        // If no student found, redirect to error page or login
        $_SESSION['error'] = "User account not found. Please log in again.";
        header("Location: login.php");
        exit();
    }
} else {
    $student_id = $_SESSION['student_id'];
    $student_name = $_SESSION['name'] ?? 'Student';
}

// Check if the user has completed the survey
$survey_check = $conn->prepare("SELECT * FROM survey_responses WHERE student_id = ?");
$survey_check->bind_param("i", $student_id);
$survey_check->execute();
$survey_result = $survey_check->get_result();

if ($survey_result->num_rows == 0) {
    // Redirect to survey if not completed
    $_SESSION['survey_needed'] = "Please complete the survey to get personalized recommendations.";
    header("Location: survey.php");
    exit();
}

// Get user survey data
$survey_data = $survey_result->fetch_assoc();
$experience_level = $survey_data['experience_level'];
$learning_style = $survey_data['learning_style'];
$career_goal = $survey_data['career_goal'];
$learning_time = $survey_data['learning_time'];

// Get user interests
$interests_query = $conn->prepare("
    SELECT i.id, i.name 
    FROM student_interests si
    JOIN interest_areas i ON si.interest_id = i.id
    WHERE si.student_id = ?
");
$interests_query->bind_param("i", $student_id);
$interests_query->execute();
$interests_result = $interests_query->get_result();

$interests = [];
while ($row = $interests_result->fetch_assoc()) {
    $interests[] = $row;
}

// Get user languages
$languages_query = $conn->prepare("
    SELECT l.id, l.name 
    FROM student_languages sl
    JOIN programming_languages l ON sl.language_id = l.id
    WHERE sl.student_id = ?
");
$languages_query->bind_param("i", $student_id);
$languages_query->execute();
$languages_result = $languages_query->get_result();

$languages = [];
while ($row = $languages_result->fetch_assoc()) {
    $languages[] = $row;
}

// Build arrays of interest IDs and language IDs for use in queries
$interest_ids = [];
foreach ($interests as $interest) {
    $interest_ids[] = $interest['id'];
}

$language_ids = [];
foreach ($languages as $language) {
    $language_ids[] = $language['id'];
}

// Get recommended courses based on user profile
$recommended_courses = [];

// First approach: Get courses that match the user's experience level and interests
if (!empty($interest_ids)) {
    $interest_id_list = implode(',', array_fill(0, count($interest_ids), '?'));
    
    $query = "
        SELECT c.*, ci.interest_id 
        FROM courses c
        JOIN course_interests ci ON c.id = ci.course_id
        WHERE c.difficulty_level = ? 
        AND ci.interest_id IN ($interest_id_list)
        GROUP BY c.id
        ORDER BY c.rating DESC
    ";
    
    $stmt = $conn->prepare($query);
    
    // Build the parameter types string
    $types = "s" . str_repeat("i", count($interest_ids));
    
    // Create array of parameters with references
    $params = array($types);
    $params[] = &$experience_level; // Add reference to experience_level
    
    // Add references to each interest_id
    foreach ($interest_ids as $key => $value) {
        $interest_ids[$key] = &$interest_ids[$key];
        $params[] = &$interest_ids[$key];
    }
    
    // Call bind_param with the unpacked array
    call_user_func_array([$stmt, 'bind_param'], $params);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $row['match_reason'] = 'Matches your experience level and interests';
        $row['match_score'] = 90;
        $recommended_courses[$row['id']] = $row;
    }
}

// Second approach: Get courses that match the user's learning style
$query = "
    SELECT c.* 
    FROM courses c
    WHERE c.learning_style = ?
    ORDER BY c.rating DESC
    LIMIT 5
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $learning_style);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if (!isset($recommended_courses[$row['id']])) {
        $row['match_reason'] = 'Matches your learning style';
        $row['match_score'] = 75;
        $recommended_courses[$row['id']] = $row;
    }
}

// Third approach: Get courses related to the user's career goal
$query = "
    SELECT c.* 
    FROM courses c
    WHERE c.career_path = ?
    ORDER BY c.rating DESC
    LIMIT 5
";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $career_goal);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    if (!isset($recommended_courses[$row['id']])) {
        $row['match_reason'] = 'Aligns with your career goal';
        $row['match_score'] = 80;
        $recommended_courses[$row['id']] = $row;
    }
}

// Fourth approach: Get courses that match the user's programming languages
if (!empty($language_ids)) {
    $language_id_list = implode(',', array_fill(0, count($language_ids), '?'));
    
    $query = "
        SELECT c.*, cl.language_id 
        FROM courses c
        JOIN course_languages cl ON c.id = cl.course_id
        WHERE cl.language_id IN ($language_id_list)
        GROUP BY c.id
        ORDER BY c.rating DESC
    ";
    
    $stmt = $conn->prepare($query);
    
    // Build the parameter types string
    $types = str_repeat("i", count($language_ids));
    
    // Create array of parameters with references
    $params = array($types);
    
    // Add references to each language_id
    foreach ($language_ids as $key => $value) {
        $language_ids[$key] = &$language_ids[$key];
        $params[] = &$language_ids[$key];
    }
    
    // Call bind_param with the unpacked array
    call_user_func_array([$stmt, 'bind_param'], $params);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        if (!isset($recommended_courses[$row['id']])) {
            $row['match_reason'] = 'Uses programming languages you know';
            $row['match_score'] = 70;
            $recommended_courses[$row['id']] = $row;
        }
    }
}

// If no courses matched the specific criteria, get some general recommendations
if (empty($recommended_courses)) {
    $query = "
        SELECT * 
        FROM courses
        WHERE difficulty_level = ?
        ORDER BY rating DESC
        LIMIT 5
    ";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $experience_level);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $row['match_reason'] = 'Based on your experience level';
        $row['match_score'] = 60;
        $recommended_courses[$row['id']] = $row;
    }
}

// Sort recommended courses by match score
usort($recommended_courses, function($a, $b) {
    return $b['match_score'] - $a['match_score'];
});

// Function to format learning time
function formatLearningTime($time) {
    switch($time) {
        case 'less_than_5': return 'Less than 5 hours/week';
        case '5_to_10': return '5-10 hours/week';
        case '10_to_20': return '10-20 hours/week';
        case 'more_than_20': return 'More than 20 hours/week';
        default: return $time;
    }
}

// Function to format career goal
function formatCareerGoal($goal) {
    return ucwords(str_replace('_', ' ', $goal));
}

// Get all courses for the language-course mapping table
$all_courses_query = "SELECT id, course_name FROM courses ORDER BY course_name";
$all_courses_result = $conn->query($all_courses_query);
$all_courses = [];
while ($row = $all_courses_result->fetch_assoc()) {
    $all_courses[] = $row;
}

// Get all programming languages for the language-course mapping table
$all_languages_query = "SELECT id, name FROM programming_languages ORDER BY name";
$all_languages_result = $conn->query($all_languages_query);
$all_languages = [];
while ($row = $all_languages_result->fetch_assoc()) {
    $all_languages[] = $row;
}

// Get language-course mappings
$mapping_query = "
    SELECT cl.course_id, cl.language_id 
    FROM course_languages cl
";
$mapping_result = $conn->query($mapping_query);
$language_course_mappings = [];
while ($row = $mapping_result->fetch_assoc()) {
    $language_course_mappings[$row['language_id']][] = $row['course_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Recommendations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap");
        body{
            font-family: 'Outfit', sans-serif;
        }
        .recommendation-card {
            margin-bottom: 1.5rem;
            transition: transform 0.2s;
            position: relative;
            overflow: hidden;
        }
        .recommendation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .match-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
        .difficulty-beginner { border-left: 5px solid #28a745; }
        .difficulty-intermediate { border-left: 5px solid #ffc107; }
        .difficulty-advanced { border-left: 5px solid #dc3545; }
        .profile-summary {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .tag {
            display: inline-block;
            padding: 0.3rem 0.6rem;
            margin: 0.2rem;
            border-radius: 0.25rem;
            background-color: #e2e3e5;
            font-size: 0.85rem;
        }
        .interests-tag { background-color: #d1e7dd; }
        .languages-tag { background-color: #cfe2ff; }
        .card-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .difficulty-badge {
            font-size: 0.8rem;
            padding: 0.3em 0.6em;
            margin-left: 0.5rem;
        }
        .recommendations-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .no-recommendations {
            padding: 3rem;
            text-align: center;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            margin-top: 2rem;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .course-image {
            height: 200px;
            object-fit: cover;
        }
        .table-responsive {
            margin-top: 2rem;
        }
        .check-mark {
            color: #28a745;
        }
        .mapping-table th, .mapping-table td {
            font-size: 0.85rem;
            padding: 0.5rem;
        }
        .section-divider {
            margin: 3rem 0;
            border-top: 1px solid #dee2e6;
            padding-top: 2rem;
        }
    </style>
</head>
<body>
    <!-- <?php include 'menu-bar.php'; ?> -->
    <div class="main-content">
    <div class="container mt-5 mb-5">
        <div class="header-actions">
            <h1>Your Personalized Course Recommendations</h1>
            <a href="main.php" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> Head to Dashboard</a>
        </div>
        
        <?php if (isset($_SESSION['survey_success'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['survey_success']; 
                    unset($_SESSION['survey_success']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="profile-summary">
            <h3>Your Learning Profile</h3>
            <div class="row">
                <div class="col-md-6">
                    <p><strong><i class="fas fa-chart-line"></i> Experience Level:</strong> <?php echo ucfirst($experience_level); ?></p>
                    <p><strong><i class="fas fa-brain"></i> Learning Style:</strong> <?php echo ucfirst($learning_style); ?></p>
                    <p><strong><i class="fas fa-bullseye"></i> Career Goal:</strong> <?php echo formatCareerGoal($career_goal); ?></p>
                    <p><strong><i class="fas fa-clock"></i> Learning Time:</strong> <?php echo formatLearningTime($learning_time); ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong><i class="fas fa-lightbulb"></i> Your Interests:</strong></p>
                    <div>
                        <?php if (empty($interests)): ?>
                            <span class="text-muted">No interests selected</span>
                        <?php else: ?>
                            <?php foreach ($interests as $interest): ?>
                                <span class="tag interests-tag"><?php echo $interest['name']; ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <p class="mt-3"><strong><i class="fas fa-code"></i> Your Programming Languages:</strong></p>
                    <div>
                        <?php if (empty($languages)): ?>
                            <span class="text-muted">No languages selected</span>
                        <?php else: ?>
                            <?php foreach ($languages as $language): ?>
                                <span class="tag languages-tag"><?php echo $language['name']; ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="recommendations-container">
            <h2 class="mb-4"><i class="fas fa-graduation-cap"></i> Recommended Courses</h2>
            
            <?php if (!empty($recommended_courses)): ?>
                <div class="row">
                    <?php foreach ($recommended_courses as $course): ?>
                        <div class="col-md-4">
                            <div class="card recommendation-card difficulty-<?php echo strtolower($course['difficulty_level']); ?>">
                                <span class="badge bg-success match-badge"><?php echo $course['match_score']; ?>% Match</span>
                                <?php
                                    // Default image if none provided
                                    $image_url = !empty($course['course_image']) ? $course['course_image'] : 'https://via.placeholder.com/400x200?text=Course+Image';
                                ?>
                                <img src="<?php echo $image_url; ?>" class="card-img-top course-image" alt="<?php echo htmlspecialchars($course['course_name']); ?>">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo htmlspecialchars($course['course_name']); ?>
                                        <span class="badge bg-<?php 
                                            echo $course['difficulty_level'] == 'beginner' ? 'success' : 
                                                 ($course['difficulty_level'] == 'intermediate' ? 'warning' : 'danger'); 
                                        ?> difficulty-badge"><?php echo ucfirst($course['difficulty_level']); ?></span>
                                    </h5>
                                    <h6 class="card-subtitle mb-2"><?php echo htmlspecialchars($course['provider']); ?></h6>
                                    <p class="card-text"><?php echo htmlspecialchars(substr($course['description'], 0, 120)) . '...'; ?></p>
                                    <p class="small text-muted"><i class="fas fa-star text-warning"></i> <?php echo htmlspecialchars($course['rating']); ?>/5 • <?php echo htmlspecialchars($course['duration']); ?> hours</p>
                                    <p class="small"><strong>Why recommended:</strong> <?php echo $course['match_reason']; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <a href="course-details.php?id=<?php echo $course['id']; ?>" class="btn btn-primary">View Details</a>
                                        <button class="btn btn-outline-secondary save-course" data-course-id="<?php echo $course['id']; ?>">
                                            <i class="far fa-bookmark"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-recommendations">
                    <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                    <h3>No Matching Courses Found</h3>
                    <p class="text-muted">We couldn't find any courses matching your preferences.</p>
                    <p>Try updating your survey preferences to broaden your options.</p>
                    <div class="mt-3 text-end">
                        <a href="survey.php" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-edit"></i> Update Preferences
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        
        <div class="mt-5 pt-3 border-top">
            <h3>Explore More Learning Resources</h3>
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5><i class="fas fa-users"></i> Set up appointment</h5>
                            <p>Connect with mentors to discuss your learning journey.</p>
                            <a href="appointments.php" class="btn btn-sm btn-outline-primary">Set Up Meeting</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5><i class="fas fa-book"></i> Learning Paths</h5>
                            <p>Follow structured learning paths designed for specific career goals.</p>
                            <a href="paths.php" class="btn btn-sm btn-outline-primary">View Paths</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5><i class="bi bi-book"></i> Tech News</h5>
                            <p>Access latest information of the world of tech around you</p>
                            <a href="updates.php" class="btn btn-sm btn-outline-primary">Explore Resources</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize any interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add JavaScript functionality for save buttons
            const saveButtons = document.querySelectorAll('.save-course');
            
            saveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.classList.remove('btn-outline-secondary');
                        this.classList.add('btn-secondary');
                        
                        // Optional: Save to database via AJAX
                        const courseId = this.getAttribute('data-course-id');
                        saveCourseToWishlist(courseId);
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.classList.remove('btn-secondary');
                        this.classList.add('btn-outline-secondary');
                        
                        // Optional: Remove from database via AJAX
                        const courseId = this.getAttribute('data-course-id');
                        removeCourseFromWishlist(courseId);
                    }
                });
            });
            
            // Function to save course to wishlist (implement AJAX call)
            function saveCourseToWishlist(courseId) {
                // You can implement AJAX call to save to database
                console.log("Saving course ID: " + courseId);
                
                // Example AJAX implementation:
                /*
                fetch('save_course.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'course_id=' + courseId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Course saved successfully');
                    } else {
                        console.error('Error saving course');
                    }
                });
                */
            }
            
            // Function to remove course from wishlist (implement AJAX call)
            function removeCourseFromWishlist(courseId) {
                // You can implement AJAX call to remove from database
                console.log("Removing course ID: " + courseId);
                
                // Example AJAX implementation similar to above
            }
        });
    </script>
</body>
</html>