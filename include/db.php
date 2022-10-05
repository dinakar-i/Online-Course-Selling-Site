<?php
class Database
{
    public $conn;
    public function __construct()
    {
        $this->connect_db();
    }
    public function connect_db()
    {
        // $this->conn=mysqli_connect('localhost','root','','gallary');
        $this->conn = new mysqli('localhost', 'root', '', 'color');;
        if ($this->conn->errno) {
            echo 'not connect to db' . $this->conn->errno;
        }
    }
    public function query($query)
    {
        $this->result = $this->conn->query($query);
        $this->conform();
        return $this->result;
    }
    public function conform()
    {
        if (!$this->result) {
            echo 'not connect';
        }
    }
}
$db_base = new Database;
