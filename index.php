<?php
session_start();
ob_start();
include 'include/chat.php';
if (isset($_SESSION['zdk'])) { 
    if ($_SESSION['zdk'] !== '') {
        include './include/log_header.php';
        $home_result = Post::select_all_table('home');
        $row = mysqli_fetch_assoc($home_result);
        $refer = $row['refer'];
        $header = $row['header'];
        $footer = $row['footer'];
?>
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-xl-6">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                                <h5><?php echo $refer; ?></h5>
                                <h1><?php echo $header; ?></h1>
                                <p><?php echo $footer; ?></p>
                                <a href="./course/" style="font-size: 15px;font-weight:500;" class="btn_1">Available Courses </a>
                                <a href="Buy/" class="btn_2">Buyed courses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- jquery plugins here-->
        <!-- jquery -->
        <script src="js/jquery-1.12.1.min.js"></script>
        <!-- popper js -->
        <script src="js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- easing js -->
        <script src="js/jquery.magnific-popup.js"></script>
        <!-- swiper js -->
        <script src="js/swiper.min.js"></script>
        <!-- swiper js -->
        <script src="js/masonry.pkgd.js"></script>
        <!-- particles js -->
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <!-- swiper js -->
        <script src="js/slick.min.js"></script>
        <script src="js/jquery.counterup.min.js"></script>
        <script src="js/waypoints.min.js"></script>
        <!-- custom js -->
        <script src="js/custom.js"></script>
        </body>

        </html>
    <?php }
}

if (!isset($_SESSION['zdk'])) {
    include './include/header.php';
    $home_result = Post::select_all_table('home');
    $row = mysqli_fetch_assoc($home_result);
    $refer = $row['refer'];
    $header = $row['header'];
    $footer = $row['footer'];
    User::cookie_log();
    ?>
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5><?php echo $refer; ?></h5>
                            <h1><?php echo $header; ?></h1>
                            <p><?php echo $footer; ?></p>
                            <a href="./course/" class="btn_2">View Courses</a>
                            <a href="Login/" class="btn_1">Login/SignUp?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jquery-->

    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- swiper js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
    </body>

    </html>
<?php } ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="./js/script.js"></script>
