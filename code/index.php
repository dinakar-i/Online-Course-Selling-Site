<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add On</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="myscript/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-----google fonts----------------------->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
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
    <style>
        /* .copy_btn {
        background-color: silver;
        position: absolute;
    } */
    </style>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-50 p-b-90">
                <form method="POST" class="login100-form validate-form flex-sb flex-w">
                    <span class="login100-form-title p-b-51">
                        ADD ONS
                    </span>


                    <div class="wrap-input100 validate-input m-b-16" data-validate="keys is required">
                        <input class="input100" type="text" name="keys" spellcheck="false" placeholder="Enter a Key">
                        <span class="focus-input100"></span>

                    </div>
                    <?php
                    session_start();
                    if ($_SESSION['zdk'] == '') {
                        header("location:../");
                    }
                    include '../include/init.php';
                    if (isset($_POST['submit'])) {
                        $get = $_POST['keys'];
                        $var1 = mysqli_real_escape_string($conn, $get);
                        $add_qurey = POST::sel_table_by_title('props', 'title', $var1);
                        $count_vars = mysqli_num_rows($add_qurey);
                        if ($count_vars == 1) {
                            $fetch = mysqli_fetch_assoc($add_qurey);
                            $vars = $fetch['vars'];
                            echo "<input class='input100' style='background-color:#E6E6E6;' value='$vars' type='text' spellcheck='false'>";
                            unset($_POST['submit']);
                        } else {
                            echo "<div class='add_div'><br><h4 class='off_value'>Not valide in this key</h4><br></div>";
                        }
                    }
                    ?>
                    <div class="container-login100-form-btn m-t-17">
                        <button type="submit" name="submit" class="login100-form-btn">
                            Verify
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>
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
    <script>

</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>

</html>