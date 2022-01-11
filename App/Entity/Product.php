<?php 

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Product {
  
  // Unique identifier of the product
  private $sku;

  // Get product SKU
  public function getSku() {
    return $this->sku;
  }

  // Set product SKU
  public function setSku(string $s) {
    $this->sku = $s;
  }

  // Name of the product
  private $name;

  // Get product name
  public function getName() {
    return $this->name;
  }

  // Set product name
  public function setName(string $n) {
    $this->name = $n;
  }

  // Product price
  private $price;

  // Get product price
  public function getPrice() {
    return $this->price;
  }

  // Set product price
  public function setPrice(float $p) {
    $this->price = $p;
  }

  // Product type
  private $type;

  // Get product type
  public function getType() {
    return $this->type;
  }

  // Set product type
  public function setType(string $t) {
    $this->type = $t;
  }

  // Special attribute of the product
  private $attribute;

  // Get product attribute
  public function getAttribute() {
    return $this->attribute;
  }

  // Set product attribute
  public function setAttribute($a) {
    $this->attribute = $a;
  }

  // Save new product at the database
  public function saveNewProd() {

    // Insert product at the database
    $prodDb = new Database('products');
    $prodDb->insert([
      'sku' => $this->sku,
      'name' => $this->name,
      'price' => $this->price,
      'type' => $this->type,
      'attribute' => $this->attribute
    ]);

    return true;
  }

  // Method responsible for get all the products from the database
  public static function getProducts() {
    return (new Database('products'))->select()
    ->fetchAll(PDO::FETCH_ASSOC); 
  }

  // Method responsible for get a single product from the database according to its SKU code
  public static function getSingleProduct($sku) {
    return (new Database('products'))->select('sku = "'.$sku.'"')
    ->fetchObject(self::class);
  }

  // Calling the delete method from Database.php
  public function delete() {
    return (new Database('products'))->delete('sku = "'.$this->sku.'"');
  }

}

?>