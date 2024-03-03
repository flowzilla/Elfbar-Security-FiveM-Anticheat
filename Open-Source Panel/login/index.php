<!DOCTYPE html>
<html lang="en">

<head>
  <link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
  <link type="text/css" rel="stylesheet" id="dark-mode-general-link">
  <style lang="en" type="text/css" id="dark-mode-custom-style"></style>
  <style lang="en" type="text/css" id="dark-mode-native-style"></style>
  <style lang="en" type="text/css" id="dark-mode-native-sheet"></style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
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

    .login-card {
      background-color: #1d1e26;
    }

    .dmca {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .login-main {
      background-color: #262932 !important;
      color: rgb(166, 166, 166);
    }

    .form-control {
      background-color: #262932 !important;
    }

    input {
      border-color: darkgray !important;
    }
  </style>
</head>

</html>

<?php
session_start();
session_regenerate_id();
require_once '../vendor/autoload.php';
use PHPGangsta_GoogleAuthenticator;

$ga = new PHPGangsta_GoogleAuthenticator();

if (isset($_GET['success'])) {
  if ($_GET['success'] == 1) {
    echo '<script>
        Swal.fire({
            icon: "success",
            title: "Information",
            text: "Your account has been created successfully. You can now log in."
        })
    </script>';
  } else {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Information",
            text: "Invalid confirmation code"
        })
    </script>';
  }
}


if (isset($_POST['btnRegisters'])) {
  $recaptcha_response = $_POST['g-recaptcha-response'];
  $recaptcha_secret = "6LcRlWQhAAAAAAZTUAJZXV8kzLn05rzE12iGFq8o";
  $recaptcha_verify_url = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response";
  $recaptcha_verify = file_get_contents($recaptcha_verify_url);
  $recaptcha_verify = json_decode($recaptcha_verify, true);
  if (!$recaptcha_verify['success']) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Information",
            text: "reCAPTCHA verification failed"
        })
    </script>';
  } else {
    include('../database.php');
    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);
    $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `password` = '$password' and username = '$username'");
    if (mysqli_num_rows($sql) > 0) {
      $keysc = mysqli_fetch_array($sql);
      $secret = $keysc['2fa_secret'];
      $enabled = $keysc['2fa_enabled'];
      if ($enabled == 1) {
        $code = $_POST['2fa_code'];
        if ($ga->verifyCode($secret, $code, 2)) {
          $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `password` = '$password' and username = '$username'");
          $user = mysqli_fetch_array($sql);
          $_SESSION["id"] = $user['userid'];
          $_SESSION["email"] = $user['email'];
          $_SESSION["username"] = $user['username'];
          $_SESSION["group"] = $user['usergroup'];
          echo "<script>window.location.href='https://panel.elfbar-security.eu/'</script>";
        } else {
          echo '<script>
          Swal.fire({
              icon: "error",
              title: "Information",
              text: "2FA verification failed"
          })
      </script>';
        }
      } else {
        $sql = mysqli_query($conn, "SELECT userid, email, username, usergroup, is_emailConfirmed FROM `users` WHERE `password` = '$password' and username = '$username'");
        $user = mysqli_fetch_array($sql);
        if ($user['is_emailConfirmed'] == 0) {
          echo '<script>
          Swal.fire({
              icon: "error",
              title: "Information",
              text: "Your email is not confirmed. Please check your email inbox and spam folder."
          })
          </script>';
        } else {
          $_SESSION["id"] = $user['userid'];
          $_SESSION["email"] = $user['email'];
          $_SESSION["username"] = $user['username'];
          $_SESSION["group"] = $user['usergroup'];
          echo "<script>window.location.href='https://panel.elfbar-security.eu/'</script>";
        }

        $date = date('Y-m-d H:i:s');
        $useridjaja = $user['userid'];
        $query = "INSERT INTO `loginlogs` (`userid`, `date`, `id`) VALUES ('$useridjaja', '$date', NULL);";
        $result = $logs->query($query);
        // Discord webhook
        $discord_webhook_url = "";
        $email = $_SESSION["email"];
        $date = date('Y-m-d H:i:s');
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $webhook_data = array(
          'username' => 'ImoShield - FiveM Anticheat',
          'avatar_url' => 'https://cdn.discordapp.com/attachments/1093499150567485492/1093499232675172354/IMOSHIELD2.png',
          'embeds' => array(
            array(
              'title' => 'New Login',
              'description' => "User **{$username}** has logged in.",
              'color' => hexdec('00ff00'),
              'fields' => array(
                array(
                  'name' => 'Email',
                  'value' => $email
                ),
                array(
                  'name' => 'Date',
                  'value' => $date
                ),
                array(
                  'name' => 'User-Agent',
                  'value' => $useragent
                ),
                array(
                  'name' => 'IP',
                  'value' => $ip
                )
              ),
              'timestamp' => date('Y-m-d\TH:i:s\Z')
            )
          )
        );
        $curl = curl_init($discord_webhook_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($webhook_data));
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_exec($curl);
        curl_close($curl);
      }
    } else {
      echo '<script>
      Swal.fire({
          icon: "error",
          title: "Information",
          text: "Wrong Username / Password"
      })
  </script>';
      $date = date('Y-m-d H:i:s');
      $useragent = $_SERVER['HTTP_USER_AGENT'];

      $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
      // Discord webhook
      $discord_webhook_url = "";
      $webhook_data = array(
        'username' => 'ImoShield - FiveM Anticheat',
        'avatar_url' => 'https://cdn.discordapp.com/attachments/1093499150567485492/1093499232675172354/IMOSHIELD2.png',
        'embeds' => array(
          array(
            'title' => 'Failed Login',
            'description' => "User **{$username}** has failed to login.",
            'color' => hexdec('ff0000'),
            'fields' => array(
              array(
                'name' => 'Date',
                'value' => $date
              ),
              array(
                'name' => 'User-Agent',
                'value' => $useragent
              ),
              array(
                'name' => 'IP',
                'value' => $ip
              )
            ),
            'timestamp' => date('Y-m-d\TH:i:s\Z')
          )
        )
      );
      $curl = curl_init($discord_webhook_url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($webhook_data));
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_exec($curl);
      curl_close($curl);
    }
  }
}

