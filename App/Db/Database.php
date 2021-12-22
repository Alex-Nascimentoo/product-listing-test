<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database {

  // Database connection host
  const HOST = 'localhost';

  // Database name
  const NAME = 'scandiweb_test';

  // Database user
  const USER = 'root';

  // Database password access
  const PASSWORD = '';

  // Table name to be manipulated
  private $table;

  // Database connection instance
  private $connection;

  // Define table and connection instance
  public function __construct($table = null) {
    $this->table = $table;
    $this->setConnection();
  }

  // Method responsible to create a connection with the database
  private function setConnection() {
    try {
      $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('ERROR: '.$e->getMessage());
    }
  }

  // Method responsible to execute queries at the database
  public function execute($query, $params = []) {
    try {
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    } catch (PDOException $e) {
      die('ERROR: '.$e->getMessage());
    }
  }

  // Method responsible to insert data in the database
  public function insert($values) {

    // Since all the values are required, I let the inputs as hard code
    $query = 'INSERT INTO '.$this->table.' (sku, name, price, type, attribute) VALUES (?, ?, ?, ?, ?)';

    // Executes the insert command
    $this->execute($query, array_values($values));
  }

  // Method responsible for retrieve all the elements in database
  public function select($where = null) {
    $where = strlen($where) ? 'WHERE '.$where : '';

    // Build the query
    $query = 'SELECT * FROM '.$this->table.' '.$where;

    // Return the query
    return $this->execute($query);
  }

  // Method responsible for deleting product from database
  public function delete($where) {
    // Build the query
    $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

    // Execute the query
    $this->execute($query);

    // Return success
    return  true;
  }

}

?>