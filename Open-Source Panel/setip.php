<?php
session_start();
require_once('func.php');

try {
    if (isset($_POST['ip'])) {
        $sanitizedIp = filter_var($_POST['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        if (!$sanitizedIp) {
            throw new InvalidArgumentException('Invalid IP format');
        }

        $newIp = decrypt_string($sanitizedIp);
        $_SESSION['ip'] = $newIp;
    } else {
        session_destroy();
        header('Location: https://example.com');
        exit;
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    header('Location: https://example.com?error=' . urlencode($e->getMessage()));
    exit;
}
