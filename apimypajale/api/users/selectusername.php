<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $username_user = $_POST['username_user'];
  $users->username_user = $username_user;

  if ($users->checkUsername() > 0) {
    echo json_encode(array("value" => 0,"message" => "Username sudah digunakan."));
  }
  else {
    echo json_encode(array("value" => 1,"message" => "Username tersedia."));
  }
 ?>
