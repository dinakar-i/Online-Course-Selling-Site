<?php
include 'mail.php';
class User
{
    public static  function cookie_log(){
       if(isset($_COOKIE['_AUTH']) && isset($_COOKIE['_COD'])){
           $email= $_COOKIE["_COD"];
           $password=$_COOKIE['_AUTH'];
           $decode_email=Enceodes::two_decode($email);
           $decode_password=Enceodes::two_decode($password);
           $login_result=self::login($decode_email,$decode_password);
           $email_count = mysqli_num_rows($login_result);
           $valid_user=self::valid_user($decode_email);
           $valid_user_count= mysqli_num_rows($valid_user);
           if($email_count!=0 && $valid_user_count!=0){
                 $row=mysqli_fetch_assoc($login_result);
                 $_SESSION['username'] = $row['email_id'];
                 $_SESSION['first_name'] = $row['first_name'];
                 $_SESSION['zdk'] =  $row['role'];
                 header("location:#");
           }
       }
    }
    public static function Set_cookie($email,$pass){
        $encrypt_email= Enceodes::two_encode($email);
        $encrypt_password= Enceodes::two_encode($pass);
        setcookie("_COD","$encrypt_email",time() + (1728000 * 30), "/");
        setcookie("_AUTH","$encrypt_password",time() + (1728000 * 30), "/");
    }
    public static function delete_user($id)
    {
        return self::qurey("DELETE FROM users WHERE user_id=$id");
    }

    public static function update_role($value, $id)
    {
        return self::qurey("UPDATE users SET role='$value' WHERE user_id=$id");
    }
    public static function select_user($email)
    {
        return self::qurey("SELECT * FROM users WHERE email_id= '$email'");
    }
    public static function register($first_name, $email, $pass, $role, $date)
    {
        return self::qurey("INSERT INTO users (first_name,email_id,password,activate,role,date) VALUES ('$first_name','$email','$pass',1,'$role','$date')");
       
    }
    public static function login($email, $pass)
    {
        return self::qurey("SELECT * FROM users WHERE email_id='$email' AND password='$pass'");
    }
    public static function Insert($table,$columns,$values){
        $excute="INSERT INTO $table ($columns) VALUES ($values)";
        return self::qurey($excute);
    }
    public static function valid_user($email)
    {
        return self::qurey("SELECT * FROM users WHERE email_id='$email' AND activate=0");
    }
    public static function Qustion_replay($qustion_id,$email,$name,$answer){
             $sql=self::qurey("SELECT * FROM question WHERE qus_id=$qustion_id");
             $row=mysqli_fetch_assoc($sql);
             $email_data=$row['email'];
             Mail::send_mail($email_data,$email,$name.'<br>'.$answer);
     
    }
    public static function qurey($sql)
    {
        global $db_base;
        $result = $db_base->query($sql);
        // $array=[];  
        // while($row=mysqli_fetch_assoc($result)){
        //     $array[]=self::auto($row);
        // }
        return $result;
    }
}
