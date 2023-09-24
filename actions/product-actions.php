<?php
include "../classes/product.php";

$product = new Product;
if(isset($_POST['add'])){
  $product->store($_POST);
}elseif(isset($_POST['edit'])){
  $product->update($_POST);
}elseif(isset($_POST['btn_delete'])){
  $product->delete($_POST['id']);
}elseif(isset($_POST['pay'])){
  $product->buy($_POST, $_GET['product_id']);
}

?>