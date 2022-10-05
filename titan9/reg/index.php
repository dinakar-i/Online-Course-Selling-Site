<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin register</title>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        Admin Sign Up
                    </span>
                </div>

                <form action="index.php" method="post" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">First name</span>
                        <input class="input100" type="text" name="firstname" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Second name</span>
                        <input class="input100" type="text" name="secondname" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Mopile number</span>
                        <input class="input100" type="text" name="mopile_number" placeholder="Mopile number">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Email id</span>
                        <input class="input100" type="text" name="email" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Conform Password</span>
                        <input class="input100" type="password" name="confirompass" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>
                    <?php
					include '../include/init.php';
					if (isset($_POST['login'])) {
						$first_name = $_POST['firstname'];
						$second_name = $_POST['secondname'];
						$mopile_number = $_POST['mopile_number'];
						$email = $_POST['email'];
						$pass = md5($_POST['pass']);
						$conform_pass = md5($_POST['confirompass']);
						$date = date('d-m-y');
						$role = 'Admin';
						$verify = "SELECT * FROM users WHERE email_id='$email'";
						$verify_result = POST::qurey($verify);
						$count = mysqli_num_rows($verify_result);
						if ($count == 0) {
							if ($pass == $conform_pass) {
								$result = "INSERT INTO users (first_name,second_name,phone_number,email_id,password,role,date) VALUES ('$first_name','$second_name','$mopile_number','$email','$pass','$role','$date')";
								$final = POST::qurey($result);
								if (!$final) {
									echo 'Qurey failed';
								}
							} else {
								echo "<h6 style='color:red;'>Password Dose't not match</h6>";
							}
						} else {
							echo "<h7 style='color:red';>This account has already existed!!</h7>";
						}
					}
					?>

                    <div class="container-login100-form-btn">
                        <input type="submit" name='login' value="Login" class="login100-form-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>