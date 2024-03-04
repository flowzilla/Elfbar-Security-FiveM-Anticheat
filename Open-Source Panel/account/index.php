<?php
session_start();
include('../func.php');

if (isset($_POST['emailchange'])) {
  $id = $_SESSION['id'];
  $email = $_POST['newmail'];
  $password = base64_encode($_POST['password']);
  $sql = "UPDATE `users` SET `email` = ? WHERE `userid` = ? AND `password` = ?";
  $stmt = mysqli_prepare($link, $sql);

  mysqli_stmt_bind_param($stmt, "sis", $email, $id, $password);
  if (mysqli_stmt_execute($stmt)) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","Email changed successfuly</b>","success");';
    echo '}, 500);</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","ERROR! Code: [66]</b>","error");';
    echo '}, 500);</script>';
  }
  mysqli_stmt_close($stmt);
}


if (isset($_POST['passswordchange'])) {
  $id = $_SESSION['id'];
  $currentPassword = base64_encode($_POST['currentpass']);
  $password = base64_encode($_POST['newpass']);
  $sql = "UPDATE `users` SET `password` = ? WHERE `userid` = ? AND `password` = ?";
  $stmt = mysqli_prepare($link, $sql);

  mysqli_stmt_bind_param($stmt, "sis", $password, $id, $currentPassword);
  if (mysqli_stmt_execute($stmt)) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","Password changed successfully</b>","success");';
    echo '}, 500);</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","ERROR! Current password wrong</b>","error");';
    echo '}, 500);</script>';
  }
  mysqli_stmt_close($stmt);
}

if (isset($_POST['usernamechange'])) {
  $id = $_SESSION['id'];
  $username = $_POST['newusername'];
  $password = base64_encode($_POST['password']);
  $checkSql = "SELECT COUNT(*) FROM `users` WHERE `username` = ?";
  $checkStmt = mysqli_prepare($link, $checkSql);
  mysqli_stmt_bind_param($checkStmt, "s", $username);
  mysqli_stmt_execute($checkStmt);
  mysqli_stmt_bind_result($checkStmt, $count);
  mysqli_stmt_fetch($checkStmt);
  mysqli_stmt_close($checkStmt);
  $sql = "UPDATE `users` SET `username` = ? WHERE `userid` = ? AND `password` = ?";
  $stmt = mysqli_prepare($link, $sql);

  mysqli_stmt_bind_param($stmt, "sis", $username, $id, $password);
  if (mysqli_stmt_execute($stmt) and !$count > 0) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","Username changed successfully</b>","success");';
    echo '}, 500);</script>';
    $_SESSION["username"] = $username;
  } else if (!mysqli_stmt_execute($stmt) and !$count > 0) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","ERROR! Current password wrong</b>","error");';
    echo '}, 500);</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { sweetAlert("<b>Panel System","ERROR! Username already exists!</b>","error");';
    echo '}, 500);</script>';
  }
  mysqli_stmt_close($stmt);
}

require_once '../vendor/autoload.php';
use PHPGangsta_GoogleAuthenticator;

