<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <?php
   // Check if user is logged in
        if (!isset($_SESSION['student_id'])) {
            header("Location: ../LoginPage/index.php");
            exit();
        }

   ?>
   <style>
    :root {
            --primary: #817ec7;
            --white: #ffffff;
            --dark: #333333;
            --transition: all 0.3s ease;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
        header {
            background: white;
            padding: 15px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }
        .header-container h2{
            color: var(--white);
        }
        .main-content{
            padding: 0;
            margin: 0;
            margin-top: 80px;
            overflow-x: hidden;
        }
        .header {
            background-color: var(--primary);
            padding: 1rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
        }

        .header-container {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            max-width: 100%;
            margin: 0 auto;
            gap: 1rem;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            color: var(--white);
            text-decoration: none;
        }

        .brand-logo i {
            margin-right: 0.5rem;
            font-size: 2rem;
        }

        .brand-logo span {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-link {
            color: var(--white);
            text-decoration: none;
            margin-left: 1.5rem;
            position: relative;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .nav-link i {
            margin-right: 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--white);
            transition: var(--transition);
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }
    

        .logout {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        .logout:hover {
            background-color: #c0392b;
        }
        .logout button{
            background: none;
            border: none;
            color: white;
        }
        /* From Uiverse.io by vinodjangid07 */ 
        .Btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 45px;
            height: 45px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition-duration: .3s;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
            background-color: rgb(255, 65, 65);
        }
        
        /* plus sign */
        .sign {
            width: 100%;
            transition-duration: .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sign svg {
            width: 17px;
        }
        
        .sign svg path {
            fill: white;
        }
        /* text */
        .text {
            position: absolute;
            right: 0%;
            width: 0%;
            opacity: 0;
            color: white;
            font-size: 1.2em;
            font-weight: 600;
            transition-duration: .3s;
        }
        /* hover effect on button width */
        .Btn:hover {
            width: 150px;
            border-radius: 40px;
            transition-duration: .3s;
        }
        
        .Btn:hover .sign {
            width: 30%;
            transition-duration: .3s;
            padding-left: 20px;
        }
        /* hover effect button's text */
        .Btn:hover .text {
            opacity: 1;
            width: 70%;
            transition-duration: .3s;
            padding-right: 10px;
        }
        /* button click effect*/
        .Btn:active {
            transform: translate(2px ,2px);
        }

        .mobile-menu-btn,
        .close-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
        }
        .logout-second{
            display: none;
        }

        @media screen and (max-width: 768px) {
            .logout-main{
                display: none;
            }
            .logout-second {
                display: flex !important;
                justify-content: center;
                align-items: center;
            }
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 45%;
                height: 100vh;
                background-color: var(--primary);
                flex-direction: column;
                align-items: flex-start;
                padding: 80px 2rem 2rem;
                transition: var(--transition);
                z-index: 1000;
            }

            .nav-links.active {
                right: 0;
            }

            .nav-link {
                margin: 1rem 0;
                width: 100%;
            }

            .mobile-menu-btn,
            .close-menu-btn {
                display: block;
                z-index: 1100;
            }

            .close-menu-btn {
                position: absolute;
                top: 20px;
                right: 20px;
            }

            .logout-btn {
                width: 100%;
                justify-content: center;
                margin-top: 1rem;
            }
            .header-container h2{
                font-size: 1rem;
            }
            .header-left span{
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="header-left">
                <a href="main.php" class="brand-logo">
                    <i class="bi bi-star-fill"></i>
                    <span>TechCareers</span>
                </a>
            </div>
            <div>
                <h2>Welcome, <?php echo isset($student['name']) ? htmlspecialchars($student['name']) : 'Guest'; ?></h2>
            </div>
            <div>
            <nav>
                <button class="mobile-menu-btn">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="nav-links">
                    <button class="close-menu-btn">
                        <i class="fas fa-times"></i>
                    </button>

                    <a href="main.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'main.php' ? 'active' : '' ?>">
                        <i class="bi bi-house-door"></i>Dashboard
                    </a>
                    <a href="paths.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'paths.php' ? 'active' : '' ?>">
                        <i class="bi bi-diagram-3"></i>Roadmaps
                    </a>
                    <a href="updates.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'updates.php' ? 'active' : '' ?>">
                        <i class="bi bi-book"></i>Updates
                    </a>
                    <a href="appointments.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'appointments.php' ? 'active' : '' ?>">
                        <i class="bi bi-calendar"></i>Appointments
                    </a>
                    <a href="recommendations.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'recommendations.php' ? 'active' : '' ?>">
                        <i class="bi bi-person"></i>Recommendations
                    </a>
                    <a href="profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                        <i class="bi bi-person"></i>Settings
                    </a>
                    <div style="width: 7.5%" class="logout-second">
                    <a href="logout.php">
                        <button class="Btn" href="logout.php">
                            <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                            <div class="text">Logout</div>
                        </button>
                    </a>
                </div>
                </div>

            </nav>
            </div>
            <div style="width: 7.5%" class="logout-main">
                <a href="logout.php">
                    <button class="Btn" href="logout.php">
                        <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                        <div class="text">Logout</div>
                    </button>
                </a>
            </div>
        </div>
    </header>
    <script src="../js/userscript.js"></script>