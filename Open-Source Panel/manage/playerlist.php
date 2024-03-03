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

if (isset($_POST['kickBtn'])) {
  $ip = $_SESSION['ip'];
  $id = $_POST['itemid'];
  $id2 = "kicked";
  $sql = "INSERT INTO playerlist (id,reason,ip) VALUES ('$id','$id2','$ip')";
  if (mysqli_query($link, $sql)) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Kick System","Player kicked succesfully</b>","success");';
    echo '}, 500);</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Kick System","ERROR! Code: [66]</b>","success");';
    echo '}, 500);</script>';
  }
  mysqli_close($link);
}

if (isset($_POST['addBtn'])) {
  $ip = $_SESSION['ip'];
  $id = $_POST['itemid'];
  $id2 = "banned";
  $sql = "INSERT INTO playerlist (id,reason,ip) VALUES ('$id','$id2','$ip')";
  if (mysqli_query($link, $sql)) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","Player banned successfully</b>","success");';
    echo '}, 500);</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","ERROR! Code: [67]</b>","success");';
    echo '}, 500);</script>';
  }
  mysqli_close($link);
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

    .card {
      margin-top: 20px;
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
                        data-feather="home"></i></a>
                  </li>
                  <li class="breadcrumb-item">Manage</li>
                </ol>
              </div>
            </div>








            <?php
            include '../database.php';
            $ip = $_SESSION['ip'];
            $stmt = mysqli_prepare($link, "SELECT server.port FROM `server` WHERE server.serverip = ?");
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['ip']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $sv = mysqli_fetch_array($result);
            $port = $sv['port'];
            if (!$fp = fsockopen($ip, $port, $errno, $errstr, 1)) {
            } else {
              $players = file_get_contents("http://" . $ip . ":" . $port . "/players.json");
              $infos = file_get_contents("http://" . $ip . ":" . $port . "/info.json");
              $players = json_decode($players, true);
              $infos = json_decode($infos, true);
              fclose($fp);
            }
            mysqli_close($link);
            ?>
            <style>
              .search-container {
                margin-bottom: 10px;
              }

              .search-container input[type=text] {
                padding: 5px;
                width: 200px;
                font-size: 14px;
              }

              .table {
                width: 100%;
                border-collapse: collapse;
              }

              .table th,
              .table td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #ddd;
              }

              .table caption {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
              }
            </style>
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h3>Playerlist</h3><span></span>
                </div>
                <div class="card-block row">
                  <div class="col-sm-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <input type="text" id="searchInput" class="form-control" placeholder="Search by ID or Name">
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <caption>List of users</caption>
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Steam</th>
                            <th>License</th>
                            <th>Ping</th>
                            <th>Ban</th>
                            <th>Kick</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($players as $player) { ?>
                            <tr>
                              <td>
                                <?php echo $player['id'] ?>
                              </td>
                              <td>
                                <?php echo $player['name'] ?>
                              </td>
                              <?php
                              $steamFound = false;
                              foreach ($player['identifiers'] as $identifier3) {
                                if (str_starts_with($identifier3, 'steam:')) {
                                  $steamFound = true;
                                  ?>
                                  <td>
                                    <?php echo $identifier3; ?>
                                  </td>
                                  <?php
                                  break;
                                }
                              }
                              if (!$steamFound) {
                                ?>
                                <td>
                                  <?php echo "not found"; ?>
                                </td>
                                <?php
                              }
                              ?>
                              <?php
                              $licenseFound = false;
                              foreach ($player['identifiers'] as $identifier3) {
                                if (str_starts_with($identifier3, 'license:')) {
                                  $licenseFound = true;
                                  ?>
                                  <td>
                                    <?php echo $identifier3; ?>
                                  </td>
                                  <?php
                                  break;
                                }
                              }
                              if (!$licenseFound) {
                                ?>
                                <td>
                                  <?php echo "not found"; ?>
                                </td>
                                <?php
                              }
                              ?>
                              <td>
                                <?php echo $player['ping'] ?>
                              </td>
                              <td>
                                <form name='frmDelete' action='playerlist.php' method='post'>
                                  <input type='hidden' name='itemid' value='<?php echo $player['id'] ?>'>
                                  <input class="btn btn-primary" type='submit' name='addBtn' value='Ban'>
                                </form>
                              </td>
                              <td>
                                <form name='frmDelete' action='playerlist.php' method='post'>
                                  <input type='hidden' name='itemid' value='<?php echo $player['id'] ?>'>
                                  <input class="btn btn-primary" type='submit' name='kickBtn' value='Kick'>
                                </form>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <script>
              function filterTable() {
                var input = document.getElementById("searchInput");
                var filter = input.value.toUpperCase();
                var table = document.querySelector(".table");
                var tr = table.getElementsByTagName("tr");
                for (var i = 0; i < tr.length; i++) {
                  var td = tr[i].getElementsByTagName("td");
                  var found = false;
                  for (var j = 0; j < td.length; j++) {
                    var cell = td[j];
                    if (cell) {
                      var txtValue = cell.textContent || cell.innerText;
                      if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                      }
                    }
                  }
                  if (found) {
                    tr[i].style.display = "";
                  } else {
                    tr[i].style.display = "none";
                  }
                }
              }
              var searchInput = document.getElementById("searchInput");
              searchInput.addEventListener("keyup", filterTable);
            </script>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 footer-copyright text-center">
              <p class="mb-0">2022-
                <script>document.write(new Date().getFullYear())</script> ©V01D & H04X
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

  <script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
      $(".according-menu.other").css("display", "none");
      $(".sidebar-submenu").css("display", "block");
    }
  </script>
</body>

</html>