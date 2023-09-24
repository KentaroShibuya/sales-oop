<?php

require_once "database.php";

class User extends Database {

  //register data
  public function store($request){   //registerのstore($_POST)を$requestに置き換え formデータはregisterに送られているので$_POSTで収集はできない
    $first_name = $request['first_name'];
    $last_name = $request['last_name'];
    $username = $request['username'];
    $password = $request['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO Users (`first_name`,`last_name`,`username`,`password`) VALUES ('$first_name','$last_name','$username','$password')";

    if($this->conn->query($sql)){
      header('location:../views/');  
      exit;
    }else{
      die('Error creating the user: '. $this->conn->error);
    }
  }

  //login
  public function login($request) {
    $username = $request['username'];
    $password = $request['password'];

    $sql = "SELECT * FROM Users WHERE username = '$username'";
    $result = $this->conn->query($sql);

    if($result->num_rows == 1) {   
      $user = $result->fetch_assoc();
      // var_dump($user);
      // exit;
      if(password_verify($password,$user['password'])){
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['first_name']." ". $user['last_name'];

        header('location: ../views/dashboard.php');  // redirected to dashboard.php
        exit;
      }else{
        die('Password is incorrect');
      }
    }else{
      die('Username not found');
    }
  }
  
  // input product
  public function products($request){   //registerのstore($_POST)を$requestに置き換え formデータはregisterに送られているので$_POSTで収集はできない
    $product_name = $request['productname'];
    $price = $request['price'];
    $qty = $request['qty'];

    $sql = "INSERT INTO Products (`product_name`,`price`,`quantity`) VALUES ('$product_name','$price','$qty')";

    if($this->conn->query($sql)){
      header('location:../views/dashboard.php');  
      exit;
    }else{
      die('Error creating the product: '. $this->conn->error);
    }
  }

}