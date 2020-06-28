<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);


  $telephone_user  = $_POST['telephone_user'];
  $profesi  = $_POST['profesi'];
  $alamat  = $_POST['alamat'];
  $id_user = $_POST['id_user'];

  if (!empty($telephone_user) &&
      !empty($profesi) &&
      !empty($alamat) &&
      !empty($id_user)){

    $users->telephone_user = $telephone_user;
    $users->profesi = $profesi;
    $users->alamat = $alamat;
    $users->id_users = $id_user;

    if ($users->updateTelAlPro()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "Data user berhasil diubah"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal mengubah data user"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal mengubah data user. Data tidak lengkap"));

  }

 ?>
