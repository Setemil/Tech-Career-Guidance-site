$(document).ready(function() {
    $('#course').change(function() {
        let courseId = $(this).val();
        if (courseId) {
            $.post('set_appointment.php', { course_id: courseId }, function(data) {
                let instructors = JSON.parse(data);
                let instructorDropdown = $('#instructor');
                instructorDropdown.empty();
                if (instructors.length > 0) {
                    instructorDropdown.append('<option value="">Select an instructor</option>');
                    instructors.forEach(function(instructor) {
                        instructorDropdown.append('<option value="' + instructor.id + '">' + instructor.name + '</option>');
                    });
                } else {
                    instructorDropdown.append('<option value="">No set instructors for selected course</option>');
                }
            });
        } else {
            $('#instructor').html('<option value="">Select a course first</option>');
        }
    });
});