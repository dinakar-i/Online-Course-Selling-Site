<?php
ob_start();
session_start();
function disable_session(){
    if (isset($_SESSION['zdk'])) {
        unset($_SESSION['zdk']);
        header('location:../destroyed_cookies.php');
    }else{
        header('location:../');
    }
}
disable_session();