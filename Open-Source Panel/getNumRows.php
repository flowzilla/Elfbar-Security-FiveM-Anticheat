<?php
session_start();

$tableName = filter_input(INPUT_GET, 'tableName', FILTER_SANITIZE_STRING);

if (empty($tableName)) {
  die('Error: No table name provided.');
}

function getNumRows($tableName) {
  include('database.php');

  $sql = "SELECT COUNT(*) AS count FROM ?";
  $stmt = mysqli_prepare($stats, $sql);

  if (!$stmt) {
    die("Failed to prepare statement: " . mysqli_error($conn));
  }

  mysqli_stmt_bind_param($stmt, "s", $tableName);

  if (!mysqli_stmt_execute($stmt)) {
    die("Failed to execute statement: " . mysqli_stmt_error($stmt));
  }

  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  if (!$result) {
    die("Failed to retrieve result: " . mysqli_error($conn));
  }

  $row = mysqli_fetch_assoc($result);

  mysqli_free_result($result);

  return $row['count'];
}

$numRows = getNumRows($tableName);
echo $numRows;

mysqli_close($conn);
?>
