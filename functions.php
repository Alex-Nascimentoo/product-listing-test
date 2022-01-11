<?php

  require __DIR__.'/vendor/autoload.php';
  require_once 'config.php';

  use App\Entity\Product;

  header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');
  header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");

  // If request method is post, it saves a new product in the database
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {

      // Try to find an existing product with this SKU
      $isProdReal = Product::getSingleProduct($_POST['sku']);

      // Back-end validations before saving the prodcut on database
      if($isProdReal) {
        $message = "A product with the same SKU code already exists, please use another SKU code.";

        header('location: '. FE_URL. '/add-product/repeatedSku?message='.$message);
        exit;

        // Checks if price is of type number
      } 
      
      $typePrice = (double) $_POST['price'];

      if(true) {
      // if($typePrice != 'integer' and $typePrice != 'double') {
        // $message = "ERROR: The price attribute should be a number, please enter a valid number.";
        $message = $typePrice." and type ".gettype($typePrice);

        header('location: '. FE_URL. '/add-product/repeatedSku?message='.$message);
        exit;
      }

      // Create a new instance of the product
      $prod = new Product;

      $prod->setSku($_POST['sku']);
      $prod->setName($_POST['name']);
      $prod->setPrice($_POST['price']);
      $prod->setType($_POST['productType']);

      // Changing the special attribute according to its type
      if($_POST['productType'] == 'book') {
        $prod->setAttribute($_POST['weight']);

      }else if($_POST['productType'] == 'dvd') {
        $prod->setAttribute($_POST['dvdSize']);

      }else if($_POST['productType'] == 'furniture') {

        // Get all the single attributes
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];

        // Put all the attributes together in one string
        $attr = $height.'x'.$width.'x'.$length;
        $prod->setAttribute($attr);
      }

      // Effectively save the product
      $prod->saveNewProd();

      // Go back to listing page
      header('location: '.FE_URL);
      exit;
    }catch(error $e) {
      echo $e;
    }
  }

  // If request method is get, it return all the products from database
  if($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Get all the products and pass it to a variable
    $products = Product::getProducts();

    // Return properly all the products
    die(json_encode($products));
  }

?>