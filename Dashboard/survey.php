<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Career Survey</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .form-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 0.5rem;
            background-color: #f8f9fa;
        }
        .form-check {
            margin-bottom: 0.5rem;
        }
        .btn-primary {
            padding: 0.75rem 2rem;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .survey-instruction {
            margin-bottom: 1.5rem;
            font-style: italic;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Tech Career Guidance Survey</h3>
                    </div>
                    <div class="card-body">
                        <div class="survey-instruction">
                            <p>Welcome to our platform! To provide you with personalized course recommendations, please complete this short survey about your tech interests and goals.</p>
                        </div>
                        
                        <form action="process-survey.php" method="POST">
                            <div class="form-section">
                                <h5 class="required-field">1. What is your current tech experience level?</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience_level" id="exp_none" value="none" required>
                                    <label class="form-check-label" for="exp_none">No experience</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience_level" id="exp_beginner" value="beginner">
                                    <label class="form-check-label" for="exp_beginner">Beginner (basic understanding)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience_level" id="exp_intermediate" value="intermediate">
                                    <label class="form-check-label" for="exp_intermediate">Intermediate (some projects/courses)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="experience_level" id="exp_advanced" value="advanced">
                                    <label class="form-check-label" for="exp_advanced">Advanced (substantial experience)</label>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="required-field">2. Select your primary interest areas (up to 3):</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_1" value="1">
                                            <label class="form-check-label" for="interest_1">Web Development</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_2" value="2">
                                            <label class="form-check-label" for="interest_2">Mobile App Development</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_3" value="3">
                                            <label class="form-check-label" for="interest_3">Game Development</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_4" value="4">
                                            <label class="form-check-label" for="interest_4">Data Science/Analytics</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_5" value="5">
                                            <label class="form-check-label" for="interest_5">AI/Machine Learning</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_6" value="6">
                                            <label class="form-check-label" for="interest_6">Cybersecurity</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_7" value="7">
                                            <label class="form-check-label" for="interest_7">Cloud Computing</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_8" value="8">
                                            <label class="form-check-label" for="interest_8">DevOps</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_9" value="9">
                                            <label class="form-check-label" for="interest_9">UI/UX Design</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="interests[]" id="interest_10" value="10">
                                            <label class="form-check-label" for="interest_10">Blockchain/Cryptocurrency</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted small mt-2">Please select up to 3 areas that interest you most.</div>
                            </div>

                            <div class="form-section">
                                <h5 class="required-field">3. Select your preferred programming languages (up to 3):</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_1" value="1">
                                            <label class="form-check-label" for="lang_1">JavaScript</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_2" value="2">
                                            <label class="form-check-label" for="lang_2">Python</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_3" value="3">
                                            <label class="form-check-label" for="lang_3">Java</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_4" value="4">
                                            <label class="form-check-label" for="lang_4">C#</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_5" value="5">
                                            <label class="form-check-label" for="lang_5">PHP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_6" value="6">
                                            <label class="form-check-label" for="lang_6">Ruby</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_7" value="7">
                                            <label class="form-check-label" for="lang_7">Swift</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_8" value="8">
                                            <label class="form-check-label" for="lang_8">Kotlin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_9" value="9">
                                            <label class="form-check-label" for="lang_9">Go</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="languages[]" id="lang_10" value="10">
                                            <label class="form-check-label" for="lang_10">Rust</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted small mt-2">Please select up to 3 languages you're most interested in learning or using.</div>
                            </div>

                            <div class="form-section">
                                <h5 class="required-field">4. What is your preferred learning style?</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_style" id="visual" value="visual" required>
                                    <label class="form-check-label" for="visual">Visual (videos, diagrams)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_style" id="reading" value="reading">
                                    <label class="form-check-label" for="reading">Reading (documentation, articles)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_style" id="interactive" value="interactive">
                                    <label class="form-check-label" for="interactive">Interactive (coding exercises, projects)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_style" id="combination" value="combination">
                                    <label class="form-check-label" for="combination">Combination</label>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="required-field">5. What are your career goals?</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="career_goal" id="entry_level" value="entry_level" required>
                                    <label class="form-check-label" for="entry_level">Entry-level position</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="career_goal" id="career_switch" value="career_switch">
                                    <label class="form-check-label" for="career_switch">Career switch</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="career_goal" id="skill_enhancement" value="skill_enhancement">
                                    <label class="form-check-label" for="skill_enhancement">Skill enhancement</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="career_goal" id="personal_projects" value="personal_projects">
                                    <label class="form-check-label" for="personal_projects">Building personal projects</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="career_goal" id="entrepreneurship" value="entrepreneurship">
                                    <label class="form-check-label" for="entrepreneurship">Entrepreneurship</label>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="required-field">6. How much time can you dedicate to learning per week?</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_time" id="less_than_5" value="less_than_5" required>
                                    <label class="form-check-label" for="less_than_5">Less than 5 hours/week</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_time" id="5_to_10" value="5_to_10">
                                    <label class="form-check-label" for="5_to_10">5-10 hours/week</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_time" id="10_to_20" value="10_to_20">
                                    <label class="form-check-label" for="10_to_20">10-20 hours/week</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="learning_time" id="more_than_20" value="more_than_20">
                                    <label class="form-check-label" for="more_than_20">20+ hours/week</label>
                                </div>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">Submit Survey</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Limit interest selections to 3
    const interestCheckboxes = document.querySelectorAll('input[name="interests[]"]');
    limitCheckboxSelection(interestCheckboxes, 3, 'interests');
    
    // Limit language selections to 3
    const languageCheckboxes = document.querySelectorAll('input[name="languages[]"]');
    limitCheckboxSelection(languageCheckboxes, 3, 'languages');
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
    
    // Functions
    function limitCheckboxSelection(checkboxes, maxAllowed, groupName) {
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkedCount = document.querySelectorAll(`input[name="${groupName}[]"]:checked`).length;
                if (checkedCount > maxAllowed) {
                    this.checked = false;
                    alert(`You can only select up to ${maxAllowed} ${groupName}.`);
                }
            });
        });
    }
    
    function validateForm() {
        // Check if at least one interest is selected
        const interestChecked = document.querySelectorAll('input[name="interests[]"]:checked').length > 0;
        if (!interestChecked) {
            alert('Please select at least one interest area.');
            return false;
        }
        
        // Check if at least one language is selected
        const languageChecked = document.querySelectorAll('input[name="languages[]"]:checked').length > 0;
        if (!languageChecked) {
            alert('Please select at least one programming language.');
            return false;
        }
        
        // All validations passed
        return true;
    }
    
    // Add smooth scrolling to form sections
    const formSections = document.querySelectorAll('.form-section');
    formSections.forEach(section => {
        const heading = section.querySelector('h5');
        if (heading) {
            heading.addEventListener('click', function() {
                section.scrollIntoView({ behavior: 'smooth' });
            });
            // Add a subtle visual cue that sections are clickable
            heading.style.cursor = 'pointer';
        }
    });
    
    // Add progress indicator
    const progressContainer = document.createElement('div');
    progressContainer.className = 'progress mb-4';
    progressContainer.style.height = '8px';
    
    const progressBar = document.createElement('div');
    progressBar.className = 'progress-bar';
    progressBar.setAttribute('role', 'progressbar');
    progressBar.setAttribute('aria-valuenow', '0');
    progressBar.setAttribute('aria-valuemin', '0');
    progressBar.setAttribute('aria-valuemax', '100');
    
    progressContainer.appendChild(progressBar);
    
    const surveyInstruction = document.querySelector('.survey-instruction');
    surveyInstruction.parentNode.insertBefore(progressContainer, surveyInstruction.nextSibling);
    
    // Update progress bar as user completes sections
    const requiredInputs = document.querySelectorAll('input[required], input[name="interests[]"], input[name="languages[]"]');
    requiredInputs.forEach(input => {
        input.addEventListener('change', updateProgress);
    });
    
    function updateProgress() {
        const totalRequiredGroups = 6; // Experience, interests, languages, learning style, career goal, learning time
        let completedGroups = 0;
        
        // Check experience level
        if (document.querySelector('input[name="experience_level"]:checked')) {
            completedGroups++;
        }
        
        // Check interests
        if (document.querySelectorAll('input[name="interests[]"]:checked').length > 0) {
            completedGroups++;
        }
        
        // Check languages
        if (document.querySelectorAll('input[name="languages[]"]:checked').length > 0) {
            completedGroups++;
        }
        
        // Check learning style
        if (document.querySelector('input[name="learning_style"]:checked')) {
            completedGroups++;
        }
        
        // Check career goal
        if (document.querySelector('input[name="career_goal"]:checked')) {
            completedGroups++;
        }
        
        // Check learning time
        if (document.querySelector('input[name="learning_time"]:checked')) {
            completedGroups++;
        }
        
        const percentComplete = (completedGroups / totalRequiredGroups) * 100;
        progressBar.style.width = `${percentComplete}%`;
        progressBar.setAttribute('aria-valuenow', percentComplete);
        
        // Change color based on progress
        if (percentComplete < 33) {
            progressBar.className = 'progress-bar bg-danger';
        } else if (percentComplete < 66) {
            progressBar.className = 'progress-bar bg-warning';
        } else {
            progressBar.className = 'progress-bar bg-success';
        }
    }
    
    // Initialize progress on page load
    updateProgress();
});
    </script>
</body>
</html>