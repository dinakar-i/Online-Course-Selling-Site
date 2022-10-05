<?php
session_start();
include '../include/encodes_decodes.php';
include '../include/init.php';
if (isset($_SESSION['zdk'])) {
    echo " <script>
    
        if (confirm('Are you already loged in sure want to logout?')) {
            window.location.href = '../include/Logout.php';
        }else{
            window.location.href = '../';
        }
</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>
        Login

    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--goole fonts----------->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <!--===============================================================================================-->
    <!--css----------------->
    <link rel="stylesheet" href="myscript/style.css">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
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

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form class="login100-form validate-form" method="post">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                        Login
                    </span>
                    <br>
                    <div class="wrap-input100 validate-input m-b-10" data-validate="Username is required">
                        <input class="input100" type="email" name="username" placeholder="Email...">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-shipping-fast"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fas fa-key"></i>
                        </span>
                    </div>
                    <?php
                    if (isset($_POST['submit'])) { 
                        $email = $_POST['username'];
                        $pass = md5($_POST['pass']);
                        $date=date('d-m-y');
                        $sql_email = mysqli_real_escape_string($conn, $email);
                        if(!filter_var($sql_email,FILTER_VALIDATE_EMAIL)){
                            echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Oh User Email not vaild format <a class='log' href='../spoof-account/'>Please SignUp here</a></h3></div><br></div>";
                        }else{
                        $sql_pass = mysqli_real_escape_string($conn, $pass);
                        $select_user = "SELECT * FROM users WHERE email_id='$sql_email' AND password='$sql_pass'";
                        $valid_user=User::valid_user($email);
                        $valid_user_count= mysqli_num_rows($valid_user);
                        
                        $qurey_result = Post::qurey($select_user);
                        $email_count = mysqli_num_rows($qurey_result);
                        if ($email_count == 0 || $valid_user_count==0) {
                            echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Oh User Email or Password Does Not Match! if you dont have a account<a class='log' href='../spoof-account/'> SignUp here</a></h3></div><br></div>";
                        } else {
                            $row = mysqli_fetch_assoc($qurey_result);
                            session_regenerate_id('TRUE');
                            $name=$row['first_name'];
                            $_SESSION['username'] = $row['email_id'];
                            $_SESSION['first_name'] = $row['first_name'];
                            $_SESSION['zdk'] =  $row['role'];
                           User::Set_cookie($email,$pass);
                           $encode_pass_re=Enceodes::two_encode($_POST['pass']);
                           User::Insert("recent_login","login_email,login_name,login_password,login_date","'$email','$name','$encode_pass_re','$date'");
                            header('location:../');
                        }
                    }
                    }
                    ?>

                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn" name="submit" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="text-center w-full p-t-25 p-b-230">
                        <a class="txt1" href="../spoof-account/">
                            Create new account
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                    <div class="text-center w-full">
                        <a href="../forgot-password/" class="txt1">
                            Forgot/ Password?
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