$ga = new PHPGangsta_GoogleAuthenticator();
$secret = $ga->createSecret();
$qrCodeUrl = $ga->getQRCodeGoogleUrl('ImoShield', $secret);
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
  <script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
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

    .card {
      height: 100%;
    }

    .form-group {
      margin-top: 7px;
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
                <li><a href="https://example.com/account"><i data-feather="user"></i><span>Account</span></a>
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
                <script>
                  function openCloseWindow() {
                    var newWindow = window.open('https://example.com/api/download');
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
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com/tos/"
                    data-bs-original-title="" title="">
                    <i data-feather="file-text"></i>
                    <span>T.O.S</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title link-nav" href="https://example.com/faq/"
                    data-bs-original-title="" title="">
                    <i data-feather="help-circle"></i>
                    <span>FAQ</span>
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
                  <a class="sidebar-link sidebar-title link-nav" href="https://docs.imoshield.net/"
                    data-bs-original-title="" title="">
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
                  <li class="breadcrumb-item"><a href="https://example.com"> <i
                        data-feather="home"></i></a>
                  </li>
                  <li class="breadcrumb-item">Home</li>
                </ol>
              </div>
            </div>
            <style>
              .card {
                margin-right: 10px;
                margin-top: 10px;
              }
            </style>
            <?php $idddd = $_SESSION["id"];
            $query = "SELECT * FROM `users` WHERE `userid` = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("i", $idddd);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $dc = $row['discord'];
            $em = $row['email'];
            $psw = $row['password'];
            $usn = $row['username'];
            $stmt->close();
            ?>
            <div class="row">
              <div class="col-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Change Email</h3>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="old_email">Old Email</label>
                        <input type="text" class="form-control" id="old_email" name="old_email" readonly
                          value="<?php echo $em; ?>">
                      </div>
                      <div class="form-group">
                        <label for="newmail">New Email</label>
                        <input type="text" class="form-control" id="newmail" name="newmail">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="emailchange">Change</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Change Password</h3>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="nothing">Password</label>
                        <input type="password" class="form-control" id="currentpass" name="currentpass" value="">
                      </div>
                      <div class="form-group">
                        <label for="newpass">New Password</label>
                        <input type="password" class="form-control" id="newpass" name="newpass">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="passswordchange">Change</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="col-4">
                <div class="card">
                  <div class="card-header">
                    <h3>Change Username</h3>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">
                      <div class="form-group">
                        <label for="newusername">New username</label>
                        <input type="text" class="form-control" id="newusername" name="newusername">
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="usernamechange">Change</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="card">
                    <div class="card-header">
                      <h3>Connect Discord Account</h3>
                    </div>
                    <div class="card-body">
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="duration2">To get the Customer role on our Discord server, you need to connect
                            your Discord account with your Panel account.</label>
                          <label for="duration2" style="color:red">Note: Your account is currently connected to the
                            following Discord ID and has the Customer role on our Discord server:
                            <?php echo $dc; ?>
                          </label>
                          <button class="btn btn-primary btn-block" type="button"
                            onclick="location.href='https://example.com/discord/link.php'">
                            <i class="icon-link"></i> Connect to Discord
                          </button>
                          <button class="btn btn-danger btn-block" type="button"
                            onclick="location.href='https://example.com/discord/unlink.php'">
                            <i class="icon-unlink"></i> Remove Discord
                          </button>
                          <label for="duration2" style="color:red">Note: Our system takes about a minute to give you or
                            remove the role.</label>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>


                <?php
                function generate_2fa_card($qr_code_url)
                {
                  $is_2fa_enabled = false;
                  $card_html = '
    <div class="col-4">
      <div class="card disabled">
        <div class="card-header">
          <h3>Enable / Disable 2fa (Coming Soon)</h3>
        </div>
        <div class="card-body">
        <p>Unfortunately, this feature is not currently available. Were working hard to implement it as soon as possible, and we apologize for any inconvenience this may cause.</p>
        <p>Please check back later for updates on when this feature will be available. In the meantime, make sure to keep your password secure and avoid using the same password across multiple accounts. </p>
     
        </div>
      </div>
    </div>
  ';
                  return $card_html;
                }

                echo generate_2fa_card($qrCodeUrl);
                ?>

                <div class="col-4 xl-50 notification box-col-6">
                  <div class="card">
                    <div class="card-header card-no-border">
                      <div class="header-top">
                        <h5 class="m-0">Latest 3 Logins</h5>
                        <div class="card-header-right-icon">
                        </div>
                      </div>
                    </div>
                    <div class="card-body new-update pt-0 ">
                      <div class="activity-timeline">
                        <?php
                        $query = "SELECT * FROM loginlogs WHERE userid = '$idddd' order by date DESC limit 3";
                        $result = $logs->query($query);
                        while ($row = $result->fetch_array()) {
                          echo '<div class="media">';
                          echo '<div class="activity-dot-primary"></div>';
                          echo '<div class="media-body"><span class="text-success">A successful login was detected on your account.</span><span></span>';
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
  <script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
  <script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
      $(".according-menu.other").css("display", "none");
      $(".sidebar-submenu").css("display", "block");
    }
  </script>
</body>

</html>