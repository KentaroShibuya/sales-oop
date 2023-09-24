<?php

session_start();
require '../classes/product.php';

$product = new Product;
$all_products = $product->getproducts();
// var_dump($_SESSION);

// print_r($all_users);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dashboard</title>
</head>
<body>
  <!-- この部分の書き方はnavbarでいいのか？？ -->
    <nav class="navbar navbar-expand navbar-light " style="margin-bottom: 80px;">
        <div class="container-fluid">
          <div class="col">
            <a href="registration" class="navbar-brand">
              <i class="fa-solid fa-house fs-2"></i>
            </a>
          </div>
          <div class="col">
            <div class="navbar-nav">
              <span class="navbar-text mx-auto fs-4 fw-bold ">Welcome, <?= $_SESSION['full_name'] ?></span> 
              <!-- first nameだけにするには？ -->
            </div>
          </div> 
          <div class="col">
            <div class="navbar-nav">
              <i class="fa-solid fa-user-xmark fs-2 ms-auto text-danger"></i>
            </div>
          </div>
        </div>
    </nav>

    <main class="row justify-content-center gx-0">
        <div class="col-8">
          <span class="text-left h2">Product List</span>
            <!-- Add product modal button -->
            <i class="fa-solid fa-plus h2 text-info float-end" data-bs-toggle="modal" data-bs-target="#add_product" style="cursor:pointer;"></i>
             <!-- ??? data-bs-toggle   data-bs-target  ??? -->
          
          <!-- Table -->
          <table class="table table-hover table-striped">
            <thead>
                <tr class="table-dark">
                    <th style="width: 10%">ID</th>
                    <th style="width: 25%">Product name</th>
                    <th style="width: 15%">Price</th>
                    <th style="width: 15%">Quantity</th>
                    <th ></th>
                </tr>
            </thead>
            <tbody>
              <?php
              // product.phpのgetallproductsが上でvariableに
              while($products = $all_products->fetch_assoc()){
              ?>
              <tr>
                <td> <?= $products['id'] ?> </td>
                <td> <?= $products['product_name'] ?> </td>
                <td> <?= $products['price'] ?> </td>
                <td> <?= $products['quantity'] ?> </td>

                <td>
                  <!-- edit icon -->
                  <a href="edit-product.php?product_id=<?=$products["id"]?>" class="btn btn-outline-warning" title="Edit">
                  <i class="fa-regular fa-pen-to-square"> </i>
                  </a>
                  <!-- delete icon -->
                  <div class="btn btn-outline-danger">
                    <i class="fa-regular fa-trash-can" data-bs-toggle="modal" data-bs-target="#delete_product<?= $products['id']?>"> </i>                    
                  </div>
                  <!-- buying icon  -->
                  <!-- 位置がおかしい -->
                  <?php
                  if($products['quantity'] >=1){
                  ?>
                    <a href="buy-product.php?product_id=<?=$products["id"]?>" class="btn btn-outline-success float-end" title="Edit">
                    <i class="fa-solid fa-cash-register"></i>
                  <?php
                  }
                  ?>
                </td>
              </tr>
                <!-- delete modal -->
              <div class="modal fade" id="delete_product<?= $products['id']?>" tabindex="-1" aria-labelledby="delete_product<?= $products['id']?>" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <p class="text-center"> Are you sure you want to delete
                    <?= $products['product_name'] ?> ?
                    </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <form action="../actions/product-actions.php" method="post">
                        <input type="hidden" value="<?= $products['id']?>" name="id">
                        <button type="submit" class="btn btn-danger" name="btn_delete">Delete</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div> 
              <?php
              }
              ?>
            </tbody>
          </table>
      </div>
  <!-- add product MODAL -->
      <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="add_product" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <h1 class="display-4 fw-bold text-info text-center"><i class="fa-solid fa-box"></i> Add Product</h1>

                    <form action="../actions/product-actions.php" method="post" class="w-75 mx-auto pt-4 p-5">
                      <div class="row mb-3">
                          <div class="col-md-12">
                              <label for="PN" class="form-label small text-secondary">Product Name</label>
                              <input type="text" name="productname" id="PN" class="form-control">
                          </div>
                      </div>
                      <div class="row mb-3">
                          <div class="col-md-6">
                              <label for="price" class="form-label small text-secondary">Price</label>
                              <div class="input-group mb-3">
                                <span class="input-group-text" id="price-tag">$</span>
                                <input type="number" name="price" id="price" class="form-control" aria-label="Price" aria-descrivedby="price-tag">
                              </div>
                          </div>
                          <div class="col-md">
                              <label for="qty" class="form-label small text-secondary">Quantity</label>
                              <input type="text" name="qty" id="qty" class="form-control">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md">
                              <button type="submit" class="btn btn-danger w-100" name="add">Add</button>
                          </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

    </main>

<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
