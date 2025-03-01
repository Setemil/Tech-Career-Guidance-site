<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card a {
            width: 80%;
            text-align: center;
        }
        header {
            background: white;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

    </style>
<div class="header" style="background-color: #817ec7;">
        <div class="header-left">
            <a href="main.php" style="text-decoration: none">
            <div class="brand-logo">
                    <i class="bi bi-star-fill" style="font-size: 2rem; color: white;"></i>
                    <span>TechCareers</span>
                </div>
            </a>
            <h2>Welcome, <?php echo isset($student['name']) ? htmlspecialchars($student['name']) : 'Guest'; ?></h2>
        </div>
        <div class="search-container">
            <i class="bi bi-search" style="font-size: 1.25rem; color: #3498db;"></i>
            <input type="text" placeholder="Search courses, paths, events...">
        </div>
        <div class="header-right">
            <div class="header-icons">
                <a href="main.php">
                    <div class="icon-wrapper" data-tooltip="Dashboard">
                        <i class="bi bi-house-door"></i>
                    </div>
                </a>
                <a href="paths.php">
                    <div class="icon-wrapper" data-tooltip="Career Paths">
                        <i class="bi bi-people"></i>
                    </div>
                </a>
                <a href="updates.php">
                    <div class="icon-wrapper" data-tooltip="Tech Updates">
                        <i class="bi bi-book"></i>
                    </div>
                </a>
                <a href="appointments.php">
                    <div class="icon-wrapper" data-tooltip="Consultation Sessions">
                        <i class="bi bi-calendar"></i>
                    </div>
                </a>
                <a href="profile.php">
                    <div class="icon-wrapper" data-tooltip="Profile Settings">
                        <i class="bi bi-person"></i>
                    </div>
                </a>
                
            </div>
            <div style="width: 7.5%">
                <a href="logout.php">
                    <button class="Btn" href="logout.php">
                        <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                        <div class="text">Logout</div>
                    </button>
                </a>
            </div>
        </div>
     </div>
</div>