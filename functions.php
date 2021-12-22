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

      // Create a new instance of the product
      $prod = new Product;
      $prod->sku = $_POST['sku'];
      $prod->name = $_POST['name'];
      $prod->price = $_POST['price'];
      $prod->type = $_POST['productType'];

      // Changing the special attribute according to its type
      if($_POST['productType'] == 'book') {
        $prod->attribute = $_POST['weight'];

      }else if($_POST['productType'] == 'dvd') {
        $prod->attribute = $_POST['dvdSize'];

      }else if($_POST['productType'] == 'furniture') {

        // Get all the single attributes
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];

        // Put all the attributes together in one string
        $attr = $height.'x'.$width.'x'.$length;
        $prod->attribute = $attr;
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