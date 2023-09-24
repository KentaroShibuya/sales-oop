<?php

require_once "database.php";

class Product extends Database {
 
  public function store($request){
    $product_name = $request['productname'];
    $price = $request['price'];
    $quantity = $request['qty'];

    $sql = "INSERT INTO Products (`product_name`,`price`,`quantity`) VALUES ('$product_name','$price','$quantity')";

    if($this->conn->query($sql)){
      header('location:../views/dashboard.php');  
      exit;
    }else{
      die('Error creating the product: '. $this->conn->error);
    }
  }

  public function getproducts(){
    $sql ="SELECT id, product_name, price, quantity FROM Products";

    if($result = $this->conn->query($sql)){
      return $result;
    }else{
      die("Retrieving Error: ". $this->conn->error);
    }
  }

  public function getProduct($id){
    $sql ="SELECT * FROM Products WHERE id = $id";

    if($result = $this->conn->query($sql)){
      return $result->fetch_assoc();
    }else{
      die("Retrieving Error: ". $this->conn->error);
    }
  }

  public function update($request){
    $sql = "UPDATE Products SET product_name = '".$request['product_name']."', price = ".$request['price'].", quantity = ".$request['qty']." WHERE id = ".$request['id'];
    // echo "$sql"; エラー時にデータ取れてるか確認する方法

    if($this->conn->query($sql)){
      header('location: ../views/dashboard.php');
      exit;
    }else{
      die('Updating Error'.$this->conn->error);
    }
  }

  public function delete($id){
    $sql = "DELETE FROM Products WHERE id = $id";

    if($this->conn->query($sql)){
     header('location: ../views/dashboard.php');
    }else{
      die('Error deleting your account:'. $this->conn->error);
    }
  }
  
 
  public function buy($request, $product_id){
    $price = $request['price'];
    $qty = $request['quantity'];

    $sql = "UPDATE Products SET quantity = quantity - '$qty' WHERE id = '$product_id' ";

    if($this->conn->query($sql)){
      // echo "$sql";
      header('location:../views/dashboard.php');
      exit;
    }else{
      die('Error Updating number of stock'. $this->conn->error);
    }



    // if(isset($_POST['pay'])){
    //   $product_id = $_GET['product_id'];
    //   buyqty = $_POST['quantity']
    // }
  }
  
}

?>