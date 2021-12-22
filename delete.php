<?php

  require __DIR__.'/vendor/autoload.php';
  require_once 'config.php';
  
  use App\Entity\Product;

  header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');
  header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");

  // Validates the SKU
  if(!isset($_GET['sku'])) {
    header('location: '.FE_URL);
    exit;
  }

  // Consults the product
  $product = Product::getSingleProduct($_GET['sku']);
  
  // Delete the product
  $product->delete();

  exit;

?>