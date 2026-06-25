<?php
session_start();

if (
    !isset($_SESSION['logged_in']) ||
    $_SESSION['logged_in'] !== true
) {
    header("Location: ../public/login.php");
    exit();
}

if (
    !isset($_SESSION['role']) ||
    strtoupper($_SESSION['role']) !== 'ADMIN'
) {
    session_destroy();
    header("Location: ../public/login.php?error=unauthorized");
    exit();
}
?>