<?php
session_start();
include('../../../func.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Elfbar-Security">
  <meta name="keywords" content="fivem, anticheat, anticheat leaked, free anticheat, imoshield, fivem ac">
  <meta name="author" content="ImoShield LTC.">
  <link rel="icon" href="../../../assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="../../../assets/images/favicon.png" type="image/x-icon">
  <title>Elfbar-Security | Panel</title>
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/icofont.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/flag-icon.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
  <link id="color" rel="stylesheet" href="../../../assets/css/color-1.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../../../assets/css/responsive.css">
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
  </style>
  <script>
    window.onload = function () {
      updateNumRows("liveScreens", "totalscreenshots");
      updateNumRows("liveAuth", "totalconnections");
      updateNumRows("liveBans", "totalbans");
      updateNumRows("liveJoins", "totaljoins");
    }
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
                <li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheataccount"><i
                      data-feather="user"></i><span>Account</span></a>
                </li>
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
          <div class="logo-wrapper"><a href="https://panel.elfbar-security.eu"><img class="img-fluid for-dark"
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
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-8">Information</h6>
                  </div>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheattos/" data-bs-original-title=""
                    title="">
                    <i data-feather="file-text"></i>
                    <span>T.O.S</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://docs.imoshield.net/"
                    data-bs-original-title="" title="">
                    <i data-feather="bookmark"></i>
                    <span>Docs</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav"
                    href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatdiscord" data-bs-original-title=""
                    title="">
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
                if (!($_SESSION["group"] == "admin")) {
                } else {
                  echo '<li class="sidebar-main-title">';
                  echo '<div>';
                  echo '<h6>Admin</h6>';
                  echo '<p>Admin Panel</p>';
                  echo '</div>';
                  echo '</li>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="server"></i><span>Server</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatadmin/server/overview/">Overview</a></li>';
                  echo '<li><a href="">Server Table</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="terminal"></i><span>Logs</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatadmin/logs/authlogs/">Auth Logs</a></li>';
                  echo '<li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatadmin/logs/serverlogs/">Server Logs</a></li>';
                  echo '<li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatadmin/logs/panellogs/">Panel Logs</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="cloud"></i><span>Auth</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="#">Key Overview</a></li>';
                  echo '<li><a href="https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheatadmin/auth/keygenerator">Key Creator</a></li>';
                  echo '<li><a href="#">IP Change Requests</a></li>';
                  echo '<li><a href="#">IP Bans</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="folder"></i><span>Website</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="#">Settings</a></li>';
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
                  <li class="breadcrumb-item"><a href="https://panel.elfbar-security.eu"> <i
                        data-feather="home"></i></a>
                  </li>
                  <li class="breadcrumb-item">Home</li>
                </ol>
              </div>
              <script>
                setInterval(function () {
                  updateNumRows("cpu");
                  updateNumRows("ram");
                  updateNumRows("size");
                  updateNumRows("count");
                }, 1000);

                function updateNumRows(idName) {
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                      document.getElementById(idName).innerHTML = this.responseText;
                    }
                  };
                  xhttp.open("GET", "getNumRows.php?id=" + idName, true);
                  xhttp.send(idName);
                }
              </script>
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
                              <h4 id="cpu"></h4><span>CPU</span>
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
                              <h4 id="ram"></h4><span>RAM</span>
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
                              <h4 id="size"></h4><span>Screenshots Storage</span>
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
                              <h4 id="count"></h4><span> Total Screens</span>
                            </div>
                          </div>
                        </div>
                      </div>
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
  <script src="../../../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="../../../assets/js/icons/feather-icon/feather-icon.js"></script>
  <script src="../../../assets/js/scrollbar/simplebar.js"></script>
  <script src="../../../assets/js/scrollbar/custom.js"></script>
  <script src="../../../assets/js/config.js"></script>
  <script src="../../../assets/js/sidebar-menu.js"></script>
  <script src="../../../assets/js/tooltip-init.js"></script>
  <script src="../../../assets/js/script.js"></script>
  <script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
      $(".according-menu.other").css("display", "none");
      $(".sidebar-submenu").css("display", "block");
    }
  </script>
</body>

</html>