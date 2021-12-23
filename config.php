<?php

  // Define global variables
  define('BE_URL', 'https://asteriated-period.000webhostapp.com');
  define('FE_URL', 'https://product-listing-test-fe-alex-nascimentoo.vercel.app');

  // Defining local variables
  define('DB_SERVER', 'us-cdbr-east-05.cleardb.net');
  define('DB_USERNAME', 'b61343b96d031b');
  define('DB_PASSWORD', '3bc39a7d');
  define('DB_NAME', 'heroku_fe6924580902dae');

  // Try to connect to database
  try {
    $pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("ERROR: It wasn't possible to connect.". $e->getMessage());
  }

?>