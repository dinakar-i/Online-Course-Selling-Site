<?php
session_start();
include '../include/init.php';
if (isset($_GET['q'])) {
    $post_id = $_GET['q'];
    $sql_id = mysqli_real_escape_string($conn, $post_id);
    $wel = base64_decode(urldecode($sql_id));
    $enc = $wel / 7094952419;
    $post = POST::sel_table_by_id('posts', 'post_id', $enc);
    $row = mysqli_fetch_assoc($post);
    $name = $_SESSION['first_name'];
    $email = $_SESSION['username'];
    $select_no = POST::sel_table_by_title('users', 'email_id', $email);
    $number_fetch = mysqli_fetch_assoc($select_no);
    $product_name = $row['post_title'];
    $product_price = $row['post_price'];
    include 'instamojo/Instamojo.php';
    
    $api = new Instamojo\Instamojo('bda46b9c126ba36ca323d4fb7a86a067', '7a8211aaf696fd9fa6453fbc604fb293', 'https://www.instamojo.com/api/1.1/');
    try {
        $response = $api->paymentRequestCreate(array(
            'purpose' => $product_name,
            'amount' => $product_price,
            'send_email' => true,
            'email' => $email,
            'buyer_name' => $_SESSION['first_name'] . ' ' . $_SESSION['second_name'],
            'allow_repeated_payments' => false,
            'redirect_url' => 'https://spoofcolors.com/payment/thankyou.php',
            'webhook'=>'https://spoofcolors.com/payment/hooks/',
            'allow_repeated_payments'=>'false'
            
            
        ));
        $pay_url = $response['longurl'];
        header("location:$pay_url");
    } catch (Exception $e) {
        print('Error: ' . $e->getMessage());
    }
} else {
    header('location:../');
}
