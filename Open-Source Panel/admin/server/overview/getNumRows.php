<?php
$tableName = $_GET['id'];
$row = '';
if ($tableName == "cpu") {
  function getCpuUsage()
  {
    $loads = sys_getloadavg();
    $core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
    $load = round($loads[0] / ($core_nums + 1) * 100, 2);
    return round($load, 4);
  }
  $row2 = getCpuUsage();
  $row .= (string) $row2;
  $row .= "%";
} elseif ($tableName == "ram") {
  $memory_usage = (int) shell_exec('free -kt | grep Mem | awk \'{print $3}\'');
  $memory_total = (int) shell_exec('free -kt | grep Mem | awk \'{print $2}\'');
  $row2 = round(($memory_usage / $memory_total) * 100);
  $row .= (string) $row2;
  $row .= "%";
} elseif ($tableName == "count") {
  $dir = "/var/www/cdn.imoshield.net/upload/img";
  $handle = opendir($dir);
  $row = 0;
  while (false !== ($entry = readdir($handle))) {
    if ($entry != ".." && $entry != ".") {
      $row++;
    }
  }
  closedir($handle);
} elseif ($tableName == "size") {
  $folderPath = '/var/www/cdn.imoshield.net/upload/img';
  $folderSize = 0;
  foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath)) as $file) {
    $folderSize += $file->getSize();
  }
  $row2 = round($folderSize / 1024 / 1024);
  $row .= (string) $row2;
  $row .= " MB";
}
echo $row;
?>