<?php

  // Define global variables
  define('BE_URL', 'https://asteriated-period.000webhostapp.com');
  define('FE_URL', 'https://product-listing-test-fe-alex-nascimentoo.vercel.app');

  // Defining local variables
  define('DB_SERVER', 'http://sql10.freesqldatabase.com/');
  define('DB_USERNAME', 'sql10460610');
  define('DB_PASSWORD', 'htWCGcspMs');
  define('DB_NAME', 'sql10460610');

  // Try to connect to database
  try {
    $pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("ERROR: It wasn't possible to connect.". $e->getMessage());
  }

?>