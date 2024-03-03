<?php
session_start();
include('../func.php');

if (empty($_SESSION['ip'])) {
  session_destroy();
  header("Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatlogin");
}
$result = $conn->query("SELECT server.serverip,users.userid FROM server JOIN users_server ON users_server.serverid = server.serverid JOIN users ON users.userid = users_server.userid");
$match_found = false;
while ($row = $result->fetch_assoc()) {
  if ($row['serverip'] == $_SESSION['ip'] && $row['userid'] == $_SESSION['id']) {
    $match_found = true;
    break;
  }
}
if ($match_found) {
} else {
  header("Location: https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat");
}

$query = "SELECT redem_license.license FROM users_server 
  JOIN server ON users_server.serverid = server.serverid
  JOIN redem_license ON redem_license.serverid = server.serverid
  WHERE users_server.userid = '" . $_SESSION["id"] . "' AND server.serverip = '" . $_SESSION["ip"] . "'";
$result = $link->query($query);
$row = $result->fetch_assoc();
$license = $row['license'];

if (isset($_POST['restart'])) {
  $id2 = "restart";
  $id = "5000";
  $ipi = $_SESSION['ip'];
  $sql = "INSERT INTO playerlist (id, reason, ip) VALUES (?, ?, ?)";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, "sss", $id, $id2, $ipi);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  echo '<script type="text/javascript">';
  echo 'setTimeout(function () { sweetAlert("<b>Panel System","Server restarted successfully</b>","success");';
  echo '}, 500);</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Elfbar-Security">
  <meta name="keywords" content="fivem, anticheat, anticheat leaked, free anticheat, imoshield, fivem ac">
  <meta name="author" content="ImoShield LTC.">
  <link rel="icon" href="https://cdn.elfbar-security.eu/assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="https://cdn.elfbar-security.eu/assets/images/favicon.png" type="image/x-icon">
  <title>Elfbar-Security | Panel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/icofont.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/flag-icon.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/style.css">
  <link id="color" rel="stylesheet" href="https://cdn.elfbar-security.eu/assets/css/color-1.css" media="screen">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/responsive.css">
  <style>
    ::-webkit-scrollbar {
      width: 12px;
    }

    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px rgb(46, 41, 66);
      border-radius: 6px;
    }

    ::-webkit-scrollbar-thumb {
      background: rgb(42, 41, 48);
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: rgb(54, 54, 80);
    }

    .dd {
      padding: 0.375rem 1.75rem;
      position: absolute;
      display: flex;
      right: 250px;
      margin: 30px;
    }

    .ddd {
      right: 280px;
      font-size: 22px;
      display: flex;
      position: absolute;
    }

    .page-wrapper .page-body-wrapper .page-title .row {
      align-items: normal;
    }
  </style>
  <script>
    function setWrapperClass() {
      $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper");
    }
  </script>
</head>

