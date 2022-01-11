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

        header('location: '. FE_URL. '/add-product/fail?message='.$message);
        exit;
      } 
      
      // Convert the price input to float
      $finalPrice = floatval($_POST['price']);

      // Check if final price is greater than 0 and not a string
      if($finalPrice <= 0 || gettype($finalPrice) == 'string') {
        $message = "The price attribute should be a number greater than 0, please enter a valid number.";

        header('location: '. FE_URL. '/add-product/fail?message='.$message);
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

        // Validate if the input is a number
        if(floatval($_POST['weight']) <= 0) {
          $message = "Product weight should be a number greater than 0, please enter a valid number.";

          header('location: '. FE_URL.'/add-product/fail?message='.$message);
          exit;
        }
        
        $prod->setAttribute($_POST['weight']);

      }else if($_POST['productType'] == 'dvd') {

        // Validate if the input is a number
        if(intval($_POST['dvdSize']) <= 0) {
          $message = "Product size should be a number greater than 0, please enter a valid number.";

          header('location: '. FE_URL.'/add-product/fail?message='.$message);
          exit;
        }

        $prod->setAttribute($_POST['dvdSize']);

      }else if($_POST['productType'] == 'furniture') {

        // Convert all the single attributes to number
        $height = intval($_POST['height']);
        $width = intval($_POST['width']);
        $length = intval($_POST['length']);

        // Validate if inputs are greater than 0
        if($height <= 0 || $width <= 0 || $length <= 0) {
          $message = "Product dimensions should be numbers greater than 0, please enter valid numbers.";

          header('location: '. FE_URL.'/add-product/fail?message='.$message);
          exit;
        }

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