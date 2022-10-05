<?php
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
    <?php
    include '../include/init.php';
    include '../include/mail.php';
    include '../include/encodes_decodes.php';
                      if(isset($_GET['authtoken'])){
                        $main_decode =Enceodes::main_decode($_GET['authtoken']);
                        $authtoken=Enceodes::loop_decode($main_decode);
                        $check_valid=POST::sel_table_by_title('authentication','email',$authtoken);
                        $valid_count=mysqli_num_rows($check_valid);
                        if($valid_count==0){
                            header('location:../');
                        }
                      }
                    ?>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
                <form class="login100-form validate-form" method="post">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span style=" text-align: center;background-color:turquoise;height:120px; opacity:0.9 ;margin-bottom:20px;border-radius:5px;" class="login100-form-title p-t-20 p-b-45">
                        We send OTP TO YOUR MAIL or you will check also spam folder
                    </span>
                  
                    <div class="wrap-input100 validate-input m-b-10" data-validate="OTP is required">
                        <input class="input100"type="number" name="otp" placeholder="Enter Otp">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fas fa-key"></i>
                        </span>
                    </div>
                    
                    <?php
                    
                    if(isset($_POST['verify'])){
                        
                        $value= intval(mysqli_real_escape_string($conn,$_POST['otp'])) ;
                        $check_valid=User::qurey("SELECT * FROM authentication WHERE email='$authtoken' AND otp=$value");
                        $otp_valid_count=mysqli_num_rows($check_valid);
                        if($otp_valid_count==1){
                                  User::qurey("UPDATE users set activate=0 WHERE email_id='$authtoken'");
                                  User::qurey("DELETE FROM authentication WHERE email='$authtoken'");
                                  $email_detailse=User::select_user($authtoken);
                                  $row=mysqli_fetch_assoc($email_detailse);
                                  session_regenerate_id('TRUE');
                                  $_SESSION['username'] = $row['email_id'];
                                  $_SESSION['first_name'] = $row['first_name'];
                                  $_SESSION['second_name'] = $row['second_name'];
                                  $_SESSION['zdk'] =  $row['role'];
                                  header('location:../');
                                  
                        }else{
                            $check_no_of_time=User::qurey("SELECT * FROM authentication WHERE email='$authtoken'");
                            $row_check_no_of_time=mysqli_fetch_assoc($check_no_of_time);
                            $value_no_time= $row_check_no_of_time['no_time'];
                            $total=$value_no_time+1;
                            User::qurey("UPDATE authentication set no_time=$total WHERE email='$authtoken'");
                            if($value_no_time<4){
                                echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Otp is not valid,Five attempt only</h3></div><br></div>";
                            }else if ($value_no_time>=4){
                                User::qurey("DELETE FROM authentication WHERE email='$authtoken'");
                                $check_valid=POST::sel_table_by_title('authentication','email',$authtoken);
                                $valid_count=mysqli_num_rows($check_valid);
                                if($valid_count==0){
                                    header('location:../');
                                }
                              }
                            }
                           
                        }
                    
                    ?>
                    <div class="container-login100-form-btn p-t-10">
                        <button class="login100-form-btn" name="verify" type="submit">
                            Verify
                        </button>
                    </div>
                    <div class="text-center w-full">
                        <a class="txt1" href="../spoof-account/">
                            Create new account
                            <i class="fa fa-long-arrow-right"></i>
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