<body class="dark-only" onload="setWrapperClass()">
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-header">
      <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
          <div class="logo-wrapper"><a href="https://panel.elfbar-security.eu" data-bs-original-title="" title=""><img
                class="img-fluid for-dark"
                src="https://cdn.discordapp.com/attachments/1021462218904182796/1060162041471586304/Unbenannt-dd1.png"
                alt=""></a>
          </div>
        </div>
        <div class="left-header col ps-0"></div>
        <div class="nav-right col-8 pull-right right-header p-0">
          <ul class="nav-menus">
            <li class="profile-nav onhover-dropdown p-0 me-0">
              <div class="media profile-media"><img class="b-r-10" src="<?php echo $avatar ?>" alt=""
                  style="width: 35px; height: 35px;">
                <div class="media-body"><span>
                    <?php
                    echo $_SESSION["username"];
                    ?>
                  </span>
                  <p class="mb-0 font-roboto">
                    <?php
                    echo $_SESSION["group"];
                    ?>
                    <i class="middle fa fa-angle-down"></i>
                  </p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheataccount"><i
                      data-feather="user"></i><span>Account</span></a></li>
                <li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheataccount/"><i
                      data-feather="settings"></i><span>Settings</span></a></li>
                <li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatlogout.php"> <i
                      data-feather="log-in"> </i><span>Log
                      out</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="page-body-wrapper">
      <div class="sidebar-wrapper">
        <div>
          <div class="logo-wrapper"><a href="https://panel.elfbar-security.eu"><img class="img-fluid for-dark" src=""
                alt=""></a>
          </div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">

                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu"
                    data-bs-original-title="" title="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-home">
                      <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                      <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Home</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatmanage/" data-bs-original-title=""
                    title="">
                    <i class="fa fa-desktop"></i>
                    <span>Overview</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatmanage/banlist.php"
                    data-bs-original-title="" title="">
                    <i class="fa fa-ban"></i>
                    <span>Banlist</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatmanage/playerlist.php"
                    data-bs-original-title="" title="">
                    <i class="fa fa-group"></i>
                    <span>Playerlist</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatmanage/config.php"
                    data-bs-original-title="" title="">
                    <i class="fa fa-edit"></i>
                    <span>Config</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatmanage/aclogs.php"
                    data-bs-original-title="" title="">
                    <i class="fa fa-list-alt"></i>
                    <span>Anticheat Logs</span>
                  </a>

                  <?php

                  include("../database.php");
                  $getbota = "SELECT server.server_id FROM server WHERE serverip =  '" . $_SESSION["ip"] . "'";
                  $result = mysqli_query($link, $getbota);
                  if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $serverId = $row['server_id'];

                    if (!empty($serverId)) {
                      echo '</li>';
                      echo '</li><li class="sidebar-list">';
                      echo '<a class="sidebar-link sidebar-title link-nav" href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatmanage/botlogs.php" data-bs-original-title="" title="">';
                      echo '<i class="fa fa-file-text"></i>';
                      echo '<span>Bot Logs</span>';
                      echo '</a>';
                    }
                  }

                  ?>

                </li>
          </nav>
        </div>
      </div>

      <div class="page-body">
        <div class="container-fluid">
          <div class="page-title">
            <div class="row">
              <div class="col-6"></div>
              <div class="col-6">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="https://panel.elfbar-security.eu"> <i
                        data-feather="home"></i></a></li>
                  <li class="breadcrumb-item">Manage</li>
                </ol>
              </div>
            </div>
            <div class="col-xl-9 xl-100 chart_data_left box-col-12">
              <div class="card">
                <div class="card-body p-0">
                  <div class="row m-0 chart-main">
                    <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                      <div class="media align-items-center">
                        <div class="hospital-small-chart">
                          <div class="small-bar">
                            <div class="small-chart flot-chart-container">
                              <div class="chartist-tooltip"></div><svg
                                xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                                class="ct-chart-bar" style="width: 100%; height: 100%;">
                                <g class="ct-grids"></g>
                                <g>
                                  <g class="ct-series ct-series-a">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="69" y2="58.2"
                                      class="ct-bar" ct:value="400" style="stroke-width: 3px"></line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="69" y2="44.7"
                                      class="ct-bar" ct:value="900" style="stroke-width: 3px"></line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="69" y2="47.4"
                                      class="ct-bar" ct:value="800" style="stroke-width: 3px"></line>
                                    <line x1="35" x2="35" y1="69" y2="42" class="ct-bar" ct:value="1000"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="50.1" class="ct-bar"
                                      ct:value="700" style="stroke-width: 3px"></line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="36.6"
                                      class="ct-bar" ct:value="1200" style="stroke-width: 3px"></line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="60.9" class="ct-bar"
                                      ct:value="300" style="stroke-width: 3px"></line>
                                  </g>
                                  <g class="ct-series ct-series-b">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="58.2"
                                      y2="31.200000000000003" class="ct-bar" ct:value="1000" style="stroke-width: 3px">
                                    </line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="44.7"
                                      y2="31.200000000000003" class="ct-bar" ct:value="500" style="stroke-width: 3px">
                                    </line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="47.4"
                                      y2="31.199999999999996" class="ct-bar" ct:value="600" style="stroke-width: 3px">
                                    </line>
                                    <line x1="35" x2="35" y1="42" y2="31.200000000000003" class="ct-bar" ct:value="400"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="50.1"
                                      y2="31.200000000000003" class="ct-bar" ct:value="700" style="stroke-width: 3px">
                                    </line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="36.6"
                                      y2="31.200000000000003" class="ct-bar" ct:value="200" style="stroke-width: 3px">
                                    </line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="60.9"
                                      y2="31.199999999999996" class="ct-bar" ct:value="1100" style="stroke-width: 3px">
                                    </line>
                                  </g>
                                </g>
                                <g class="ct-labels"></g>
                              </svg>
                            </div>
                          </div>
                        </div>
                        <div class="media-body">
                          <div class="right-chart-content">
                            <h4>
                              <?php
                              $result = mysqli_query($stats, "select count(1) FROM `totaljoins` WHERE license = '" . $license . "' ");
                              $row = mysqli_fetch_array($result);
                              echo $row[0] ?>
                              </script>
                            </h4><span>Total Joins</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                      <div class="media align-items-center">
                        <div class="hospital-small-chart">
                          <div class="small-bar">
                            <div class="small-chart1 flot-chart-container">
                              <div class="chartist-tooltip"></div><svg
                                xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                                class="ct-chart-bar" style="width: 100%; height: 100%;">
                                <g class="ct-grids"></g>
                                <g>
                                  <g class="ct-series ct-series-a">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="69" y2="58.2"
                                      class="ct-bar" ct:value="400" style="stroke-width: 3px"></line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="69" y2="52.8"
                                      class="ct-bar" ct:value="600" style="stroke-width: 3px"></line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="69" y2="44.7"
                                      class="ct-bar" ct:value="900" style="stroke-width: 3px"></line>
                                    <line x1="35" x2="35" y1="69" y2="47.4" class="ct-bar" ct:value="800"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="42" class="ct-bar"
                                      ct:value="1000" style="stroke-width: 3px"></line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="36.6"
                                      class="ct-bar" ct:value="1200" style="stroke-width: 3px"></line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="55.5" class="ct-bar"
                                      ct:value="500" style="stroke-width: 3px"></line>
                                  </g>
                                  <g class="ct-series ct-series-b">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="58.2"
                                      y2="31.200000000000003" class="ct-bar" ct:value="1000" style="stroke-width: 3px">
                                    </line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="52.8"
                                      y2="31.199999999999996" class="ct-bar" ct:value="800" style="stroke-width: 3px">
                                    </line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="44.7"
                                      y2="31.200000000000003" class="ct-bar" ct:value="500" style="stroke-width: 3px">
                                    </line>
                                    <line x1="35" x2="35" y1="47.4" y2="31.199999999999996" class="ct-bar"
                                      ct:value="600" style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="42" y2="31.200000000000003"
                                      class="ct-bar" ct:value="400" style="stroke-width: 3px"></line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="36.6"
                                      y2="31.200000000000003" class="ct-bar" ct:value="200" style="stroke-width: 3px">
                                    </line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="55.5"
                                      y2="31.200000000000003" class="ct-bar" ct:value="900" style="stroke-width: 3px">
                                    </line>
                                  </g>
                                </g>
                                <g class="ct-labels"></g>
                              </svg>
                            </div>
                          </div>
                        </div>
                        <div class="media-body">
                          <div class="right-chart-content">
                            <h4>
                              <?php
                              $result = mysqli_query($stats, "select count(1) FROM `totalbans` WHERE license = '" . $license . "' ");
                              $row = mysqli_fetch_array($result);
                              echo $row[0] ?>
                              </script>
                            </h4><span>Total Bans</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                      <div class="media align-items-center">
                        <div class="hospital-small-chart">
                          <div class="small-bar">
                            <div class="small-chart2 flot-chart-container">
                              <div class="chartist-tooltip" style="top: -20.8px; left: 26.6333px;"><span
                                  class="chartist-tooltip-value">700</span></div><svg
                                xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                                class="ct-chart-bar" style="width: 100%; height: 100%;">
                                <g class="ct-grids"></g>
                                <g>
                                  <g class="ct-series ct-series-a">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="69" y2="39.3"
                                      class="ct-bar" ct:value="1100" style="stroke-width: 3px"></line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="69" y2="44.7"
                                      class="ct-bar" ct:value="900" style="stroke-width: 3px"></line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="69" y2="52.8"
                                      class="ct-bar" ct:value="600" style="stroke-width: 3px"></line>
                                    <line x1="35" x2="35" y1="69" y2="42" class="ct-bar" ct:value="1000"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="50.1" class="ct-bar"
                                      ct:value="700" style="stroke-width: 3px"></line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="36.6"
                                      class="ct-bar" ct:value="1200" style="stroke-width: 3px"></line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="60.9" class="ct-bar"
                                      ct:value="300" style="stroke-width: 3px"></line>
                                  </g>
                                  <g class="ct-series ct-series-b">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="39.3"
                                      y2="31.199999999999996" class="ct-bar" ct:value="300" style="stroke-width: 3px">
                                    </line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="44.7"
                                      y2="31.200000000000003" class="ct-bar" ct:value="500" style="stroke-width: 3px">
                                    </line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="52.8"
                                      y2="31.199999999999996" class="ct-bar" ct:value="800" style="stroke-width: 3px">
                                    </line>
                                    <line x1="35" x2="35" y1="42" y2="31.200000000000003" class="ct-bar" ct:value="400"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="50.1"
                                      y2="31.200000000000003" class="ct-bar" ct:value="700" style="stroke-width: 3px">
                                    </line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="36.6"
                                      y2="31.200000000000003" class="ct-bar" ct:value="200" style="stroke-width: 3px">
                                    </line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="60.9"
                                      y2="31.199999999999996" class="ct-bar" ct:value="1100" style="stroke-width: 3px">
                                    </line>
                                  </g>
                                </g>
                                <g class="ct-labels"></g>
                              </svg>
                            </div>
                          </div>
                        </div>
                        <div class="media-body">
                          <div class="right-chart-content">
                            <h4>
                              <?php
                              $result = mysqli_query($stats, "select count(1) FROM `totalauths` WHERE license = '" . $license . "' ");
                              $row = mysqli_fetch_array($result);
                              echo $row[0] ?>
                            </h4><span>Total Auth</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                      <div class="media border-none align-items-center">
                        <div class="hospital-small-chart">
                          <div class="small-bar">
                            <div class="small-chart3 flot-chart-container">
                              <div class="chartist-tooltip"></div><svg
                                xmlns:ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%"
                                class="ct-chart-bar" style="width: 100%; height: 100%;">
                                <g class="ct-grids"></g>
                                <g>
                                  <g class="ct-series ct-series-a">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="69" y2="58.2"
                                      class="ct-bar" ct:value="400" style="stroke-width: 3px"></line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="69" y2="52.8"
                                      class="ct-bar" ct:value="600" style="stroke-width: 3px"></line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="69" y2="47.4"
                                      class="ct-bar" ct:value="800" style="stroke-width: 3px"></line>
                                    <line x1="35" x2="35" y1="69" y2="42" class="ct-bar" ct:value="1000"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="50.1" class="ct-bar"
                                      ct:value="700" style="stroke-width: 3px"></line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="39.3"
                                      class="ct-bar" ct:value="1100" style="stroke-width: 3px"></line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="60.9" class="ct-bar"
                                      ct:value="300" style="stroke-width: 3px"></line>
                                  </g>
                                  <g class="ct-series ct-series-b">
                                    <line x1="13.571428571428571" x2="13.571428571428571" y1="58.2"
                                      y2="31.200000000000003" class="ct-bar" ct:value="1000" style="stroke-width: 3px">
                                    </line>
                                    <line x1="20.714285714285715" x2="20.714285714285715" y1="52.8" y2="39.3"
                                      class="ct-bar" ct:value="500" style="stroke-width: 3px"></line>
                                    <line x1="27.857142857142858" x2="27.857142857142858" y1="47.4"
                                      y2="31.199999999999996" class="ct-bar" ct:value="600" style="stroke-width: 3px">
                                    </line>
                                    <line x1="35" x2="35" y1="42" y2="33.9" class="ct-bar" ct:value="300"
                                      style="stroke-width: 3px"></line>
                                    <line x1="42.14285714285714" x2="42.14285714285714" y1="50.1"
                                      y2="31.200000000000003" class="ct-bar" ct:value="700" style="stroke-width: 3px">
                                    </line>
                                    <line x1="49.285714285714285" x2="49.285714285714285" y1="39.3" y2="33.9"
                                      class="ct-bar" ct:value="200" style="stroke-width: 3px"></line>
                                    <line x1="56.42857142857143" x2="56.42857142857143" y1="60.9"
                                      y2="31.199999999999996" class="ct-bar" ct:value="1100" style="stroke-width: 3px">
                                    </line>
                                  </g>
                                </g>
                                <g class="ct-labels"></g>
                              </svg>
                            </div>
                          </div>
                        </div>
                        <div class="media-body">
                          <div class="right-chart-content">
                            <h4>
                              <?php
                              $result = mysqli_query($logs, "select count(1) FROM `botlogs` WHERE license = '" . $license . "' ");
                              $row = mysqli_fetch_array($result);
                              echo $row[0] ?>
                            </h4><span>Bot commands used</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 xl-50 notification box-col-6">
                  <div class="card">
                    <div class="card-header card-no-border">
                      <div class="header-top">
                        <h5 class="m-0">Latest Server History</h5>
                        <div class="card-header-right-icon">
                        </div>
                      </div>
                    </div>
                    <div class="card-body new-update pt-0 ">
                      <div class="activity-timeline">
                        <?php

                        include('../database.php');
                        $query = "SELECT * FROM logs WHERE license = '" . $license . "' order by date DESC limit 6";
                        $result = $logs->query($query);
                        while ($row = $result->fetch_array()) {
                          echo '<div class="media">';
                          echo '<div class="activity-dot-primary"></div>';
                          echo '<div class="media-body"><span class="text-success">' . $row["reason"] . '</span><span></span>';

                          echo '</p> ';
                          echo '' . $row["date"] . '<br>';
                          echo '</div>';
                          echo '</div>';
                        }
                        ?>


                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 xl-50 notification box-col-6 text-center">
                  <div class="card">
                    <div class="card-header card-no-border">
                      <div class="header-top">
                        <h5 class="m-0 ddd">ImoShield Options</h5>
                        <div class="card-header-right-icon">
                          <div class="mt-3 text-center">
                            <form method="POST" action="index.php">
                              <input class="btn btn-primary dd" type="submit" name="restart" value="Restart Server">
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body new-update pt-0 ">
                      <div class="activity-timeline">

                      </div>
                    </div>
                    <div class="card-footer text-center">
                      <h5 class="m-0">ImoShield Informations</h5>
                      <p></p>
                      <?php

                      $sql = "SELECT lastreset FROM redem_license
