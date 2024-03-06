<?php
include('database.php');
session_start();
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

 $user_id = $_SESSION['id'] ?? 0;
  $result = mysqli_query($link, "SELECT userid, reason FROM panelbans WHERE userid = $user_id");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<title>You are permanently banned from the panel.</title>";
        echo "<p>Reason: " . $row['reason'] . "</p>";
        echo "<p>If you believe this is a mistake, please contact support.</p>";
        exit;
    }

