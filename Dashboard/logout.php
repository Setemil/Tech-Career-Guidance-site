<?php
    session_start();
    session_destroy();
    header("Location: ../LoginPage/index.php");
    exit();
?>