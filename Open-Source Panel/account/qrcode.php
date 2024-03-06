<?php
require_once '../vendor/autoload.php';

try {
    require_once '../database.php';

    $ga = new PHPGangsta_GoogleAuthenticator();

    // Generate a secret key
    $secret = $ga->createSecret();

    $qrCodeUrl = $ga->getQRCodeGoogleUrl('EXAMPLE', $secret);

    $stmt = $conn->prepare("INSERT INTO users (secret_key) VALUES (?)");
    $stmt->bind_param("s", $secret);
    $stmt->execute();

    echo $qrCodeUrl;

} catch (Exception $e) {
    error_log($e->getMessage());
    echo "An error occurred. Please try again later.";
} finally {
    mysqli_close($conn);
}
