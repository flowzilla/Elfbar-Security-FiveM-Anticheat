<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

?>

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
  <link rel="icon" href="https://cdn.example.com/assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="https://cdn.example.com/assets/images/favicon.png" type="image/x-icon">
  <title>Elfbar-Security | Panel</title>
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/icofont.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/themify.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/flag-icon.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/chartist.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/feather-icon.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/vendors/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/style.css">
  <link id="color" rel="stylesheet" href="https://cdn.example.com/assets/css/color-1.css" media="screen">
  <link rel="stylesheet" type="text/css" href="https://cdn.example.com/assets/css/responsive.css">
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

    .checkbox_animated {
      background-color: darkgray !important;
    }
  </style>
</head>

</html>


<?php
session_start();
if (isset($_POST['btnRegister'])) {
  include('../database.php');

  $email = $_POST['email'];
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if (mysqli_num_rows($sql) > 0) {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Information',
        text: 'Email already registered'
      })
    </script>
    <?php

  } else {
    $username = $_POST['username'];
    $key = $_POST['license'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    if (!empty($username) && !empty($key) && !empty($email) && !empty($password)) {
      $result = mysqli_query($conn, "SELECT * FROM `keys` WHERE license = '$key'");
      if (mysqli_num_rows($result) > 0) {
        $sql5 = mysqli_query($conn, "SELECT * FROM users where username='$username'");
        if (mysqli_num_rows($sql5) > 0) {
          ?>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Information',
              text: 'Username already exists'
            })
          </script>
          <?php

        } else {

          ini_set('display_errors', '1');
          ini_set('display_startup_errors', '1');
          $date = date('d.m.y H:i:s');
          $result2 = mysqli_query($link, "SELECT * FROM `keys` WHERE license = '$key'");
          $lc = mysqli_fetch_array($result2);
          $sql = "INSERT INTO `users` (`username`,`email`,`password`, `created_since`) VALUES ('$username','$email','$password','$date')";
          mysqli_query($conn, $sql);
          $key = $lc['license'];
          $licenseid = $lc['licenseid'];
          $expire = $lc['exp'];
          $tp = null;
          if ($expire == "1 month") {
            $tp = new DateTime();
            $tp->modify('+1 month');
            $tp = $tp->format('d.m.y');
          } else if ($expire == "3 month") {
            $tp = new DateTime();
            $tp->modify('+3 months');
            $tp = $tp->format('d.m.y');
          } else {
            $tp = "31.12.3000";
          }

          $result3 = mysqli_query($link, "SELECT * FROM `users` WHERE `email`= '$email'");
          $lc1 = mysqli_fetch_array($result3);
          $id = $lc1['userid'];
          $sql2 = "INSERT INTO `redem_license` (`licenseid`,`license`,`expires`,`userid`) VALUES ('$licenseid','$key','$tp','$id')";
          mysqli_query($conn, $sql2);
          $date2 = date('d.m.y | H:i');
          $sql1 = "DELETE FROM `keys` WHERE license = '$key'";
          mysqli_query($conn, $sql1);
          $text = "Your account has been successfully activated with a license. Please download the anticheat, upload it to your Server and start the anticheat. After that you should see the server in the table below. There you can press Manage and set everything. If you encounter any problems or have any questions, please contact our Discord support.";
          $sql = "INSERT INTO `notifications` (`text`, `date`,`userid`) VALUES ('$text','$date','$id')";
          mysqli_query($conn, $sql);

          // Discord webhook
          $discord_webhook_url = "";
          $webhook_data = array(
            'username' => 'ImoShield - FiveM Anticheat',
            'avatar_url' => 'https://cdn.discordapp.com/attachments/1093499150567485492/1093499232675172354/IMOSHIELD2.png',
            'embeds' => array(
              array(
                'title' => 'User Register',
                'description' => 'User ' . $username . ' with email ' . $email . ' has successfully activated their account with license ' . $key . '' . date('Y-m-d H:i:s'),
                'color' => hexdec('00ff00'),
                'footer' => array(
                  'text' => 'Register Alert'
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



          $confirmation_code = bin2hex(random_bytes(16));
          $sql = "UPDATE users SET emailcode = '$confirmation_code' WHERE email='$email'";
          mysqli_query($conn, $sql);

          $mail = new PHPMailer(true);
          $mail->isSMTP();
          $mail->CharSet = 'UTF-8';
          $mail->Host = '';
          $mail->Port = 587;
          $mail->SMTPSecure = 'tls';
          $mail->SMTPAuth = true;
          $mail->Username = '';
          $mail->Password = '';

          $mail->setFrom('noreply@imoshield.net', 'ImoShield - FiveM Anticheat');

          $mail->addAddress($email, $username);

          $mail->Subject = 'Confirm your email address - ImoShield';

          $mail->isHTML(true);
          $mail->Body = '
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImoShield email verify</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
      body{
      width: 650px;
      font-family: work-Sans, sans-serif;
      background-color: #f6f7fb;
      display: block;
      }
      a{
      text-decoration: none;
      }
      span {
      font-size: 14px;
      }
      p {
        font-size: 13px;
        line-height: 1.7;
        letter-spacing: 0.7px;
        margin-top: 0;
      }
      .text-center{
      text-align: center
      }
      h6 {
      font-size: 16px;
      margin: 0 0 18px 0;
      }
      
      .footer {
          position: fixed;
          bottom: 0;
          width: 100%;
          padding: 10px;
          background-color: #f6f7fb;
          text-align: center;
      }
  
    </style>
  </head>
  <body>
  <table style="width: 100%">
  <tbody>
      <tr>
          <td>
              <table style="background-color: #f6f7fb; width: 100%">
                  <tbody>
                      <tr>
                          <td>
                          </td>
                      </tr>
                  </tbody>
              </table>
              <table style="width: 650px; margin: 0 auto; background-color: #fff; border-radius: 8px">
                  <tbody>
                      <tr>
                          <td style="padding: 30px">
                              <p>Dear Customer</p><br>
                              <p>Thank you for choosing ImoShield</p>
                              <p>Please confirm your email address to help us ensure your account is always protected</p>
                              <p style="text-align: center">
  <a href="https://example.com/confirm.php?code=' . $confirmation_code . '" style="padding: 10px; background-color: #7366ff; color: #fff; display: inline-block; border-radius: 4px">
    Verify your email
  </a>
</p>

                              <p>For further technical questions and support, please contact us at support@imoshield.net</p>
                              <p>We are looking forward to cooperating with you!</p>
                              <p style="margin-bottom: 0">
                                  Best Regards,<br>ImoShield team
                              </p>
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <div class="footer">
                                  <a href="https://example.com/tos/">Terms</a> | <a href="https://example.com/refund/">Refund</a> | <a href="https://example.com/policy/">Policy</a><br>
                                  This email was automatically generated. &copy; 2023 ImoShield - FiveM Anticheat.
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </td>
      </tr>
  </tbody>
</table>
    </body>
    </html>
    
';

          // Send the email
          if ($mail->send()) {
            ?>
            <script>
              Swal.fire({
                icon: 'success',
                title: 'Information',
                text: 'Please check your email to confirm your account. If you dont see the email in your inbox, please check your spam folder.'
              })
            </script>
            <?php
          } else {
            ?>
            <script>
              Swal.fire({
                icon: 'error',
                title: 'Information',
                text: 'Something went wrong, please try again later.'
              })
            </script>
            <?php
          }
          echo "<script>window.location.href='https://example.com/login'</script>";
          exit;
        }
      } else {
        ?>
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Information',
            text: 'License Key not found'
          })
        </script>
        <?php
      }
    } else {
      ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Invalid',
          text: 'Input Fields cant be empty'
        })
      </script>
      <?php

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
            <div><a class="logo" href="index.html"><img class="img-fluid for-light"
                  src="https://cdn.discordapp.com/attachments/1021462218904182796/1060162041471586304/Unbenannt-dd1.png"
                  alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png"
                  alt="looginpage"></a></div>
            <div class="login-main">
              <form class="theme-form" method="post">
                <h4>Create your account</h4>
                <p>Enter your personal details to create account</p>
                <div class="form-group">

                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value=""
                      placeholder="username" required>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email" value=""
                      placeholder="test@gmail.com" required data-bs-original-title="" title=""><small
                      class="form-text text-muted" id="emailHelp">You need to verify your email address.</small>
                  </div>

                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input type="password" class="form-control" name="password" id="password" value=""
                        placeholder="********" required>

                    </div>
                    <div class="form-group">
                      <label class="col-form-label">License</label>
                      <input type="text" class="form-control" name="license" id="license" value=""
                        placeholder="example: IMOSHIELD_9475HXJDKQ57KD" required>
                    </div>

                  </div>
                  <div class="form-group mb-0">
                    <p class="mt-4 mb-0 text-center">
                      <input type="checkbox" id="terms-checkbox">
                      <label for="terms-checkbox" class="ms-2">I accept the <a href="https://example.com/tos">Terms</a>,
                        <a href="https://example.com/privacy">Policy</a> and <a
                          href="https://example.com/refund">Refund</a></label>
                    </p>
                    <button class="btn btn-primary btn-block w-100" name="btnRegister" type="submit">Create
                      Account</button>
                  </div>
                  <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2"
                      href="https://example.com/login">Sign in</a></p>
                  <p class="mt-4 mb-0 text-center"><a class="ms-2" href="https://example.com/tos">Terms</a> • <a
                      class="ms-2" href="https://example.com/privacy">Policy</a> • <a class="ms-2"
                      href="https://example.com/refund">Refund</a>
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