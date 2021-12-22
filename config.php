<?php

  // Define global variables
  define('BE_URL', 'https://asteriated-period.000webhostapp.com');
  define('FE_URL', 'https://product-listing-test-fe-alex-nascimentoo.vercel.app');

  // Defining local variables
  define('DB_SERVER', '45.132.241.157');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', 'umasenhabolada');
  define('DB_NAME', 'scandiweb_test');

  // Try to connect to database
  try {
    $pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("ERROR: It wasn't possible to connect.". $e->getMessage());
  }

?>