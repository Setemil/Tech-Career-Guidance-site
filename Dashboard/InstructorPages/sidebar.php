<style>
    .main-content {
    width: 100%;
    margin-left: 300px;
    padding: 20px;
}
header {
    background: white;
    padding: 15px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

th {
  background-color: #817ec7; /* Your primary color */
  color: white;
}

td {
  background-color: #f9f9f9;
}

tr:hover {
  background-color: #f1f1f1;
}

</style>
<div class="sidebar">
        <h2>Instructors Panel</h2>
        <ul>
            <li><a href="main.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'main.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="appointment.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'appointment.php' ? 'active' : '' ?>">Appointments</a></li>
            <li><a href="settings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : '' ?>">Settings</a></li>
            <li>
            <div style="width: 8%">
                <a href="logout.php">
                    <button class="Btn" href="logout.php">
                        <div class="sign"><svg viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                        <div class="text">Logout</div>
                    </button>
                </a>
            </div>
            </li>
        </ul>
    </div>