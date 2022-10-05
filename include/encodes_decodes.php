<?php

class Enceodes{
    public static function main_encode($email){
        $email_encoded = rtrim(strtr(base64_encode($email), '+/', '-_'), '=');
        return $email_encoded;
    }
    public static function main_decode($email){
        $email_decoded = base64_decode(strtr($email, '-_', '+/'));
        return $email_decoded;
    }
    public static function loop_encode($email){
        $output='';
        for($i=0;$i<strlen($email);$i++){
        $output .='^'.$email[$i].'$';
        }
         return $output;
    }

    public static function loop_decode($email)
    {
        $output='';
        for($i=0;$i<strlen($email);$i++){
        if($email[$i]=='$' || $email[$i]=='^'){
        }else{
            $output .=$email[$i];
        }
        }
         return $output;
    }
    public static function two_encode($value){
        $data=self::main_encode($value);
        return self::loop_encode($data);
    }
    public static function two_decode($value){
        $data=self::loop_decode($value);
        return self::main_decode($data);
    }

  
    }
 
