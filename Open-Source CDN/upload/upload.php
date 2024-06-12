<?php
require_once ('curl.php');
include 'db.php';

$path = 'img/';
$fileName = rand(0, 9999999999999) . '.jpg';
$file = $path . $fileName;
$url = "https://cdn.example.com/upload/img/";
if (move_uploaded_file($_FILES['files']['tmp_name'][0], $file)) {

  $expiration = time() + (10 * 24 * 60 * 60);

  $result = [
    "success" => true,
    "files" => [
      [
        "hash" => $fileName,
        "name" => $fileName,
        "url" => $url . $fileName,
        "size" => $_FILES['files']['size'][0],
        "expiration" => $expiration
      ]
    ],
  ];
  print_r(json_encode($result));

  $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
  $stmt = $conn->prepare("INSERT INTO totalscreenshots (license) VALUES (?)");
  $stmt->bind_param("s", $ip);
  $stmt->execute();
  $stmt->close();
  $conn->close();

  $task = "0 0 * * * rm -f $file";
  exec("echo '$task' | crontab");
} else {
  echo "Its not working\n";
}


?>