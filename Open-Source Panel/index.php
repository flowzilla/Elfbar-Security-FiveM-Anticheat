<?php
session_start();



include('func.php');
$sql = "SELECT server.serverip,server.latestres_name AS resname,server.port FROM server JOIN users_server ON users_server.userid = '" . $_SESSION["id"] . "' WHERE server.serverid = users_server.serverid";
$result = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_assoc($result)) {
  $ip = $row['serverip'];
  $port = $row['port'];
  $resname = $row['resname'];


  $url = "http://" . $ip . ":" . $port . "/info.json";

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 2);
  curl_setopt($curl, CURLOPT_TIMEOUT, 2);
  curl_setopt($curl, CURLOPT_HEADER, false);
  $data = curl_exec($curl);
  $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);

  if ($httpcode >= 200 && $httpcode < 400) {

    $data = json_decode($data, true);
    if (array_key_exists("resources", $data)) {
      if (in_array($resname, $data["resources"])) {
        //Ja
        $query = "UPDATE server SET server.status = '1' WHERE serverip = '" . $ip . "'";
        mysqli_query($conn, $query);

      } else {
        // Ne

        $query = "UPDATE server SET server.status = '0' WHERE serverip = '" . $ip . "'";
        mysqli_query($conn, $query);
      }
    }
  } else {
    // offline

    $query2 = "UPDATE server SET server.status = '0' WHERE serverip = '" . $ip . "'";
    mysqli_query($conn, $query2);
  }
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
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
  <title>Elfbar-Security | Panel</title>
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/icofont.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>
  <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
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

    .fixed-height {
      height: 400px;
    }

    .card {
      margin-top: 20px;
    }
  </style>



  <?php
  if (isset($_POST['license']) && !empty($_POST['license']) && isset($_POST['ip']) && !empty($_POST['ip'])) {
    $id = $_POST['license'];
    $ip = $_POST['ip'];
    include 'database.php';
    $sql = "SELECT lastreset FROM redem_license
    JOIN server ON server.serverid = redem_license.serverid
    WHERE redem_license.license = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);

    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      $dbDate = $row['lastreset'];

      $tage = date('Y-m-d', strtotime('-30 days'));

      if ($dbDate < $tage) {
        $updateSql = "UPDATE redem_license SET lastreset = NOW() WHERE license = ?";
        $updateStmt = mysqli_prepare($link, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "s", $id);

        if (mysqli_stmt_execute($updateStmt)) {
          $sql2 = 'DELETE FROM server WHERE serverip = "' . $ip . '"';
          $stmt2 = mysqli_prepare($link, $sql2);

          if (mysqli_stmt_execute($stmt2)) {
            echo "<script>
                Swal.fire({
                  title: 'Panel System',
                  text: 'IP has been reset successfully. You can now restart ImoShield',
                  icon: 'success'
                });
              </script>";
          } else {
            echo "<script>
                Swal.fire({
                  title: 'Panel System',
                  text: 'ERROR [691]',
                  icon: 'success'
                });
              </script>";
          }

        } else {
          echo "<script>
                  Swal.fire({
                    title: 'Panel System',
                    text: 'Error [692]', 
                    icon: 'error'
                  });
                </script>";
        }

        mysqli_stmt_close($updateStmt);
      } else {
        echo "<script>
              Swal.fire({
                title: 'Panel System',
                text: 'IP reset COOLDOWN',
                icon: 'error'
              });
            </script>";
      }
    } else {
      echo "<script>
          Swal.fire({
            title: 'Panel System',
            text: 'Error [694]',
            icon: 'error'
          });
        </script>";
    }

    mysqli_stmt_close($stmt);
  }
  ?>

  <script>

    setInterval(function () {

      updateNumRows("liveScreens", "totalscreenshots");
      updateNumRows("liveAuth", "totalauths");
      updateNumRows("liveBans", "totalbans");
      updateNumRows("liveJoins", "totaljoins");

    }, 1000);
  </script>

</head>

