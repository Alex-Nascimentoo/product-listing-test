<?php 

namespace App\Entity;

use App\Db\Database;
use \PDO;

class Product {
  
  // Unique identifier of the product
  public $sku;

  // Name of the product
  public $name;

  // Product price
  public $price;

  // Product type
  public $type;

  // Special attribute of the product
  public $attribute;

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
    ->fetchAll(PDO::FETCH_CLASS, self::class);
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