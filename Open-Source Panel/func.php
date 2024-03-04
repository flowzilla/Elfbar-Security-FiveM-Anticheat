<?php
session_start();

// DB 
include('database.php');

// Login check
if (!isset($_SESSION['id']) || !isset($_SESSION['group']) || empty($_SESSION['id']) || empty($_SESSION['group'])) {
  session_destroy();
  header("Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat/login");
  exit;
}

// Maintenance Function
function is_maintenance(): bool
{
  global $link;
  $result = mysqli_query($link, "SELECT maintenance FROM `system` WHERE maintenance = 1 LIMIT 1");
  return(mysqli_num_rows($result) > 0);
}

// Maintenance Check
if (is_maintenance() && !($_SESSION["group"] == "admin")) {
  header('Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat/maintenance.php');
}

// Ban Function
function is_banned(int $user_id): bool
{
  global $link;
  $result = mysqli_query($link, "SELECT userid FROM panelbans WHERE userid = $user_id");
  return(mysqli_num_rows($result) > 0);
}

// Ban Check
if (is_banned($_SESSION["id"])) {
  header('Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat/banned.php');
}

// Avatar 
$stmt = $conn->prepare("SELECT avatarurl FROM users WHERE userid = ? LIMIT 1");
$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
  $avatar = $row['avatarurl'];
}

// Admin check
function isAdmin()
{
  return $_SESSION["group"] == "admin";
}

$secretKey = 'imosec4343';

/**
 * Encrypts the given data using OpenSSL and the specified encryption method and key.
 *
 * @param string $data The data to be encrypted.
 * @param string $encryptionMethod The encryption method to be used (e.g. "AES-256-CBC").
 * @param string $secretKey The secret key to be used for encryption.
 *
 * @return string The encrypted data.
 */
function encrypt_string($data)
{
  global $secretKey;
  return openssl_encrypt('' . $data . '', 'aes-256-cbc', $secretKey);
}

/**
 * Decrypts the given data using OpenSSL and the specified encryption method and key.
 *
 * @param string $data The data to be decrypted.
 * @param string $encryptionMethod The encryption method used to encrypt the data (e.g. "AES-256-CBC").
 * @param string $secretKey The secret key used to encrypt the data.
 *
 * @return string The decrypted data.
 */
function decrypt_string($data)
{
  global $secretKey;
  return openssl_decrypt('' . $data . '', 'aes-256-cbc', $secretKey);
}