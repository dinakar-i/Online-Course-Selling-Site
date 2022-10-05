<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        Login

    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!------------ggole fonts---->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <!------------css---------->
    <link rel="stylesheet" href="myscript/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <?php
    include '../include/init.php';
    ?>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form class="login100-form validate-form" method="post">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                        Forgot
                    </span>
                    <br>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                        <input class="input100" type="email" name="email_id" placeholder="Email id">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-paper-plane"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                        <input class="input100" type="password" name="current_pass" placeholder="Current password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100" type="password" name="new_pass" placeholder="New password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100" type="password" name="confirm_pass" placeholder="Confirm password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>

                    <?php
                    // ob_start();
                    if (isset($_POST['submit'])) {
                        $email = $_POST['email_id'];
                        $current_pass = md5($_POST['current_pass']);
                        $new_pass = $_POST['new_pass'];
                        $sql_new_pass = mysqli_real_escape_string($conn, $new_pass);
                        $sql_curent_pass = mysqli_real_escape_string($conn, $current_pass);
                        $sql_email = mysqli_real_escape_string($conn, $email);
                        $new_pass = md5($sql_new_pass);
                        $sql_confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_pass']);
                        $confirm_pass = md5($sql_confirm_pass);
                        if ($new_pass == $confirm_pass) {
                            $select_mail = POST::forgot('users', 'email_id', $sql_email, 'password', $sql_curent_pass);
                            $count = mysqli_num_rows($select_mail);
                            if ($count == 1) {
                                if (strlen($confirm_pass) >= 8) {
                                    $update_password = POST::Update('users', 'password', $confirm_pass, 'email_id', $email);
                                    if ($update_password) {
                                        header('location:https://www.spoofcolors.com/Login/');
                                    } else {
                                        echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Somthong went Rong</h3></div><br></div>";
                                    }
                                } else {
                                    echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Password len Up to 8 Charcters</h3></div><br></div>";
                                }
                            } else {
                                echo "<div class='log_div'><div class='container'><h3 class='log_txt'>User Email or Password is Does not  correct </h3></div><br></div>";
                            }
                        } else {
                            echo "<div class='log_div'><div class='container'><h3 class='log_txt'>New Password an Confirm Password Does Not Match</h3></div><br></div>";
                        }
                    } ?>

                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn" name="submit" type="submit">
                            Update
                        </button>
                    </div>
                    <div class="text-center w-full p-t-25 p-b-230">
                        <a href="../forgot-auth/" class="txt1">
                            Try Another way ?
                        </a>
                    </div>
                  

                </form>
            </div>
        </div>
    </div>



    <script src="https://kit.fontawesome.com/14dbca7644.js" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>

</html>