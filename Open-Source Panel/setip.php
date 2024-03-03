<?php
session_start();

include('func.php');


if (!(isset($_POST['ip']))) {
  session_destroy();
  header("Location: https://panel.elfbar-security.eu");
}


if (isset($_POST['ip'])) {
  $newip = decrypt_string($_POST['ip']);
  $_SESSION["ip"] = $newip;
}