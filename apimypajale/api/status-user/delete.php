<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/status-user/StatusUser.php';

  $status = new StatusUser($dbh);

  $id = $_POST['id_status_user'];

  if (!empty($id)){
    $status->id_status_user = $id;

    if ($status->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "status berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menghapus status"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus status. Data tidak lengkap"));

  }

 ?>
