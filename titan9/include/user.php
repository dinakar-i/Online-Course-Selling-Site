<?php 
class User{
public static function delete_user($id){
    return self::qurey("DELETE FROM users WHERE user_id=$id");
}
public static function update_role($value,$id){
    return self::qurey("UPDATE users SET role='$value' WHERE user_id=$id");
}
public static function select_user($email){
    return self::qurey("SELECT * FROM users WHERE email_id= '$email'");
}
public static function register($first_name,$second_name,$email,$pass,$role,$date){
    return self::qurey("INSERT INTO users (first_name,second_name,email_id,password,role,date) VALUES ('$first_name','$second_name','$email','$pass','$role','$date')");
}
public static function login($email,$pass){
    return self::qurey("SELECT * FROM users WHERE email_id='$email' AND password='$pass'");
}
public static function Insert($table,$columns,$values){
    $excute="INSERT INTO $table ($columns) VALUES ($values)";
    echo $excute;
    return self::qurey($excute);
}
public static function qurey($sql){
        global $db_base;
        $result=$db_base->query($sql);
        // $array=[];  
        // while($row=mysqli_fetch_assoc($result)){
        //     $array[]=self::auto($row);
        // }
       return $result;
    }
}
?>