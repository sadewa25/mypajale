<?php

  $host = 'localhost';
  $user = 'u8184594_sadewa';
  $password = 'M4njaddawajadda';
  $database = 'u8184594_pajale';

  try{
    $dbh = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    if($dbh){
      return true;
    }
  } catch (PDOException $error){
    echo "Error: " . $error->getMessage() . "<br/>";
    die();
  }

?>
