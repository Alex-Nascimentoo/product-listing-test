<?php

  require_once 'config.php';

  header('Access-Control-Allow-Origin: *');
  // header('Content-Type: application/json');
  header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
  header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization");

  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('location: '.FE_URL);
  }

?>