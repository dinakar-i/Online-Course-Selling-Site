<?php

include '../include/init.php';
POST::qurey("INSERT INTO payments(payment_post_id,post_title,price,email_id,full_name,post_img,content,date) VALUES (1,'hacking','999','king007@gmail.com','Dinakar','4.jpg','welcome','21-03-2002')");
/*
Basic PHP script to handle Instamojo RAP webhook.
*/

$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if ($major >= 5 and $minor >= 4) {
    ksort($data, SORT_STRING | SORT_FLAG_CASE);
} else {
    uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without <>
$mac_calculated = hash_hmac("sha1", implode("|", $data), "3f491a1145f64e35bde203e785b115ef");
if ($mac_provided == $mac_calculated) {
    if ($data['status'] == "Credit") {
        $amount = $data['amount'];
        $email = $data['buyer'];
        $name = $data['buyer_name'];
        $purpose = $data['purpose'];
        $select_post = POST::sel_table_by_title('posts', 'post_title', $purpose);
        $row = mysqli_fetch_assoc($select_post);
        $img = $row['post_img'];
        $post_id = $row['post_id'];
        $content = $row['post_content'];
        $date = date('d-m-y');
      POST::qurey("INSERT INTO payments(payment_post_id,post_title,price,email_id,full_name,post_img,content,date) VALUES (1,'hacking',999,'king007@gmail.com','Dinakar','4.jpg','welcome','21-03-2002')");
    } else {
        
    }
} else {
    echo "MAC mismatch";
}