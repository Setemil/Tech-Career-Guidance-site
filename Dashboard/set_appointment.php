<?php
session_start();
require_once '../LoginPage/conn.php';

if (!isset($_SESSION['student_id'])) {
    $_SESSION['error_message'] = "User session invalid. Please log in again.";
    header("Location: ../LoginPage/index.php");
    exit();
}

$student_id = $_SESSION['student_id'];
if (!$username) {
    $_SESSION['error_message'] = "User session invalid. Please log in again.";
    header("Location: ../LoginPage/index.php");
    exit();
}

// Retrieve courses
$coursesQuery = "SELECT id, course_name FROM courses";
$coursesResult = $conn->query($coursesQuery);

// Handle AJAX request for fetching instructors based on course selection
if (isset($_POST['fetch_instructors']) && isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];
    $stmt = $conn->prepare("SELECT instructors.id, instructors.name FROM instructors 
                            JOIN instructor_courses ON instructors.id = instructor_courses.instructor_id 
                            WHERE instructor_courses.course_id = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $instructors = [];
    while ($row = $result->fetch_assoc()) {
        $instructors[] = $row;
    }
    echo json_encode($instructors);
    exit();
}

// Handle appointment booking
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_appointment'])) {
    $course_id = $_POST['course_id'];
    $instructor_id = $_POST['instructor_id'];
    $appointment_time = $_POST['appointment_time'];

    if (empty($course_id) || empty($instructor_id) || empty($appointment_time)) {
        $_SESSION['error_message'] = "All fields are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO appointments (student_id, instructor_id, course_id, appointment_time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $student_id, $instructor_id, $course_id, $appointment_time);
        
        if ($stmt->execute()) {
            header("Location: appointments.php?success=1");
            exit();
        } else {
            $_SESSION['error_message'] = "Error booking appointment.";
            header("Location: set_appointment.php");
            exit();
        }        
        $stmt->close();
    }
    header("Location: appointments.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Appointment</title>
    <link rel="stylesheet" href="../css/userstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 600px;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #4a47a3;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        select, .input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
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

        .button:hover {
            background-color: #6a679e;
        }

        .message {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php include 'menu-bar.php'; ?>
    
    <div class="main-content">
    <div class="container">
        <h1>Book an Appointment</h1>
        <a href="appointments.php" class="button">Go back</a>
        <br><br>
        <?php if (isset($_SESSION['success_message'])): ?>
            <p class="success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></p>
        <?php elseif (isset($_SESSION['error_message'])): ?>
            <p class="error"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Select Course:</label>
            <select name="course_id" id="course" required>
                <option value="">Select a course</option>
                <?php while ($row = $coursesResult->fetch_assoc()): ?>
                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['course_name']; ?> </option>
                <?php endwhile; ?>
            </select>

            <label>Select Instructor:</label>
            <select name="instructor_id" id="instructor" required>
                <option value="">Select a course first</option>
            </select>

            <label>Appointment Time:</label>
            <input class="input" type="datetime-local" name="appointment_time" required>

            <button class="button" type="submit" name="book_appointment">Book Appointment</button>
        </form>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#course").change(function() {
                var course_id = $(this).val();
                if (course_id) {
                    $.ajax({
                        type: "POST",
                        url: "set_appointment.php",
                        data: { fetch_instructors: 1, course_id: course_id },
                        dataType: "json",
                        success: function(response) {
                            var instructorDropdown = $("#instructor");
                            instructorDropdown.empty();
                            if (response.length > 0) {
                                instructorDropdown.append("<option value=''>Select an instructor</option>");
                                $.each(response, function(index, instructor) {
                                    instructorDropdown.append("<option value='" + instructor.id + "'>" + instructor.name + "</option>");
                                });
                            } else {
                                instructorDropdown.append("<option value=''>No set instructors for selected course</option>");
                            }
                        }
                    });
                } else {
                    $("#instructor").html("<option value=''>Select a course first</option>");
                }
            });
        });
    </script>
</body>
</html>
