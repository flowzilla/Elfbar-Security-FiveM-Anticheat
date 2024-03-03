<?php

$pdo = new PDO("mysql:host=localhost;dbname=panel", "root", "");

$confirmation_code = $_GET['code'];

$statement = $pdo->prepare("SELECT * FROM users WHERE emailcode = ?");
$statement->execute([$confirmation_code]);
$user = $statement->fetch();

if ($user) {
  $statement = $pdo->prepare("UPDATE users SET is_emailConfirmed = 1, emailcode = NULL WHERE userid = ?");
  $statement->execute([$user['userid']]);
  header("Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatlogin?success=1");
} else {
  header("Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatlogin?success=0");
}
?>