<?php
require_once('curl.php');

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

  $task = "0 0 * * * rm -f $file";
  exec("echo '$task' | crontab");
} else {
  echo "not working\n";
}

?>