<?php
session_start();
include('../func.php');

if (empty($_SESSION['ip'])) {
  session_destroy();
  header("Location: https://panel.elfbar-security.eu/login");
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
  header("Location: https://panel.elfbar-security.eu/");
}
if (isset($_POST['unban']) && !empty($_POST['banid'])) {
  $id = $_POST['banid'];
  include '../database.php';
  $query = "SELECT redem_license.license FROM users_server 
    JOIN server ON users_server.serverid = server.serverid
    JOIN redem_license ON redem_license.serverid = server.serverid
    WHERE users_server.userid = ? AND server.serverip = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "ss", $_SESSION["id"], $_SESSION["ip"]);
  mysqli_stmt_execute($stmt);
  $resultt = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_row($resultt);
  $t = $row[0];
  $sql = "DELETE FROM `$t` WHERE id = ?";
  $stmt = mysqli_prepare($svbans, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  if (mysqli_stmt_execute($stmt)) {
    echo '<p class="custom-alert-message">Player was unbanned successfully</p>';
  } else {
    echo '<h2 class="custom-alert-title">Panel System</h2>';
    echo '<p class="custom-alert-message">ERROR! Code: [693]</p>';
  }
  mysqli_stmt_close($stmt);
  mysqli_close($svbans);
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
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/icofont.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/flag-icon.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.elfbar-security.eu/assets/css/vendors/date-picker.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
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

    .card {
      margin-top: 20px;
    }

    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      display: none;
      animation: popup-fadein 0.5s ease-in-out forwards;
    }

    .popup-window {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(59, 57, 58, 0.8);
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      text-align: center;
    }

    @keyframes popup-fadein {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    .close {
      position: absolute;
      top: px;
      right: 5px;
      cursor: pointer;
      color: red;
      font-size: 30px;

    }

    .close:hover {
      color: darkred;
    }

    .custom-alert {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      padding: 20px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      animation: alert-animation 1s ease-in-out;
    }

    .custom-alert-title {
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center;
    }

    .custom-alert-message {
      font-size: 18px;
      text-align: center;
    }

    @keyframes alert-animation {
      0% {
        transform: translate(-50%, -70%);
        opacity: 0;
      }

      100% {
        transform: translate(-50%, -50%);
        opacity: 1;
      }
    }
  </style>
  <script>
    function setWrapperClass() {
      $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper");
    }
    setTimeout(function () {
      var customAlert = document.getElementById('custom-alert');
      customAlert.style.display = 'none';
    }, 3000);
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
                <li><a href="https://panel.elfbar-security.eu/account"><i
                      data-feather="user"></i><span>Account</span></a></li>

                <li><a href="https://panel.elfbar-security.eu/account/"><i
                      data-feather="settings"></i><span>Settings</span></a></li>
                <li><a href="https://panel.elfbar-security.eu/logout.php"> <i data-feather="log-in"> </i><span>Log
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
                  <a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu/manage/"
                    data-bs-original-title="" title="">
                    <i class="fa fa-desktop"></i>
                    <span>Overview</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://panel.elfbar-security.eu/manage/banlist.php" data-bs-original-title="" title="">
                    <i class="fa fa-ban"></i>
                    <span>Banlist</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://panel.elfbar-security.eu/manage/playerlist.php" data-bs-original-title="" title="">
                    <i class="fa fa-group"></i>
                    <span>Playerlist</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://panel.elfbar-security.eu/manage/aclogs.php" data-bs-original-title="" title="">
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
                      echo '<a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu/manage/botlogs.php" data-bs-original-title="" title="">';
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

            <?php
            include("../database.php");
            $getlicense = "SELECT redem_license.license FROM users_server 
JOIN server ON users_server.serverid = server.serverid
JOIN redem_license ON redem_license.serverid = server.serverid
WHERE users_server.userid = '" . $_SESSION["id"] . "' AND server.serverip = '" . $_SESSION["ip"] . "'";
            $result = mysqli_query($link, $getlicense);
            $row = mysqli_fetch_assoc($result);
            $license = $row['license'];
            $tableName = "botlogs";
            $columns = ['id', 'command', 'banid', 'playerid', 'channel', 'user', 'notes'];
            $fetchData = fetch_data($logs, $tableName, $columns, $license);
            function fetch_data($logs, $tableName, $columns, $license)
            {
              if (empty($logs)) {
              } elseif (empty($columns) || !is_array($columns)) {

              } elseif (empty($tableName)) {

              } else {
                $columnName = implode(", ", $columns);
                $query = "SELECT * FROM `botlogs` WHERE license = '$license' ORDER BY date DESC LIMIT 1000";

                if (isset($_POST['search'])) {
                  $searchValue = $_POST['search'];
                  $query .= " AND (command LIKE '%" . $searchValue . "%' OR user LIKE '%" . $searchValue . "%')";
                }
                $result = $logs->query($query);
                if ($result == true) {
                  if ($result->num_rows > 0) {
                    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $msg = $row;
                  } else {
                    $msg = "no current Bot Logs";
                  }
                } else {
                  $msg = "BotLogs not found, contact our Team";
                  $err = mysqli_error($logs);
                }
              }
              return $msg;
            }
            ?>

            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h3>ImoShield Bot Logs</h3>
                  <span></span>
                  <caption>The last 1000 Bot Logs</caption>
                </div>
                <div class="card-block row">
                  <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <input type="text" id="searchInput" class="form-control" placeholder="Search">
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <caption>Bot Logs for your Server</caption>
                        <thead>
                          <tr>
                            <th>Command</th>
                            <th>Ban ID</th>
                            <th>Player ID</th>
                            <th>Channel</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (is_array($fetchData)) {
                            $sn = 1;
                            foreach ($fetchData as $data) {
                              ?>
                              <tr>
                                <td>
                                  <?php echo $data['command'] ?? ''; ?>
                                </td>
                                <td>
                                  <?php echo $data['banid'] ?? ''; ?>
                                </td>
                                <td>
                                  <?php echo $data['playerid'] ?? ''; ?>
                                </td>
                                <td>
                                  <?php echo $data['channel'] ?? ''; ?>
                                </td>
                                <td>
                                  <?php echo $data['user'] ?? ''; ?>
                                </td>
                                <td>
                                  <?php echo $data['notes'] ?? ''; ?>
                                </td>
                                <td>
                                  <?php echo $data['date'] ?? ''; ?>
                                </td>
                              </tr>
                              <?php
                              $sn++;
                            }
                          } else {
                            ?>
                            <tr>
                              <td colspan="8">
                                <?php echo $fetchData; ?>
                              </td>
                            <tr>
                              <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <script>
                  const banTable = document.querySelector('.table');
                  const searchInput = document.getElementById('searchInput');
                  searchInput.addEventListener('keyup', function () {
                    const searchString = searchInput.value.toLowerCase();
                    const rows = banTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (let row of rows) {
                      const id = row.getElementsByTagName('td')[0].innerText.toLowerCase();
                      const name = row.getElementsByTagName('td')[1].innerText.toLowerCase();
                      if (id.includes(searchString) || name.includes(searchString)) {
                        row.style.display = '';
                      } else {
                        row.style.display = 'none';
                      }
                    }
                  });
                </script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
    <script>function openScreenshotPopup(url) {
        var overlay = document.createElement('div');
        overlay.className = 'popup-overlay'; var window = document.createElement('div'); window.className = 'popup-window'; var image = document.createElement('img'); image.src = url; image.style.maxWidth = '90%'; window.appendChild(image); var close = document.createElement('span'); close.className = 'close'; close.innerHTML = '&times;'; window.appendChild(close); overlay.appendChild(window); document.body.appendChild(overlay); overlay.style.display = 'block'; close.addEventListener('click', function () { overlay.style.display = 'none'; });
      }</script>
    <script type="text/javascript">
      if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
        $(".according-menu.other").css("display", "none");
        $(".sidebar-submenu").css("display", "block");
      }
    </script>
</body>

</html>