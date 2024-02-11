<?php
class Database{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $conn;

    public function __construct() {
        $this->db_connect();

    }
    public function db_query($sql){
        $query=$this->conn->query($sql);
        return $query;
    }
    public function db_close(){
//        $this->conn->close();
        mysqli_close($this->conn);
    }
    private function db_connect(){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->db = 'test';
//      $this->host = 'localhost:3300';
//      $this->user = 'root';
//      $this->pass = '952001';
//      $this->db = 'test';
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
//        echo "secca";
        return $this->conn;
    }

    public function db_num($sql){
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
}
//$db=new Database();
?>