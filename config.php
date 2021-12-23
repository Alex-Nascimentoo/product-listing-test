<?php

  // Define global variables
  define('BE_URL', 'https://asteriated-period.000webhostapp.com');
  define('FE_URL', 'https://product-listing-test-fe-alex-nascimentoo.vercel.app');

  // Defining local variables
  $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

  define('DB_SERVER', $url['host']);
  define('DB_USERNAME', $url['user']);
  define('DB_PASSWORD', $url['pass']);
  define('DB_NAME', substr($url['path'], 1));

  // Try to connect to database
  try {
    $pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("ERROR: It wasn't possible to connect.". $e->getMessage());
  }

?>