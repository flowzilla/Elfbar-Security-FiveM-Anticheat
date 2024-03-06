<?php
session_start();
include('../../../func.php');

// Admin check
if (!isAdmin()) {
  header("Location: https://example.com/");
  exit;
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
    <link rel="icon" href="../../../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/images/favicon.png" type="image/x-icon">
    <title>Elfbar-Security | Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
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
  margin-top: 20px;
}
</style>
</head>
  <body class="dark-only">
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <div class="page-header">
        <div class="header-wrapper row m-0"> 
          <div class="left-header col ps-0"></div>
          <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
              <li class="profile-nav onhover-dropdown p-0 me-0">
               <div class="media profile-media"><img class="b-r-10" src="<?php echo $avatar ?>" alt="" style="width: 35px; height: 35px;">
                  <div class="media-body"><span>
                  <?php
                  echo $_SESSION["username"];
                  ?>
                    </span>
                    <p class="mb-0 font-roboto">                  
                    <?php
                    echo $_SESSION["group"];
                    ?>
                    <i class="middle fa fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="https://example.com/account"><i data-feather="user"></i><span>Account</span></a></li>
                  <li><a href="https://example.com/account/"><i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a href="https://example.com/logout.php"> <i data-feather="log-in"> </i><span>Log out</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="page-body-wrapper">
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper"><a href="https://example.com"><img class="img-fluid for-dark" src="https://cdn.discordapp.com/attachments/1021462218904182796/1060162041471586304/Unbenannt-dd1.png" alt=""></a>
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
                    <a class="sidebar-link sidebar-title link-nav" href="https://example.com" data-bs-original-title="" title="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                      <span>Home</span>
                    </a>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-8">Information</h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="https://example.com/tos/" data-bs-original-title="" title="">
                    <i data-feather="file-text"></i>
                    <span>T.O.S</span>
                    </a>
                    </li><li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="https://example.com/faq/" data-bs-original-title="" title="">
                    <i data-feather="help-circle"></i>            
                    <span>FAQ</span>
                    </a>
                    </li>
                    </li><li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="https://docs.imoshield.net/" data-bs-original-title="" title="">
                    <i data-feather="bookmark"></i>
                    <span>Docs</span>
                    </a>
                    </li>
                  <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title link-nav" href="https://example.com/discord" data-bs-original-title="" title="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
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
                    <li class="breadcrumb-item"><a href="https://example.com"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Home</li>
                    </ol>
                  </div>
                  </div>
                  <?php
                  include("../../../database.php");
                  $tableName = "logs";
                  $columns = ['id', 'title', 'text', 'data', 'date'];
                  $fetchData = fetch_data($authy, $tableName, $columns);
                  function fetch_data($authy, $tableName, $columns)
                  {
                    if (empty($authy)) {
                    } elseif (empty($columns) || !is_array($columns)) {
                    } elseif (empty($tableName)) {
                    } else {
                      $columnName = implode(", ", $columns);
                      $query = "SELECT * FROM `logs` ORDER by id DESC limit 150";
                      $result = $authy->query($query);
                      if ($result == true) {
                        if ($result->num_rows > 0) {
                          $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                          $msg = $row;
                        } else {
                          $msg = "no current bans";
                        }
                      } else {
                        $msg = "bans not found, contact our Team";
                        $err = mysqli_error($authy);
                      }
                    }
                    return $msg;
                  }
                  ?>
                  <div class="col-sm-12">
                  <div class="card">
                    <div class="card-header">
                      <h3>Auth logs</h3><span></span>
                    </div>
                    <div class="card-block row">
                      <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                          <table class="table">
                            <caption>Logs of all Servers</caption>
                            <thead>
                              <tr>
         <th>Status</th>
         <th>Reason</th>
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
          <td><?php echo $data['title'] ?? ''; ?></td>
          <td><?php echo $data['text'] ?? ''; ?></td>
          <td><?php echo $data['date'] ?? ''; ?></td>
         </tr>
         <?php
         $sn++;
                              }
                            } else { ?>
        <tr>
          <td colspan="8">
      <?php echo $fetchData; ?>
    </td>
      <tr>
      <?php
                            } ?>
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
                <p class="mb-0">2022-<script>document.write(new Date().getFullYear())</script> ©V01D & H04X </p> 
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
     $(".according-menu.other" ).css( "display", "none" );
     $(".sidebar-submenu" ).css( "display", "block" );
    }
</script>
  </body>
</html>