?>
<!DOCTYPE html>

<body>
  <div class="container-fluid p-0">
    <div class="row m-0">
      <div class="col-12 p-0">
        <div class="login-card">
          <div>
            <div><a class="logo" href="https://panel.elfbar-security.eu/login/"><img class="img-fluid for-light"
                  src="https://cdn.discordapp.com/attachments/1021462218904182796/1060162041471586304/Unbenannt-dd1.png"
                  alt="looginpage"><img class="img-fluid for-dark" src="" alt="looginpage"></a></div>
            <div class="login-main">
              <form class="theme-form" method="post">
                <h4>Sign in to account</h4>
                <p>Enter your username & password to login</p>
                <div class="form-group">
                  <label class="col-form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username" value="" placeholder="username"
                    required>
                </div>
                <div class="form-group">
                  <label class="col-form-label">Password</label>
                  <div class="form-input position-relative">
                    <input type="password" class="form-control" name="password" id="password" value=""
                      placeholder="********" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-form-label">2FA Code (OPTIONAL)</label>
                  <div class="form-input position-relative">
                    <input type="text" class="form-control" name="2fa_code" placeholder="2FA Code">
                  </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LcRlWQhAAAAAEubthP0Yk6Zdrt-OZI3Z8x-TR6b"></div>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <div class="form-group mb-0">
                  <div class="text-end mt-3">
                    <button type="submit" name="btnRegisters" class="btn btn-primary btn-block w-100">Sign in</button>
                  </div>
                </div>
                <p class="mt-4 mb-0 text-center">Don't have an account?<a class="ms-2"
                    href="https://panel.elfbar-security.eu/register">Create Account</a></p>
                <p class="mt-4 mb-0 text-center"><a class="ms-2" href="https://panel.elfbar-security.eu/tos">Terms</a> •
                  <a class="ms-2" href="https://panel.elfbar-security.eu/privacy">Policy</a> • <a class="ms-2"
                    href="https://panel.elfbar-security.eu/refund">Refund</a>
                </p>
                <div class="dmca">
                  <a href="//www.dmca.com/Protection/Status.aspx?ID=9c9de7b3-a4ce-4ec0-9d39-8072e9ad971a"
                    title="DMCA.com Protection Status" class="dmca-badge">
                    <img
                      src="https://images.dmca.com/Badges/dmca-badge-w100-5x1-11.png?ID=9c9de7b3-a4ce-4ec0-9d39-8072e9ad971a"
                      alt="DMCA.com Protection Status" />
                  </a>
                  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
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
    <script language="JavaScript1.2">
      function disableselect(e) {
        return false
      }
      function reEnable() {
        return true
      }
      document.onselectstart = new Function("return false")
      if (window.sidebar) {
        document.onmousedown = disableselect
        document.onclick = reEnable
      }
    </script>
</body>

</html>