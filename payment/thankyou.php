<?php
  session_start();
  include 'instamojo/Instamojo.php';
  
  $pay_id = $_GET['payment_request_id'];
  if($pay_id==''){
    header('location:../');
  }
 $api = new Instamojo\Instamojo('bda46b9c126ba36ca323d4fb7a86a067', '7a8211aaf696fd9fa6453fbc604fb293', 'https://www.instamojo.com/api/1.1/');
  try {
      include '../include/init.php';
    $response = $api->paymentRequestStatus($pay_id);
    $purpose= $response['purpose'];
    $amount= $response['amount'];
    $email= $response['email'];
    $name= $response['buyer_name'];
    $status= $_GET['payment_status'];
 if($status!='Failed'){
    $select_all_post_detail=Post::sel_table_by_title('posts','post_title',$response['purpose']);
    $row=mysqli_fetch_assoc($select_all_post_detail);
    $post_id=$row['post_id'];
    $post_img=$row['post_img'];
    $post_content=$row['post_content'];
    $date=date('d-m-y');
    $valid_qurey=Post::qurey("SELECT * FROM payments WHERE post_title='$purpose' AND email_id='$email'");
    $expirey_count=mysqli_num_rows($valid_qurey);
    if($expirey_count==0){
      Post::qurey("INSERT INTO payments (payment_post_id,post_title,price,email_id,full_name,post_img,content,date) VALUES ($post_id,'$purpose','$amount','$email','$name','$post_img','$post_content','$date')");
       header('location:../Buy/');
    }else{
       header('location:../Buy/');
    }
}else{
    header('location:../');
}
  } catch (Exception $e) {
    print('Error:' . $e->getMessage());
  }
  ?>
   