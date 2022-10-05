<!doctype html>
<html lang="en">

<head>
    <link rel="icon" href="../img/logo.png">
    <title>Welcome | <?php
                    ob_start();
                    include '../include/init.php';
                    $post_id = $_GET['q'];
                    if ($post_id == '') {
                        header('location:../course.php');
                    }
                    $well = base64_decode(urldecode($post_id));
                    $sql_well = mysqli_real_escape_string($conn, $well);
                    $wel = intval($sql_well);
                    $enc = $wel / 7094952419;
                    $post = POST::sel_table_by_id('posts', 'post_id', $enc);
                    $poster_count = mysqli_num_rows($post);
                    if ($poster_count == 0) {
                        echo "404";
                    } else {
                        $row = mysqli_fetch_assoc($post);
                        $post_title = $row['post_title'];
                        $post_img = $row['post_img'];
                        echo $post_title;
                    } ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="vimeo.css">
    <!---font awsome cdn---->
    <link href="https://fonts.googleapis.com/css2?family=Niconne&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/14dbca7644.js" crossorigin="anonymous"></script>
    <!----goole fonts----->
    <?php
    include '../include/font.php';
    ?>
       <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="nav_bar">
        <div class="path_div"><a style="text-decoration: none;font-family: 'Merienda One', cursive;" href="/">Profile</a> / <a style="text-decoration: none;font-family: 'Merienda One', cursive;" href="../course/">Course</a></div>
    </div><br><br><br>
    <?php
    
    session_start();
    include '../include/chat.php';
    $post_id = $_GET['q'];
    if ($post_id == '') {
        header('location:../course/');
    }
    $well = base64_decode(urldecode($post_id));
    $sql_well = mysqli_real_escape_string($conn, $well);
    $wel = intval($sql_well);
    $enc = $wel / 7094952419;
    $post = POST::sel_table_by_id('posts', 'post_id', $enc);
    $total_count = mysqli_num_rows($post);
    if ($total_count == 0) {
        echo "<img class='error_img' src='../img/error.png'>";
    } else {
        $row = mysqli_fetch_assoc($post);
        $post_title = $row['post_title'];
        $post_img = $row['post_img'];
        $price = $row['post_price'];
    ?>
        <div class="container">
            <div class="div">
                <a href="#">
                    <div class="transbox"><i data-toggle="modal" style="font-weight: bold;" data-target="#exampleModalCenter" class="far fa-play-circle ico"></i></div>
                    <img class="img" data-toggle="modal" data-target="#exampleModalCenter" style="width:100%;height:100%;" src="../course/assets/<?php echo $post_img; ?>" alt="">
                </a>
            </div>
            <a style='text-decoration:none;' href="../videos/?q=<?php echo $post_id . '#'; ?>">
                <div class="bot_div">
                    <h4 class="h4">Watch all videos from <?php echo $post_title; ?></h4>
                </div>
            </a>
            <div class="qus_div"><br><br>
                <h3 class="qus" style="font-family: 'Niconne', cursive;font-size:30px;">Ask questions here 😊😊😊 :)</h3>
                <form method="post">
                    <i class="far fa-question-circle qus_ico"></i>
                    <input onfocus="this.placeholder = 'typing...'" placeholder="Ask here" onblur="this.placeholder = 'Ask here'" type="text" name="quse" class="qus_box">
                    <input type="submit" value="send" class="qus_btn" name="submit">
                </form><br><br>
            </div>
            <!---------qustion------------->
            <?php
            $name = $_SESSION['first_name'];
            $post_id = $_GET['q'];
            $well = base64_decode(urldecode($post_id));
            $wel = intval($well);
            $enc = $wel / 7094952419;
            if (isset($_POST['submit'])) {
                if ($_POST['quse'] !== '') {
                    $qus = base64_encode($_POST['quse']);
                    $qustion = htmlspecialchars($qus, ENT_QUOTES, 'UTF-8');
                    $insert = POST::insert_qustion($enc, $qustion, $name,$_SESSION['username']);
                    Post::insert_qus_notify($enc);
                    User::qurey("DELETE FROM qus_authendicate");
                    header('location:?q='.$post_id);
                }
            }
            ?>
            <!------------Bottom sbace here--------->
            <br>
            <!--------pop start here----------->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div style="background-color: black;" class="modal-content video_div">
                        <div class="video_bottom_div">
                            <?php echo "<h4 class='video_top_title_div'>$post_title<h4>" ?>
                        </div>
                        <?php
                        // echo $enc;
                        $select_vid = POST::select_intro($enc);
                        $code_count = mysqli_num_rows($select_vid);
                        if ($code_count == 0) {
                            echo "<img class='eroor' src='../img/error.png' alt='loaded'>";
                        } else {
                            $fetch = mysqli_fetch_assoc($select_vid);
                            $code = $fetch['embed_code'];
                            echo $code;
                        }
                        ?>
                        <div class="video_top_div">
                            <a href="#">
                                <div class="first_circle">
                                    <i class="fas fa-thumbs-up glow"></i>
                                </div>
                            </a>

                            <a href="#">
                                <div class="first_circle">
                                    <i class="fab fa-instagram glow"></i>
                                </div>
                            </a>
                            <a href="#" data-dismiss="modal">
                                <div class=" first_circle">
                                    <i style="margin-left: 11px;" class="far fa-times-circle glow"></i>
                                </div>
                            </a>
                            <a href="#">
                                <div class="first_circle">
                                    <i class="fab fa-twitter glow"></i>
                                </div>
                            </a>
                            <a href="#">
                                <div class="first_circle">
                                    <i class="fab fa-facebook-square glow"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-------------------pop ends here----------------------->
            <!----------------------->
            <br>
            <?php
            $qus_selection = POST::sel_table_by_id('question', 'qus_post_id', $enc);
            $qus_count = mysqli_num_rows($qus_selection);
            if ($qus_count > 0) {
            ?>
                <div class="list_qustions">
                    <h4 class="qus_head">Questions/-</h4><br>
                    <ul>
                        <?php
                        ##arrays to store values---------------------------->
                        $qus_array=[];
                        $link_array=[];
                        $replay_count_array=[];
                        $author_array=[];
                        ## arrays to reverse ararys value-------------------------->
                    

                        $select_qus = POST::sel_table_by_id('question', 'qus_post_id', $enc);
                        $qus_count = mysqli_num_rows($select_qus);
                        while ($row=mysqli_fetch_array($select_qus)){
                            $qustion = base64_decode($row['question']);
                            array_push($qus_array,$qustion);
                            $author = $row['author'];
                            array_push($author_array,$author);
                            $qus_id = $row['qus_id'];
                            $select_reb = POST::sel_table_by_id('replay', 're_post_id', $qus_id);
                            $replay_count = mysqli_num_rows($select_reb);
                           array_push($replay_count_array,$replay_count);
                            $goo = $qus_id * 7094;
                            $link = 'replay.php?g=' . urlencode(base64_encode($goo));
                            array_push($link_array,$link); 
                        }
                        $i=sizeof($qus_array)-1;
                        foreach($qus_array as $re_qustions){
                           
                            
                            ?>
                            <li>
                            <div>
                                <h1 class="qus_list"> <?php echo htmlspecialchars($author_array[$i]) ?>:
                                    <a style="text-decoration:none; color:black;" href="<?php echo htmlspecialchars($link_array[$i]); ?>"><?php echo htmlspecialchars($qus_array[$i], ENT_QUOTES, 'UTF-8') . ' ' . "<span style='color:lightgray;font-size:20px'><span style='font-size:25px'>(</span> <span style='color:red;'> $replay_count_array[$i]</span> <span style='font-size:25px'>)</span></span>" ?></a>
                                </h1>
                            </div>
                        </li>
                        <?php
                        
                        $i=$i-1;
                        }
                        ?>

                    </ul>
                    <br>
                </div>
                <br>
            <?php }
            if ($qus_count > 3) {
                echo "
 <button style='background-color: #309F8E;border-color:#309F8E;' onclick='read_more()'type='button' class='btn btn-primary btn_text'>Read more</button>
 <br><br>";
            }

            ?>
            <script>
                function read_more() {
                    let list_qustions = document.querySelector('.list_qustions');
                    let btn_text = document.querySelector('.btn_text');
                    let var2 = btn_text.innerHTML
                    
                    if (var2 === 'Read more') {
                        list_qustions.style.height = 'auto';
                        btn_text.innerHTML = 'Read less';
                    } else {
                        list_qustions.style.height= '250px';
                        btn_text.innerHTML = 'Read more';
                    }
                }
            </script>
            <!-----payments cherak------>
            <?php
            if ($_SESSION['zdk'] !== 'Gold') {
                if ($price == 0) {
                    if ($_SESSION['zdk'] == '') {
                        header('location:../Login/');
                    }
                } else {
                    if ($_SESSION['zdk'] == '') {
                        header('location:../Login/');
                    } else {
                        $email = $_SESSION['username'];
                        $select_payment = POST::check_payment($post_title, $email);
                        $payments_true = mysqli_num_rows($select_payment);
                        if ($payments_true == 0) {
                            $ide = $post_id;
                            header("location:../payment/pay.php?q=$post_id");
                        }
                    }
                }
            }
            ?>
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
            </script>
</body>

</html>
<?php } ?>