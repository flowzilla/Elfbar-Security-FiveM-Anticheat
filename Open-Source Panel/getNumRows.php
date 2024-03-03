<?php
session_start();
$tableName = $_GET['tableName'];
function getNumRows($tableName)
{
  $conn = mysqli_connect("localhost", "root", "", "counter");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT COUNT(*) as count FROM $tableName";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  return $row['count'];
}

echo getNumRows($tableName);

?>