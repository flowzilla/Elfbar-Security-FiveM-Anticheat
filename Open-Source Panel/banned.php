<?php
include('database.php');

if (!isset($_SESSION['id']) || !isset($_SESSION['group']) || empty($_SESSION['id']) || empty($_SESSION['group'])) {
    error_log('Session data missing or empty.');
    session_destroy();
    header("Location: https://example.com/login");
    exit;
}

// Maintenance Function
function is_maintenance($link): bool
{
    $result = mysqli_query($link, "SELECT maintenance FROM `system` WHERE maintenance = 1 LIMIT 1");
    if (!$result) {
        return false;
    }
    return(mysqli_num_rows($result) > 0);
}

// Maintenance Check
if (is_maintenance($link) && !($_SESSION["group"] == "admin")) {
    header('Location: https://example.com/maintenance.php');
}

echo "<title>You are permanently banned from the panel.</title>";
