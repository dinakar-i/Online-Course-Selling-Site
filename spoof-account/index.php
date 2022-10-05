<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SignUp</title>
    <meta charset="UTF-8">
    <!--------google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <!-------------css-------------------------->
    <link rel="stylesheet" href="myscript/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
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
    <!---font awsome------------->

</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form  id='welcome' method="post" class="login100-form validate-form">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                        Sign Up
                    </span>

                    <div class="wrap-input100 validate-input m-b-10" data-validate="username is required">
                        <input class="input100" type="text" name="firstname" placeholder="Name here">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>


                

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Email is required">
                        <input class="input100" type="email" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <!-- <i class="fa fa-user"></i> -->
                            <i class="fas fa-paper-plane"></i>
                        </span>
                    </div>



                    <div class="wrap-input100 validate-input m-b-10" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    


                    <?php
                    include '../include/encodes_decodes.php';
                    include '../include/mail.php';
                    include '../include/init.php';
                    if (isset($_POST['login'])) {
                        $first_name = $_POST['firstname'];
                        $sql_name= mysqli_real_escape_string($conn, $first_name);
                        $email = $_POST['email'];
                        
                        $sql_email = mysqli_real_escape_string($conn, $email);
                        if(!filter_var($sql_email,FILTER_VALIDATE_EMAIL)){
                            echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Oh no Not valid email format!</h3></div><br></div>";
                        }else{
                        
                        $pass = $_POST['pass'];
                        $sql_pass = mysqli_real_escape_string($conn, $pass);
                        $date = date('d-m-y');
                        
                        $role = 'Subscriber';
                        $verify = User::qurey("SELECT * FROM users WHERE email_id='$sql_email' AND activate=0");
                       
                        $count = mysqli_num_rows($verify);
                        if ($count == 0) {
                                if (strlen($pass) >= 8) {
                                    $verify_email_count = User::qurey("SELECT * FROM users WHERE email_id='$sql_email'");
                                    $verify_email_counts = mysqli_num_rows($verify_email_count);
                                    if($verify_email_counts==0){
                                        $insert_value = User::register($sql_name, strtolower($sql_email), md5($sql_pass), $role, $date);
                                    }else{
                                        $insert_value=User::qurey("UPDATE users set first_name='$sql_name',password='$sql_pass' WHERE email_id='$sql_email'");
                                    }
                                    if ($insert_value) {
                                        $verify_data = User::qurey("SELECT * FROM users WHERE email_id='$sql_email'");
                                        $get_email_number=mysqli_fetch_assoc($verify_data);
                                        $email_number=$get_email_number['user_id'];
                                        $otp=rand(100000,999999);
                                        $mail_msg="<link href='https://fonts.googleapis.com/css2?family=Nosifer&display=swap' rel='stylesheet'>
 <body>
     
 <div style='width:100%;background-color:lightblue;height:400px;'>
 <h1 style='font-family: Nosifer, cursive;font-size:20px;text-align:center;padding-top:3%;' class='head_title'><span style='color: blueviolet;'>S</span><span style='color: lightseagreen;'>p</span><span style='color: yellow;'>o</span><span style='color:yellow;'>o</span><span style='color:blue;'>F</span><span style='color: red;'>c</span><span style='color:#E602B4;'>o</span><span style='color: #1DDE0B;'>l</span><span style='color:#09E0D6;'>o</span><span style='color:#D705F2;'>r</span><span style='color:darkgreen'>s</span>
  </h1>
    <h3 style='text-align: center;color:blueviolet;'>Congrats welcome to spoofcolors</h3>
    <h4 style='color: white;font-weight:800px; text-align:center;font-size:30px;'>Your code : $otp</h4>
</div>
  
 </body>
";
                                        Mail::send_mail($email,'Spoofcolors Account verification',$mail_msg);
                                        $cheak_value_exist=Post::sel_table_by_title('authentication','email',$email);
                                        $exits_count=mysqli_num_rows($cheak_value_exist);
                                        $expiry= date("Y-m-d H:i:s");
                                        if($exits_count==0){
                                            User::qurey("INSERT into authentication (email,email_number,otp,expiry_date) VALUES ('$email',$email_number,$otp,'$expiry')");
                                        }else{
                                            User::qurey("UPDATE authentication set email='$email',email_number=$email_number,otp=$otp,no_time=0,expiry_date='$expiry' WHERE email='$email'");
                                        } 
                                          $data_loop_encode=Enceodes::loop_encode($email);
                                          $data_main_encode=Enceodes::main_encode($data_loop_encode);
                                        $url="../authentication/?authtoken=$data_main_encode";
                                        header("location:$url");
                                    }
                                } else {
                                    echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Password len Up to 8 characters</h3></div><br></div>";
                                }
                        } else {
                            echo "<div class='log_div'><div class='container'><h3 class='log_txt'>This Account is Alredy existed<a class='log' href='https://spoofcolors.com/Login/'> Login here</a></h3></div><br></div>";
                        }
                    }}
                    ?>

                    <div class="container-login100-form-btn p-t-10">
                        <button type="submit" name="login" class="login100-form-btn">
                            SignUp
                        </button>
                    </div>
                    <div class="text-center w-full"><br>
                        <a class="txt1" href="../Login/">
                            I already have a account
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                </form>


                <!-- Otp validetion from -->


               



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