JOIN server ON server.serverid = redem_license.serverid
WHERE server.serverip = ?";
                      $stmt = mysqli_prepare($link, $sql);
                      if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION["ip"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if ($result) {
                          $row = mysqli_fetch_assoc($result);

                          if ($row) {
                            $dbDate = strtotime($row['lastreset']);

                            if ($dbDate !== false) {
                              $newDate = strtotime('+30 days', $dbDate);

                              if ($newDate !== false) {
                                $formattedNewDate = date("Y-m-d H:i:s", $newDate);
                              }
                            }
                          }
                        }

                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                      }
                      ?>
                      <p>Your License Key: <span class="green-text">
                          <?php echo $license ?>
                        </span></p>
                      <p>You can reset your IP on: <span class="green-text">
                          <?php echo $formattedNewDate ?>
                        </span></p>
                      <p>Current Linked Server IP: <span class="green-text">
                          <?php echo $_SESSION["ip"] ?>
                        </span></p>
                      <p>Is your License Blacklisted: <span class="green-text">No</span></p>
                    </div>

                    <style>
                      .green-text {
                        color: green;
                      }
                    </style>

                    <div class="card-body new-update pt-0 ">
                      <div class="activity-timeline">

                      </div>
                    </div>

                    <?php
                    $token = '';
                    $ip = $_SESSION['ip'];
                    $query = "SELECT server.role_id, server.server_id, server.botAccessRole, server.logsChannel 
          FROM server WHERE server.serverip = ?";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param("s", $ip);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();

                    if ($row && $row['server_id'] !== null) {
                      $guildId = $row['server_id']; // Server ID
                      $channelId = $row['logsChannel']; // Log channel ID
                      $role1Id = $row['botAccessRole']; // Bypass Role ID
                      $role2Id = $row['role_id']; // Bot Access Role ID
                      function sendDiscordAPIRequest($endpoint, $token)
                      {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, "https://discord.com/api/v9{$endpoint}");
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                          "Authorization: Bot {$token}",
                          "Content-Type: application/json",
                        ]);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($ch);
                        curl_close($ch);
                        return json_decode($response, true);
                      }
                      $rolesEndpoint = "/guilds/{$guildId}/roles";
                      $rolesResponse = sendDiscordAPIRequest($rolesEndpoint, $token);
                      $roleNames = [];
                      if ($rolesResponse) {
                        foreach ($rolesResponse as $role) {
                          if ($role['id'] == $role1Id || $role['id'] == $role2Id) {
                            $roleNames[] = $role['name'];
                          }
                        }
                      }
                      $channelsEndpoint = "/guilds/{$guildId}/channels";
                      $channelsResponse = sendDiscordAPIRequest($channelsEndpoint, $token);
                      $channelName = null;
                      if ($channelsResponse) {
                        foreach ($channelsResponse as $channel) {
                          if ($channel['id'] == $channelId) {
                            $channelName = $channel['name'];
                            break;
                          }
                        }
                      }
                      $isBotInServer = false;
                      $botId = '';
                      $membersEndpoint = "/guilds/{$guildId}/members/{$botId}";
                      $memberResponse = sendDiscordAPIRequest($membersEndpoint, $token);
                      if ($memberResponse && isset($memberResponse['user']['bot']) && $memberResponse['user']['bot'] && $memberResponse['user']['id'] === $botId) {
                        $isBotInServer = true;
                      }
                      $htmlTemplate = '<div class="card-footer text-center">
      <h5 class="m-0">ImoShield Customer Bot</h5>
      <p></p>
      <p>%s</p>
      %s
      %s
      </div>';
                      $roleTextColor = !empty($roleNames) ? 'green' : 'red';
                      $roleText = '';
                      if (!empty($roleNames)) {
                        $roleText = '<p>Bypass Role: <span style="color: ' . $roleTextColor . ';">' . implode('</span></p><p>Bot Access Role: <span style="color: ' . $roleTextColor . ';">', $roleNames) . '</span></p>';
                      } else {
                        $roleText = '<p>Role: <span style="color: ' . $roleTextColor . ';">Role not found</span></p>';
                      }
                      $channelTextColor = $channelName ? 'green' : 'red';
                      $channelText = '';
                      if ($channelName) {
                        $channelText = '<p>Log Channel Name: <span style="color: ' . $channelTextColor . ';">' . $channelName . '</span></p>';
                      } else {
                        $channelText = '<p>Log Channel Name: <span style="color: ' . $channelTextColor . ';">Channel not found</span></p>';
                      }
                      $enabledText = $isBotInServer ? 'Activated & Successfully Set Up' : '<a href="https://discord.com/oauth2/authorize?client_id=1097879027714379867&scope=bot">Invite Bot</a>';
                      $htmlOutput = sprintf($htmlTemplate, $enabledText, $roleText, $channelText);
                      echo $htmlOutput;
                    } else {
                      $htmlOutput = '<div class="card-footer text-center">
      <h5 class="m-0">ImoShield Customer Bot</h5>
      <p></p>
      <p>The Customer Bot not installed</p>
      <p>For Admin bypass via Discord roles</p>
      <p>Or for unban / ban / kick via your Discord Server</p>
      <p>Invite the ImoShield Customer Bot!</p>
      <p><a href="https://discord.com/oauth2/authorize?client_id=1097879027714379867&scope=bot">Invite Bot</a></p>
      </div>';
                      echo $htmlOutput;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">2022 -
                  <script>document.write(new Date().getFullYear())</script> ©V01D & H04X
                  <a href="//www.dmca.com/Protection/Status.aspx?ID=9c9de7b3-a4ce-4ec0-9d39-8072e9ad971a"
                    title="DMCA.com Protection Status" class="dmca-badge"> <img
                      src="https://images.dmca.com/Badges/dmca-badge-w100-5x1-11.png?ID=9c9de7b3-a4ce-4ec0-9d39-8072e9ad971a"
                      alt="DMCA.com Protection Status" /></a>
                  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script type="text/javascript"
      src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
    <script src="../assets/js/scrollbar/simplebar.js"></script>
    <script src="../assets/js/scrollbar/custom.js"></script>
    <script src="../assets/js/config.js"></script>
    <script src="../assets/js/sidebar-menu.js"></script>
    <script src="../assets/js/tooltip-init.js"></script>
    <script src="../assets/js/script.js"></script>
    <script type="text/javascript">
      if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
        $(".according-menu.other").css("display", "none");
        $(".sidebar-submenu").css("display", "block");
      }
    </script>
</body>

</html>