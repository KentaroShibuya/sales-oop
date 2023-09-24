<?php
class Database{    //function connectionと同じ役割  MY SQLとPHPを繋ぐ
  private $server_name = "localhost";
  private $username = "root";
  private $password = "root";
  private $db_name = "sales_oop";
  protected $conn;
  
  public function __construct(){   //constructの中にPropertyがないのは上で指定されているから 中身をautoでimplement
    $this -> conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name); //PHPからdatabaseを操作するため
    if($this->conn->connect_error){
    die("Unable to connect to the database". $this->conn->error);
    }
  }
  



}

?>