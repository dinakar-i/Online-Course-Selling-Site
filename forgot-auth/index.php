
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
    session_start();
    ?>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/img-01.jpg');">
            <div class="wrap-login100 p-t-190 p-b-30">
             <?php 
             
             if(!isset($_GET['keys']) AND !(isset($_GET['authkeys']))){
             ?>
                <form class="login100-form validate-form" method="post">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                        Sent otp
                    </span>
                    <br>
                    

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Email is required">
                        <input class="input100" type="email" name="email" placeholder="Enter a email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fas fa-at"></i>
                        </span>
                    </div>
                   <?php
                   include '../include/mail.php';
                   include '../include/encodes_decodes.php';
                   if(isset($_POST['setauth'])){
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                        echo $emailErr;
                      }else{
                          $slect_email_is_valid=User::valid_user($_POST['email']);
                          $mysqli_num_rows=mysqli_num_rows($slect_email_is_valid);
                          if($mysqli_num_rows==1){
                              $email=$_POST['email'];
                              $otp=rand(100000,999999);
                              $mail_msg="<link href='https://fonts.googleapis.com/css2?family=Nosifer&display=swap' rel='stylesheet'>
 <body>
     
 <div style='width:100%;background-color:lightblue;height:400px;'>
 <h1 style='font-family: Nosifer, cursive;font-size:20px;text-align:center;padding-top:3%;' class='head_title'><span style='color: blueviolet;'>S</span><span style='color: lightseagreen;'>p</span><span style='color: yellow;'>o</span><span style='color:yellow;'>o</span><span style='color:blue;'>F</span><span style='color: red;'>c</span><span style='color:#E602B4;'>o</span><span style='color: #1DDE0B;'>l</span><span style='color:#09E0D6;'>o</span><span style='color:#D705F2;'>r</span><span style='color:darkgreen'>s</span>
  </h1>
    <h3 style='text-align: center;color:blueviolet;'>Forgot password code from spoofcolors</h3>
    <h4 style='color: white;font-weight:800px; text-align:center;font-size:30px;'>Your code : $otp</h4>
</div>
  
 </body>";
                              Mail::send_mail($_POST['email'],'Forgot password otp check from spoofcolors',$mail_msg);
                              $value=Post::sel_table_by_title('forgot_authentication','email',$email);
                              $mysqli_count_value=mysqli_num_rows($value);
                              
                              if($mysqli_count_value!==0){
                                  User::qurey("UPDATE forgot_authentication SET otp=$otp,count=0 WHERE email='$email'");
                              }else{
                                User::qurey("INSERT into forgot_authentication (email,otp) VALUES ('$email',$otp)");
                              }
                              $loop_encription=Enceodes::loop_encode($email);
                              $main_encrybtion=Enceodes::main_encode($loop_encription);
                              
                              header("location:../forgot-auth/?keys=$main_encrybtion");
                          }else{
                              echo "<div class='log_div'><div class='container'><h3 class='log_txt'>That Email is Not Sign Up our Site<a class='log' href='../spoof-account/'> SignUp here</a></h3></div><br></div>";
                          }
                      }
                   }
                   ?>
                     
                    <div  class="container-login100-form-btn p-t-10">
                        <button id="click" class="login100-form-btn" name="setauth" value="submit" type="submit">
                            Send Otp
                        </button>
                    </div>
                       
                    
                    <div class="text-center w-full">
                    <br>
                        <a class="txt1" href="../spoof-account/">
                            Create new account
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                      
                </form>
                <?php }
                
                else if(isset($_GET['keys'])){
                    ?>
                     <form class="login100-form validate-form" method="post">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                    <div class='log_div'><div class='container'><br><h3 class='log_txt'>We will send Otp to your mail Id an you check also your spam folder. </h3></div><br></div>
                    </span>
                    <br>
                    

                    <div class="wrap-input100 validate-input m-b-10" data-validate="Otp is required">
                        <input class="input100" type="number" name="otp" placeholder="Enter a Otp">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fas fa-at"></i>
                        </span>
                    </div>
                       <?php
                       include '../include/encodes_decodes.php';
                       if(isset($_GET['keys'])){
                           $docode_main_encryption=Enceodes::main_decode($_GET['keys']);
                           $decode_loop_encrybtion=Enceodes::loop_decode($docode_main_encryption);
                          $email=$decode_loop_encrybtion;
                          $select_otp_email=User::qurey("SELECT * FROM forgot_authentication WHERE email='$email'");
                          $otp_mail_count=mysqli_num_rows($select_otp_email);
                          if($otp_mail_count==1){
                            if(isset($_POST['setauth'])){
                                $otp=intval(mysqli_real_escape_string($conn,$_POST['otp']));
                                $otp_email=User::qurey("SELECT * FROM forgot_authentication WHERE email='$email' AND otp=$otp");
                                $otp_count=mysqli_num_rows($otp_email);
                                if($otp_count!=0){
                                    $select_qurey=User::qurey("SELECT * FROM new_pass WHERE email='$email'");
                                    $select_new_pass_expiry=mysqli_num_rows($select_qurey);
                                    if($select_new_pass_expiry!==0){ 
                                        User::qurey("DELETE FROM forgot_authentication WHERE email='$email'");        
                                    }else{
                                    User::qurey("INSERT into new_pass (email) VALUES ('$email')");
                                    User::qurey("DELETE FROM forgot_authentication WHERE email='$email'"); 
                                    }
                                     $encode_mail=$_GET['keys'];
                                     header("location:../forgot-auth/?authkeys=$encode_mail");
                                }else{
                                     $check_no_of_time=User::qurey("SELECT * FROM forgot_authentication WHERE email='$email'");
                                    $row_check_no_of_time=mysqli_fetch_assoc($check_no_of_time);
                                    $value_no_time= $row_check_no_of_time['count'];
                                    $total=$value_no_time+1;
                                    User::qurey("UPDATE forgot_authentication set count=$total WHERE email='$email'");
                                    if($value_no_time<4){
                                        echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Otp is not valid,Five attempt only</h3></div><br></div>";
                                    }else if ($value_no_time>=4){
                                        User::qurey("DELETE FROM forgot_authentication WHERE email='$email'");
                                        $check_valid=POST::sel_table_by_title('forgot_authentication','email',$email);
                                        $valid_count=mysqli_num_rows($check_valid);
                                        if($valid_count==0){
                                            header('location:../');
                                        }
                                      }
                                }
                            }
                          }else{
                               header('location:../');
                          }
                       }
                       ?>
                    <div  class="container-login100-form-btn p-t-10">
                        <button id="click" class="login100-form-btn" name="setauth" value="submit" type="submit">
                            Verify
                        </button>
                    </div>
                        
                    
                    <div class="text-center w-full">
                    <br>
                        <a class="txt1" href="../spoof-account/">
                            Create new account
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                      
                </form>
                <?php }
                else if($_GET['authkeys']){
                ?>
                   <form class="login100-form validate-form" method="post">
                    <div class="login100-form-avatar">
                        <img src="images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <span class="login100-form-title p-t-20 p-b-45">
                       Enter a new Password
                    </span>
                    <br>
                    

                    <div class="wrap-input100 validate-input m-b-10" data-validate="password is required">
                        <input class="input100" type="password" name="pass" placeholder="Enter a new password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                        <i class="fas fa-at"></i>
                        </span>
                    </div>
                       <?php
                       include '../include/encodes_decodes.php';
                       if(isset($_POST['setauth'])){
                           $pass=$_POST['pass'];
                          $decode_main_encode=Enceodes::main_decode($_GET['authkeys']);
                          $decode_loop_encode=Enceodes::loop_decode($decode_main_encode);
                          $varify_newpass_email=User::qurey("SELECT * FROM new_pass WHERE email='$decode_loop_encode'");
                          $verify_count=mysqli_num_rows($varify_newpass_email);
                          $encode_pass=md5($pass);
                          if($verify_count!=0){
                              if(strlen($pass)>=8){
                             $Update_password=User::qurey("UPDATE users SET password='$encode_pass' WHERE email_id='$decode_loop_encode'");
                             User::qurey("DELETE FROM new_pass WHERE email='$decode_loop_encode'");
                              $user_detailse=User::select_user($decode_loop_encode);
                              $row=mysqli_fetch_assoc($user_detailse);
                              session_regenerate_id('TRUE');
                            $_SESSION['username'] = $row['email_id'];
                            $_SESSION['first_name'] = $row['first_name'];
                            $_SESSION['second_name'] = $row['second_name'];
                            $_SESSION['zdk'] =  $row['role'];
                            header('location:../');

                          }else{
                              echo "<div class='log_div'><div class='container'><h3 class='log_txt'>Password lenght Up to 8 characters </h3></div><br></div>";
                          }
                       }else{
                           header('location:../');
                       }
                    }
                       ?>
                    <div  class="container-login100-form-btn p-t-10">
                        <button id="click" class="login100-form-btn" name="setauth" value="submit" type="submit">
                            Submit
                        </button>
                    </div>
                        
                    
                    <div class="text-center w-full">
                    <br>
                        <a class="txt1" href="../spoof-account/">
                            Create new account
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                      
                </form>
                    <?php } ?>
            </div>
        </div>
    </div>



    <script src="https://kit.fontawesome.com/14dbca7644.js" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script>
   
</script>
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