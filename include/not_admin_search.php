<?php
if ($_SESSION['zdk'] !== 'Admin') {
    $search = $_POST['search'];
    $email = $_SESSION['username'];
    $select_post = POST::pro_search('payments', 'post_title', $search, $email);

    $result_counts = mysqli_num_rows($select_post);
    if ($result_counts == 0) {
        echo "<h5 class='sean' style='margin-left:400px;margin-top:20px;font-family: 'Russo One', sans-serif; margin-left:30px;'> No need a search items!!...</h5>";
    }
    if ($search == '') {
        header('location:course.php');
    }
    while ($row = mysqli_fetch_assoc($select_post)) {
        $post_title = $row['post_title'];
        $post_date = $row['date'];
        $content = $row['content'];
        $img = $row['post_img'];
        $post_id = $row['payment_post_id'];
        $url = $post_id;
        $enc = (($url * 1236756498435 * 1236756498435) / 1239867);
        $link = '../blog\buy.php?q=' . urlencode(base64_encode($enc));
?>
<div class="col-lg-4 col-md-6">
    <a href="<?php echo $link; ?>">
        <div class="single_place">
            <div class="thumb">
                <img src="../course/assets/<?php echo $img; ?>" alt="">
                <a href="#" class="prise">Welcome</a>
            </div>
            <div class="place_info">

                <h3 style="font-family: 'Bebas Neue', cursive;"><?php echo $post_title; ?></h3>

                <p><?php echo $content; ?></p>
                <div class="rating_days d-flex justify-content-between">
                    <div class="days">
                        <i class="fa fa-clock-o"></i>
                        <a href="#"><?php echo $post_date; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
<?php }
} ?>