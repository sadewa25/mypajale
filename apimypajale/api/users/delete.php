<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $id_users = $_POST['id_users'];

  if (!empty($id_users)){
    $users->id_users = $id_users;

    if ($users->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "users berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus users"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus users. Data tidak lengkap"));

  }

 ?>
