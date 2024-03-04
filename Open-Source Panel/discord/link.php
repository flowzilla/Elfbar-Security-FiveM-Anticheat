<?php
include('../func.php');
$discordClientId = '';
$discordClientSecret = '';
$discordRedirectUri = 'https://example.com/discord/link.php';
$discordScope = 'identify';
if (!isset($_GET['code'])) {
    $authUrl = 'https://discordapp.com/api/oauth2/authorize?client_id=' . $discordClientId . '&redirect_uri=' . urlencode($discordRedirectUri) . '&response_type=code&scope=' . urlencode($discordScope);
    header('Location: ' . $authUrl);
    die();
}
$tokenUrl = 'https://discordapp.com/api/oauth2/token';
$fields = [
    'client_id' => $discordClientId,
    'client_secret' => $discordClientSecret,
    'grant_type' => 'authorization_code',
    'code' => $_GET['code'],
    'redirect_uri' => $discordRedirectUri,
    'scope' => $discordScope,
];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $tokenUrl);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
$accessToken = json_decode($response)->access_token;
$userUrl = 'https://discordapp.com/api/users/@me';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $userUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$userData = json_decode(curl_exec($curl));
curl_close($curl);
$discordUserId = $userData->id;
$useridpanel = $_SESSION['id'];
$sql = "UPDATE users SET discord = ? WHERE userid = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ss", $discordUserId, $useridpanel);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
$Url = "https://example.com/account/";
header('Location: ' . $Url);
?>