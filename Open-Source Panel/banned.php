<?php
include('database.php');

if (!isset($_SESSION['id']) || !isset($_SESSION['group'])) {
    error_log($_SESSION['id']);
    error_log($_SESSION["group"]);
    session_destroy();
    header("Location: https://panel.elfbar-security.eu/login");
    exit;
  }
  
  // Maintenance Function
  function is_maintenance(): bool
  {
    global $link;
    $result = mysqli_query($link, "SELECT maintenance FROM `system` WHERE maintenance = 1 LIMIT 1");
    return (mysqli_num_rows($result) > 0);
  }
  
  // Maintenance Check
  if (is_maintenance() && !($_SESSION["group"] == "admin")) {
    header('Location: https://panel.elfbar-security.eu/maintenance.php');
  }

echo "<title>You are permanently banned from the panel.</title>";