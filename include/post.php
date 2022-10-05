<?php
class Post
{
   
    public static function strigToBinary($string)
    {
        $characters = str_split($string);

        $binary = [];
        foreach ($characters as $character) {
            $data = unpack('H*', $character);
            $binary[] = base_convert($data[1], 16, 2);
        }

        return implode(' ', $binary);
    }



    public static function binaryToString($binary)
    {
        $binaries = explode(' ', $binary);

        $string = null;
        foreach ($binaries as $binary) {
            $string .= pack('H*', dechex(bindec($binary)));
        }

        return $string;
    }







    public static function insert_replay($re_post_id, $reblay, $author)
    {
        return self::qurey("INSERT INTO replay (re_post_id,replay,author) VALUES ($re_post_id,'$reblay','$author')");
    }
    public static function insert_qustion($post_id, $qustion, $author,$email)
    {
        return self::qurey("INSERT INTO question (qus_post_id,question,author,email) VALUES($post_id,'$qustion','$author','$email')");
    }
    public static function insert_qus_notify($post_id)
    {
            return self::qurey("INSERT INTO qus_notify (qus_post_id) VALUE ($post_id)");
    }
    public static function select_all_table($table)
    {
        return self::qurey("SELECT * FROM $table");
    }
    public static function insert_posts($value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9)
    {
        return self::qurey("INSERT INTO posts ('post_title', 'post_price', 'status', 'Recurments', 'post_content', 'post_cat', 'post_author', 'post_date', 'post_img') VALUES($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9)");
    }
    public static function insert_header($det, $ref)
    {
        return self::qurey("UPDATE home SET header='$det' WHERE refer='$ref'");
    }
    public static function insert_categories($value)
    {
        return self::qurey("INSERT INTO categories (cat_title) VALUE ('$value')");
    }
    public static function insert_reviews($review, $review_post_id, $date, $author)
    {
        return self::qurey("INSERT INTO reviews(reviews,review_post_id,date,author)VALUES('$review',$review_post_id,'$date','$author')");
    }
    public static function forgot($table, $row, $set_row, $sec_table, $re_table)
    {
        return self::qurey("SELECT * FROM $table WHERE $row='$set_row' AND $sec_table='$re_table'");
    }
    public static function sel_table_by_id($table, $row, $id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row=$id");
    }
    public static function sel_table_by_id_approve($table, $row, $id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row=$id AND status='Approve'");
    }
    public static function select_table_post_cat_method($table, $row, $id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row='$id'");
    }
    public static function sel_table_by_title($table, $row, $id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row='$id'");
    }
    public static function insert_payment($payment_post_id, $post_title, $price, $email_id, $full_name, $post_img, $content, $date)
    {
        return self::qurey("INSERT INTO payments(payment_post_id,post_title,price,email_id,full_name,post_img,content,date) VALUES ($payment_post_id,'$post_title',$price,'$email_id','$full_name','$post_img','$content','$date')");
    }
    public  static function sel_table_by_approve($table)
    {
        return self::qurey("SELECT * FROM $table WHERE status='publish'");
    }
    public static function delete($table, $point, $del)
    {
        return self::qurey("DELETE FROM $table WHERE $point=$del");
    }
    public static function check_payment($post_title, $email_id)
    {
        return self::qurey("SELECT * FROM payments WHERE post_title='$post_title' AND email_id='$email_id'");
    }
    public static function search_fun($table, $room, $search)
    {
        return self::qurey("SELECT * FROM $table WHERE $room LIKE '%$search%' AND status='publish' ");
    }
    public static function select_intro($enc)
    {
        return self::qurey("SELECT * FROM embed WHERE embed_post_id=$enc AND embed_title='Introduction'");
    }
    public static function pro_search($table, $room, $search, $email)
    {
        return self::qurey("SELECT * FROM $table WHERE $room LIKE '%$search%' AND email_id='$email'");
    }
    public static function Update($table, $row_table, $value, $colum, $colum_value)
    {
        return self::qurey("UPDATE $table SET $row_table='$value' WHERE $colum='$colum_value'");
    }
    public static function edit_cat($value, $cat_id)
    {
        return self::qurey("UPDATE categories SET cat_title='$value' WHERE cat_id=$cat_id");
    }
    public static function sel_buy_course($email_id)
    {
        return self::qurey("SELECT * FROM payments WHERE email_id='$email_id'");
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
    public static function auto($row)
    {
        $post = new self;
        foreach ($row as $name => $value) {
            $post->$name = $value;
        }
        return $post;
    }
}
