<?php
//error_reporting(0);
$host = "";
$username = "";
$password = "";

$link = mysqli_connect($host, $username, $password , "panel");
$conn = mysqli_connect($host, $username, $password , "panel");
$stats = mysqli_connect($host, $username, $password , "counter");
$stats2 = mysqli_connect($host, $username, $password , "panel");
$logs = mysqli_connect($host, $username, $password , "logs");
$svbans = mysqli_connect($host, $username, $password , "serverbans");
$authy = mysqli_connect($host, $username, $password , "auth");


if ($link === false) {

    die("ERROR: Could not connect. " . mysqli_connect_error());

}
