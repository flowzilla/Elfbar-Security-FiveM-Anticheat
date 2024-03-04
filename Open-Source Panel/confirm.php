<?php
include('database.php');

$confirmation_code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_STRING);

$statement = $conn->prepare("SELECT * FROM users WHERE emailcode = ?");
$statement->bind_param("s", $confirmation_code);

$statement->execute();

$result = $statement->get_result();
$user = $result->fetch_assoc();

$statement->close();
$result->close();

if ($user) {
    $updateStatement = $mysqli->prepare("UPDATE users SET is_emailConfirmed = 1, emailcode = NULL WHERE userid = ?");
    $updateStatement->bind_param("i", $user['userid']);

    $updateStatement->execute();

    $updateStatement->close();

    header("Location: https://example.com/login?success=1");
    exit;
} else {
    header("Location: https://example.com/login?error=invalid_code");
    exit;
}

$mysqli->close();
