<?php

  $host = 'localhost';
  $user = 'sadewa';
  $password = 'M4njaddawajadda!';
  $database = 'mypajale';

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
