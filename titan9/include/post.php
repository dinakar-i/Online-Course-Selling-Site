<?php
class Post
{
    public static function course()
    {
        return self::qurey("SELECT * FROM posts AND status='publish'");
    }
    public static function select_all_table($table)
    {
        return self::qurey("SELECT * FROM $table");
    }
    public static function insert_con($title, $path)
    {
        return self::qurey("INSERT INTO contuct(title,path) VALUES ('$title','$path')");
    }
    public static function insert_add_ons($keys, $values)
    {
        return self::qurey("INSERT INTO props(title,vars) VALUES ('$keys','$values')");
    }
    public static function insert_certificate($keys, $values)
    {
        return self::qurey("INSERT INTO certificate(post_id,title) VALUES ($keys,'$values')");
    }
    public static function sel_table_by_id($table, $row, $id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row=$id");
    }
    public static function insert_posts($value1, $value2, $value3, $value4, $value5, $value6, $value7, $value8, $value9)
    {
        return self::qurey("INSERT INTO posts ('post_title', 'post_price', 'status', 'Recurments', 'post_content', 'post_cat', 'post_author', 'post_date', 'post_img') VALUES($value1,$value2,$value3,$value4,$value5,$value6,$value7,$value8,$value9)");
    }
    public static function insert_header($row, $det, $ref)
    {
        return self::qurey("UPDATE home SET $row='$det' WHERE refer='$ref'");
    }
    public static function insert_feed($row, $det, $ref)
    {
        return self::qurey("UPDATE feed SET $row='$det' WHERE id='$ref'");
    }
    public static function insert_no_of_page($row, $det, $ref)
    {
        return self::qurey("UPDATE page SET $row='$det' WHERE id='$ref'");
    }
    public static function insert_categories($value)
    {
        return self::qurey("INSERT INTO categories (cat_title) VALUE ('$value')");
    }
    
    public static function search_fun($table, $room, $search)
    {
        return self::qurey("SELECT * FROM $table WHERE $room LIKE '%$search%' ");
    }
    public static function insert_tags($value, $post_id)
    {
        return self::qurey("INSERT INTO tags (taga_title,tags_post_id) VALUES ('$value',$post_id)");
    }
    public static function sel_post_id($id)
    {
        return self::qurey("SELECT * FROM posts WHERE post_id=$id");
    }
    public static function sel_ta_id($table,$row,$id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row=$id");
    }
    public static function delete($table, $point, $del)
    {
        return self::qurey("DELETE FROM $table WHERE $point=$del");
    }
    public static function insert_reviews($review, $review_post_id, $date, $author)
    {
        return self::qurey("INSERT INTO reviews(reviews,review_post_id,date,author)VALUES('$review',$review_post_id,'$date','$author')");
    }
    public static function edit_cat($value, $cat_id)
    {
        return self::qurey("UPDATE categories SET cat_title='$value' WHERE cat_id=$cat_id");
    }
    public static function update_code($title,$code ,$code_id)
    {
        return self::qurey("UPDATE embed SET embed_title='$title' , embed_code='$code' WHERE embed_id=$code_id");
    }
    public static function sel_table_by_title($table, $row, $id)
    {
        return self::qurey("SELECT * FROM $table WHERE $row='$id'");
    }
    public static function update_status($status, $post_id)
    {
        return self::qurey("UPDATE posts SET status='$status' WHERE post_id=$post_id");
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
