<div class="about_course">

    <label class="about_nav">
        <h3 class="about_title">About course banner <spam style="color: greenyellow;"><i class="fas fa-inbox"></i></spam> :</h3>
    </label>
    <ul>
        <?php
        $slect_condent = POST::sel_table_by_id('posts', 'post_id', $enc);
        $fetch_con = mysqli_fetch_assoc($slect_condent);
        $price = $fetch_con['post_price'];
        $author = $fetch_con['post_author'];
        $duration = $fetch_con['duration'];
        $student = POST::sel_table_by_id('payments', 'payment_post_id', $enc);
        $student_count = mysqli_num_rows($student);
        ?>
        <!-- <a style="text-decoration: none" href="#"> -->
            <li class="about_li"><i class="fas fa-file-invoice-dollar"></i> course price just
                <?php echo $price; ?>/- Rubees
                only!!</li>

            <hr class=" about_line">
            <li class="about_li"><i class="fas fa-stopwatch"></i> Time duration <?php echo $duration; ?>
                hourse</li>
            <hr class=" about_line">
            <li class="about_li"><i class="fas fa-user-graduate"></i> <?php echo $student_count; ?></li>
            <hr class="about_li">
            <li class="about_li"><i class="fas fa-chalkboard-teacher"></i> Instructor (
                <?php echo $author; ?> )</li>
            <hr class="about_li">
            <li class="about_li"><i class="fas fa-procedures"></i> Life time access!!</li>
            <hr class="about_li">
            <li class="about_li"><i class="fas fa-laptop-medical"></i>You can access Mobile,Laptop an TV
            </li>
            <hr class="about_li">
        <!-- </a> -->
        <br>
    </ul class=" about_line">

</div>