<body class="dark-only">

  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <div class="page-header">
      <div class="header-wrapper row m-0">
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
                <li><a href="https://example.com/account/"><i data-feather="user"></i><span>Account</span></a>
                </li>

                <li><a href="https://example.com/account/"><i data-feather="settings"></i><span>Settings</span></a></li>
                <li><a href="https://example.com/logout.php"> <i data-feather="log-in"> </i><span>Log
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
          <div class="logo-wrapper"><a href="https://example.com"><img class="img-fluid for-dark"
                src="https://cdn.discordapp.com/attachments/1021462218904182796/1060162041471586304/Unbenannt-dd1.png"
                alt=""></a>
          </div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"></a>

                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-1">General</h6>

                  </div>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com"
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
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-8">Products</h6>
                  </div>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com/api/download"
                    download="newest.zip">
                    <i data-feather="download"></i>
                    <span>Download Anticheat</span>
                  </a>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-8">Information</h6>
                  </div>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com/tos/"
                    data-bs-original-title="" title="">
                    <i data-feather="file-text"></i>
                    <span>T.O.S</span>
                  </a>
                </li>

                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com/refund/"
                    data-bs-original-title="" title="">
                    <i data-feather="credit-card"></i>
                    <span>Refund</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="" data-bs-original-title="" title="">
                    <i data-feather="bookmark"></i>
                    <span>Docs</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com/discord"
                    data-bs-original-title="" title="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-link">
                      <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                      <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    <span>Discord</span>
                  </a>
                </li>


                <?php
                if (($_SESSION["group"] == "admin")) {
                  echo '<li class="sidebar-main-title">';
                  echo '<div>';
                  echo '<h6>Admin</h6>';
                  echo '<p>Admin Panel</p>';
                  echo '</div>';
                  echo '</li>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="server"></i><span>Server</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="https://example.com/admin/server/overview/">Overview</a></li>';
                  echo '<li><a href="">Server Table</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="terminal"></i><span>Logs</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="https://example.com/admin/logs/authlogs/">Auth Logs</a></li>';
                  echo '<li><a href="https://example.com/admin/logs/serverlogs/">Server Logs</a></li>';
                  echo '<li><a href="https://example.com/admin/logs/panellogs/">Panel Logs</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="cloud"></i><span>Auth</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="#">Key Overview</a></li>';
                  echo '<li><a href="https://example.com/admin/auth/keygenerator">Key Creator</a></li>';
                  echo '<li><a href="#">IP Bans</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="https://example.com/admin/website"><i data-feather="folder"></i><span>Website</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="https://example.com/admin/website/">Settings</a></li>';
                  echo '</ul>';
                  echo '</li>';
                }

                ?>



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
                  <li class="breadcrumb-item"><a href="https://example.com"> <i
                        data-feather="home"></i></a>
                  </li>
                  <li class="breadcrumb-item">Home</li>
                </ol>

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
                                      <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="50.1"
                                        class="ct-bar" ct:value="700" style="stroke-width: 3px"></line>
                                      <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="36.6"
                                        class="ct-bar" ct:value="1200" style="stroke-width: 3px"></line>
                                      <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="60.9"
                                        class="ct-bar" ct:value="300" style="stroke-width: 3px"></line>
                                    </g>
                                    <g class="ct-series ct-series-b">
                                      <line x1="13.571428571428571" x2="13.571428571428571" y1="58.2"
                                        y2="31.200000000000003" class="ct-bar" ct:value="1000"
                                        style="stroke-width: 3px"></line>
                                      <line x1="20.714285714285715" x2="20.714285714285715" y1="44.7"
                                        y2="31.200000000000003" class="ct-bar" ct:value="500" style="stroke-width: 3px">
                                      </line>
                                      <line x1="27.857142857142858" x2="27.857142857142858" y1="47.4"
                                        y2="31.199999999999996" class="ct-bar" ct:value="600" style="stroke-width: 3px">
                                      </line>
                                      <line x1="35" x2="35" y1="42" y2="31.200000000000003" class="ct-bar"
                                        ct:value="400" style="stroke-width: 3px"></line>
                                      <line x1="42.14285714285714" x2="42.14285714285714" y1="50.1"
                                        y2="31.200000000000003" class="ct-bar" ct:value="700" style="stroke-width: 3px">
                                      </line>
                                      <line x1="49.285714285714285" x2="49.285714285714285" y1="36.6"
                                        y2="31.200000000000003" class="ct-bar" ct:value="200" style="stroke-width: 3px">
                                      </line>
                                      <line x1="56.42857142857143" x2="56.42857142857143" y1="60.9"
                                        y2="31.199999999999996" class="ct-bar" ct:value="1100"
                                        style="stroke-width: 3px"></line>
                                    </g>
                                  </g>
                                  <g class="ct-labels"></g>
                                </svg>
                              </div>
                            </div>
                          </div>
                          <div class="media-body">
                            <div class="right-chart-content">
                              <h4 id="liveJoins">
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
                                      <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="55.5"
                                        class="ct-bar" ct:value="500" style="stroke-width: 3px"></line>
                                    </g>
                                    <g class="ct-series ct-series-b">
                                      <line x1="13.571428571428571" x2="13.571428571428571" y1="58.2"
                                        y2="31.200000000000003" class="ct-bar" ct:value="1000"
                                        style="stroke-width: 3px"></line>
                                      <line x1="20.714285714285715" x2="20.714285714285715" y1="52.8"
                                        y2="31.199999999999996" class="ct-bar" ct:value="800" style="stroke-width: 3px">
                                      </line>
                                      <line x1="27.857142857142858" x2="27.857142857142858" y1="44.7"
                                        y2="31.200000000000003" class="ct-bar" ct:value="500" style="stroke-width: 3px">
                                      </line>
                                      <line x1="35" x2="35" y1="47.4" y2="31.199999999999996" class="ct-bar"
                                        ct:value="600" style="stroke-width: 3px"></line>
                                      <line x1="42.14285714285714" x2="42.14285714285714" y1="42"
                                        y2="31.200000000000003" class="ct-bar" ct:value="400" style="stroke-width: 3px">
                                      </line>
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
                              <h4 id="liveBans">
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
                                      <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="50.1"
                                        class="ct-bar" ct:value="700" style="stroke-width: 3px"></line>
                                      <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="36.6"
                                        class="ct-bar" ct:value="1200" style="stroke-width: 3px"></line>
                                      <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="60.9"
                                        class="ct-bar" ct:value="300" style="stroke-width: 3px"></line>
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
                                      <line x1="35" x2="35" y1="42" y2="31.200000000000003" class="ct-bar"
                                        ct:value="400" style="stroke-width: 3px"></line>
                                      <line x1="42.14285714285714" x2="42.14285714285714" y1="50.1"
                                        y2="31.200000000000003" class="ct-bar" ct:value="700" style="stroke-width: 3px">
                                      </line>
                                      <line x1="49.285714285714285" x2="49.285714285714285" y1="36.6"
                                        y2="31.200000000000003" class="ct-bar" ct:value="200" style="stroke-width: 3px">
                                      </line>
                                      <line x1="56.42857142857143" x2="56.42857142857143" y1="60.9"
                                        y2="31.199999999999996" class="ct-bar" ct:value="1100"
                                        style="stroke-width: 3px"></line>
                                    </g>
                                  </g>
                                  <g class="ct-labels"></g>
                                </svg>
                              </div>
                            </div>
                          </div>
                          <div class="media-body">
                            <div class="right-chart-content">
                              <h4 id="liveScreens"></h4><span>Total Screenshots</span>
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
                                      <line x1="42.14285714285714" x2="42.14285714285714" y1="69" y2="50.1"
                                        class="ct-bar" ct:value="700" style="stroke-width: 3px"></line>
                                      <line x1="49.285714285714285" x2="49.285714285714285" y1="69" y2="39.3"
                                        class="ct-bar" ct:value="1100" style="stroke-width: 3px"></line>
                                      <line x1="56.42857142857143" x2="56.42857142857143" y1="69" y2="60.9"
                                        class="ct-bar" ct:value="300" style="stroke-width: 3px"></line>
                                    </g>
                                    <g class="ct-series ct-series-b">
                                      <line x1="13.571428571428571" x2="13.571428571428571" y1="58.2"
                                        y2="31.200000000000003" class="ct-bar" ct:value="1000"
                                        style="stroke-width: 3px"></line>
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
                                        y2="31.199999999999996" class="ct-bar" ct:value="1100"
                                        style="stroke-width: 3px"></line>
                                    </g>
                                  </g>
                                  <g class="ct-labels"></g>
                                </svg>
                              </div>
                            </div>
                          </div>
                          <div class="media-body">
                            <div class="right-chart-content">


                              <h4 id="liveAuth"></h4><span> Total Auths</span>

                              <script>

                                function updateNumRows(idName, tableName) {
                                  var xhttp = new XMLHttpRequest();
                                  xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                      document.getElementById(idName).innerHTML = this.responseText;

                                    }
                                  };

                                  xhttp.open("GET", "getNumRows.php?tableName=" + tableName, true);
                                  xhttp.send(tableName);
                                }


                              </script>
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
                          <h5 class="m-0">News</h5>
                          <div class="card-header-right-icon">
                          </div>
                        </div>
                      </div>
                      <div class="card-body new-update pt-0" style="height: 450px; overflow: hidden;">
                        <div class="activity-timeline">

                          <?php
                          $query = "SELECT * FROM news ORDER BY date DESC LIMIT 2";
                          $result = $link->query($query);

                          while ($row = $result->fetch_array()) {
                            echo '<div class="media">';
                            echo '<div class="activity-dot-primary"></div>';
                            echo '<div class="media-body"><span class="text-info">' . $row["date"] . '</span><span></span>';
                            echo '<p class="font-roboto">' . $row["text"] . '<br>';
                            echo '</p> ';
                            echo 'News from ' . $row["user"] . '<br>';
                            echo '</div>';
                            echo '</div>';
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-6 xl-50 notification box-col-6">
                    <div class="card">
                      <div class="card-header card-no-border">
                        <div class="header-top">
                          <h5 class="m-0">Account Notifications</h5>
                          <div class="card-header-right-icon">
                          </div>
                        </div>
                      </div>
                      <div class="card-body new-update pt-0" style="height: 450px; overflow: hidden;">
                        <div class="activity-timeline">

                          <?php
                          $query = "SELECT * FROM notifications WHERE userid = '" . $_SESSION["id"] . "' ORDER BY date DESC LIMIT 2";
                          $result = $link->query($query);

                          while ($row = $result->fetch_array()) {
                            echo '<div class="media">';
                            echo '<div class="activity-dot-primary"></div>';
                            echo '<div class="media-body"><span class="text-info">' . $row["date"] . '</span><span></span>';
                            echo '<p class="font-roboto">' . $row["text"] . '<br>';
                            echo '</p>';
                            echo 'News from ImoShield Panel System<br>';
                            echo '</div>';
                            echo '</div>';
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-12 xl-100 box-col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Manage Servers</h5>
                    <div class="card-header-right">
                      <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="user-status table-responsive best-seller-table mb-0">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th scope="col">IP</th>
                            <th scope="col">Servername</th>
                            <th scope="col">License</th>
                            <th scope="col">Status</th>
                            <th scope="col">Expires</th>
                            <th scope="col">Owner</th>
                            <th scope="col">Manage License</th>
                            <th class="text-center" scope="col">Reset</th>
                          </tr>
                        </thead>
                        <tbody>
                          <script>

                            function setSessionIP(ip) {
                              var xhr = new XMLHttpRequest();
                              xhr.onload = function () {
                                if (xhr.status === 200) {
                                } else {
                                }
                              };
                              xhr.open('POST', 'setip.php', true);
                              xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                              xhr.send('ip=' + encodeURIComponent(ip));
                              console.log(ip);
                            }
                          </script>

                          <?php

                          include('database.php');

                          $query = "SELECT server.serverip,server.status,server.name,server.port,users_server.is_owner,redem_license.expires,redem_license.license FROM users_server 
JOIN server ON users_server.serverid = server.serverid
JOIN redem_license ON redem_license.serverid = server.serverid
WHERE users_server.userid = '" . $_SESSION["id"] . "'";
                          $result = $link->query($query);

                          while ($row = $result->fetch_array()) {
                            $online = "offline";
                            if ($row["status"] == 1) {
                              $online = "online";
                              $color = "success";
                            } else {
                              $online = "offline";
                              $color = "danger";
                            }
                            if ($row["is_owner"] == 1) {
                              echo '<tr>';
                              echo '<td class="text-info" >' . $row["serverip"] . '</td>';
                              echo '<td>' . $row["name"] . '</td>';
                              echo '<td>' . $row["license"] . '</td>';
                              echo '<td class="text-' . $color . '" >' . $online . '</td>';
                              echo '<td>' . $row["expires"] . '</td>';
                              echo '<td class="text-danger">true</td>';
                              $encrypted12 = encrypt_string($row['serverip']);
                              echo '<td class="text-end"><a href="https://example.com/manage"> <button class="btn btn-primary" onclick="setSessionIP(\'' . $encrypted12 . '\')">Manage License</button></a>';
                              echo '<td class="text-info">';
                              echo '<form name="ipreset" method="POST" action="index.php">';
                              echo '<input type="hidden" name="license" value="' . $row["license"] . '">';
                              echo '<input type="hidden" name="ip" value="' . $row["serverip"] . '">';
                              echo '<button class="btn btn-primary" type="submit">Reset License IP (Only 1x per Month)</button>';
                              echo '</form>';
                              echo '</td>';
                              echo '</tr>';
                            } else {
                              echo '<form method="post"> ';
                              echo '<tr>';
                              echo '<td class="text-info">' . $row["serverip"] . '</td>';
                              echo '<td>' . $row["name"] . '</td>';
                              echo '<td class="text-success">' . $online . '</td>';
                              echo '<td>' . $row["expires"] . '</td>';
                              echo '<td class="text-' . $color . '">false</td>';
                              $encrypted123 = encrypt_string($row['serverip']);
                              echo '<td class="text-end"><a href="https://example.com/manage"> <button class="btn btn-primary" onclick="setSessionIP(\'' . $encrypted123 . '\')">Manage</button></a><td>';
                              echo '</tr>';
                              echo '</form> ';
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
  <script src="assets/js/scrollbar/simplebar.js"></script>
  <script src="assets/js/scrollbar/custom.js"></script>
  <script src="assets/js/config.js"></script>
  <script src="assets/js/sidebar-menu.js"></script>
  <script src="assets/js/tooltip-init.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>

  <script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
      $(".according-menu.other").css("display", "none");
      $(".sidebar-submenu").css("display", "block");
    }
  </script>
</body>

</html>