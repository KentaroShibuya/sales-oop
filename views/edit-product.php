<?php

session_start();
require '../classes/product.php';

$product_id = $_GET["product_id"];

//Create the object
$product = new Product;
$selected_product = $product->getProduct($product_id);


//ログインされたidと同じ番号をgetUserで走らせる

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Edit product</title>
</head>
<body>
  <nav class="navbar navbar-expand navbar-light " style="margin-bottom: 80px;">
    <div class="container-fluid">
      <div class="col">
        <a href="registration" class="navbar-brand">
          <i class="fa-solid fa-house fs-2"></i>
        </a>
      </div>
      <div class="col">
        <div class="navbar-nav">
          <i class="fa-solid fa-user-xmark fs-2 ms-auto text-danger"></i>
        </div>
      </div>
    </div>
  </nav>

    <main class="row justify-content-center gx-0">
      <div class="col-4">
        <h1 class="display-4 fw-bold text-warning text-center mb-4"><i class="fa-solid fa-pen-to-square"></i> Edit Product</h1>

        <!-- action正しい？ -->
        <form action="../actions/product-actions.php" method="post" enctype="multipart/form-data">
          <input type="hidden" value="<?= $selected_product['id'] ?>" name="id">
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="PN" class="form-label small text-secondary">Product Name</label>
              <input type="text" name="product_name" id="PN" class="form-control" value="<?= $selected_product['product_name'] ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="price" class="form-label small text-secondary">Price</label>
              <div class="input-group mb-3">
              <span class="input-group-text" id="price-tag">$</span>
              <input type="number" name="price" id="price" class="form-control" aria-label="Price" aria-descrivedby="price-tag" value="<?= $selected_product['price'] ?>">
            </div>
          </div>
          <div class="col-md-6">
            <label for="qty" class="form-label small text-secondary">Quantity</label>
            <input type="text" name="qty" id="qty" class="form-control" value="<?= $selected_product['quantity'] ?>">
          </div>
          <div class="row">
            <div class="col-md">
                <button type="submit" class="btn btn-warning w-100" name="edit">Edit</button>
            </div>
          </div>
        </form>
      </div>
    </main>
</body>
</html>
