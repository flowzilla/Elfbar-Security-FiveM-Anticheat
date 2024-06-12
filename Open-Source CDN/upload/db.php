<?php
error_reporting(0);

$conn = mysqli_connect("localhost", "", "", "counter");

if ($link === false) {

    die("ERROR: Could not connect. " . mysqli_connect_error());

}
?>