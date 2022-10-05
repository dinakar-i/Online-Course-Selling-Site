<?php
include 'init.php';
include 'chat.php';
?>
<!doctype html>
<html lang="en">

<head>
    <?php include 'include/font.php'; ?>
    <link href="https://fonts.googleapis.com/css2?family=Shojumaru&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Hacking tamil,developers,hacking videos,Ethical Hacking Course In Tamil,tamil hacking course,tamil course">
    <meta name="author" content="Dinakar">
    <meta name="description" content="SpooFcolors is an online education an learn programming an HACKING knowledge in tamil.Hacking tamil,developers,hacking videos,Ethical Hacking Course In Tamil,tamil hacking course,tamil course">
    <title>Home | SpooFcolors - Online Course</title>
    <link rel="icon" href="img/logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#">
                            <h1 style="font-family: 'Nosifer', cursive;font-size:20px;" class="head_title"><span style="color: blueviolet;">S</span><span style="color: lightseagreen;">p</span><span style="color: #09E0D6;">o</span><span style="color:#09E0D6;">o</span><span style="color:blue;">F</span><span style="color: red;">c</span><span style="color:#E602B4;">o</span><span style="color: #1DDE0B;">l</span><span style="color:#09E0D6;">o</span><span style="color:#D705F2;">r</span><span style="color:darkgreen">s</span>
                            </h1>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class='nav-item'>
                                    <a class='nav-link' href='./Login/'>Login</a>
                                </li>
                                <li class='nav-item'>
                                    <a class='nav-link' href='./spoof-account/'>SingUp</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categories
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                        include 'include/encodes_decodes.php';
                                        $cat_select = POST::select_all_table('categories');
                                        while ($row = mysqli_fetch_assoc($cat_select)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            $main_encode=Enceodes::main_encode($cat_title);
                                            $loop_encode=Enceodes::loop_encode($main_encode);
                                            $encrypt = urlencode(base64_encode($loop_encode));
                                            $cat_count = POST::sel_table_by_title('posts', 'post_cat', $cat_title);
                                            $cat_total_count = mysqli_num_rows($cat_count);
                                        ?>
                                            <a class="dropdown-item" href="../categories/?v=<?php echo "$encrypt"; ?>"><?php echo $cat_title . ' ';
                                                                                                                        echo "($cat_total_count)" ?></a>
                                        <?php } ?>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Conducte Us
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                        $set_conduct = POST::select_all_table('contuct');
                                        while ($row = mysqli_fetch_assoc($set_conduct)) {
                                            $path = $row['path'];
                                            $id = $row['id'];
                                            $title = $row['title'];
                                        ?>
                                            <a class="dropdown-item" target="_blank" href="<?php echo $path; ?>"><?php echo $title; ?></a>
                                        <?php } ?>
                                        <a class="dropdown-item" href="#">WhatsApp: 8270451822</a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>