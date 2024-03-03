<?php
session_start();
include('../func.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Elfbar-Security">
  <meta name="keywords" content="fivem, anticheat, anticheat leaked, free anticheat, imoshield, fivem ac">
  <meta name="author" content="ImoShield LTC.">
  <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
  <title>Elfbar-Security | Panel</title>
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
  <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
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
                    <h6 class="lan-8">Products</h6>
                  </div>
                </li>
                <script>
                  function openCloseWindow() {
                    var newWindow = window.open('https://panel.elfbar-security.eu/api/download');
                    setTimeout(function () {
                      newWindow.close();
                    }, 2000);
                  }
                </script>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="javascript:void(0)" onclick="openCloseWindow()"
                    data-bs-original-title="" title="">
                    <i data-feather="download"></i>
                    <span>Download ImoShield</span>
                  </a>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-8">Information</h6>
                  </div>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu/tos/"
                    data-bs-original-title="" title="">
                    <i data-feather="file-text"></i>
                    <span>T.O.S</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu/faq/"
                    data-bs-original-title="" title="">
                    <i data-feather="help-circle"></i>
                    <span>FAQ</span>
                  </a>
                </li>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu/refund/"
                    data-bs-original-title="" title="">
                    <i data-feather="credit-card"></i>
                    <span>Refund</span>
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
                  <a class="sidebar-link sidebar-title link-nav" href="https://panel.elfbar-security.eu/discord"
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
                  echo '<li><a href="https://panel.elfbar-security.eu/admin/server/overview/">Overview</a></li>';
                  echo '<li><a href="">Server Table</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="terminal"></i><span>Logs</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="https://panel.elfbar-security.eu/admin/logs/authlogs/">Auth Logs</a></li>';
                  echo '<li><a href="https://panel.elfbar-security.eu/admin/logs/serverlogs/">Server Logs</a></li>';
                  echo '<li><a href="https://panel.elfbar-security.eu/admin/logs/panellogs/">Panel Logs</a></li>';
                  echo '</ul>';
                  echo '<li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="cloud"></i><span>Auth</span></a>';
                  echo '<ul class="sidebar-submenu">';
                  echo '<li><a href="#">Key Overview</a></li>';
                  echo '<li><a href="https://panel.elfbar-security.eu/admin/auth/keygenerator">Key Creator</a></li>';
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
                        data-feather="home"></i></a></li>
                  <li class="breadcrumb-item">Home</li>
                </ol>
              </div>
              <div class="col-lg-12">
                <div class="header-faq">
                  <h5 class="mb-0">Anticheat</h5>
                </div>
                <div class="row default-according faq-accordion" id="accordionoc">
                  <div class="col-xl-8 xl-60 col-lg-6 col-md-7">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link ps-0 collapsed" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon" aria-expanded="false" aria-controls="collapseicon"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>How i can setup the Adminbypass?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon" aria-labelledby="collapseicon"
                        data-bs-parent="#accordionoc" style="">
                        <div class="card-body">Admin Bypass via Steam IDs:</strong> <u>add_ace identifier.steam:SteamID
                            imoadminbypass allow</u> or <strong>Admin Bypass via Groups:</strong> <u>add_ace group.admin
                            imoadminbypass allow</u></div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon2" aria-expanded="false" aria-controls="collapseicon2"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>Under what circumstances should a "global ban" be issued?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon2" data-bs-parent="#accordionoc">
                        <div class="card-body">We only ban on <u>Injections</u> which has been 100% verified</div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon3" aria-expanded="false" aria-controls="collapseicon2"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>Which commands have ImoShield?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon3" data-bs-parent="#accordionoc">
                        <div class="card-body">
                          <ul>
                            <li>imounban 17: This command unbans the player with ID 17. Note that you need to specify
                              the ID of the player you want to unban.</li>
                            <li>imoscreen 53: This command sends a screenshot of the player with ID 53 to the screenshot
                              channel. Again, you need to specify the ID of the player from whom you want the
                              screenshot.</li>
                            <li>imoclearpeds: This command removes all pedestrians (peds) from the map.</li>
                            <li>imoclearveh: This command removes all vehicles from the map.</li>
                            <li>imoclearprops: This command removes all objects (props) from the map.</li>
                            <li>imoclearall: This command removes all pedestrians, vehicles, and objects from the map.
                            </li>
                          </ul>
                          </li>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon4" aria-expanded="false" aria-controls="collapseicon2"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>How can I fix the "screenshot-basic is missing" error?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon4" data-bs-parent="#accordionoc">
                        <div class="card-body">Install screenshot-basic (<a
                            href="https://www.dropbox.com/s/7t0cnlmeorv8f4t/screenshot-basic.zip?dl=0">Download
                            here</a>) and restart your Server.</div>
                      </div>
                    </div>
                    <div class="faq-title">
                      <h6>Panel</h6>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon6" aria-expanded="false"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg> How i can renew my License?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon6" aria-labelledby="collapseicon5"
                        data-bs-parent="#accordionoc">
                        <div class="card-body">You cant reset your License Key.</div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon7" aria-expanded="false" aria-controls="collapseicon2"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>How i can reset the License IP?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon7" data-bs-parent="#accordionoc">
                        <div class="card-body">Contact our Support via Discord</div>
                      </div>
                    </div>
                    <div class="faq-title">
                      <h6>Account</h6>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon9" aria-expanded="false"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>How i can change my Email or password?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon9" aria-labelledby="collapseicon9"
                        data-bs-parent="#accordionoc">
                        <div class="card-body">You can change your email and password via the <a
                            href="https://panel.elfbar-security.eu/account/">settings</a> page</div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon10" aria-expanded="false" aria-controls="collapseicon2"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>Can i enable 2fa?</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon10" data-bs-parent="#accordionoc">
                        <div class="card-body">Yes soon!</div>
                      </div>
                    </div>
                    <div class="faq-title">
                      <h6>Other</h6>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed ps-0" data-bs-toggle="collapse"
                            data-bs-target="#collapseicon13" aria-expanded="false"><svg
                              xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              class="feather feather-help-circle">
                              <circle cx="12" cy="12" r="10"></circle>
                              <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                              <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>Partner</button>
                        </h5>
                      </div>
                      <div class="collapse" id="collapseicon13" aria-labelledby="collapseicon13"
                        data-bs-parent="#accordionoc">
                        <div class="card-body">You need an minimum of 800 Discord Members for an Partnership</div>
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
  <script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
      $(".according-menu.other").css("display", "none");
      $(".sidebar-submenu").css("display", "block");
    }
  </script>
</body>

</html>