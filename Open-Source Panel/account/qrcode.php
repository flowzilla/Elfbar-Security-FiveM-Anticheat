<?php
require_once '../vendor/autoload.php';
include('../database.php');
use PHPGangsta_GoogleAuthenticator;

$ga = new PHPGangsta_GoogleAuthenticator();

$secret = $ga->createSecret();

$qrCodeUrl = $ga->getQRCodeGoogleUrl('ImoShield', $secret);


echo $secret;
echo $qrCodeUrl;
mysqli_close($conn);
?>