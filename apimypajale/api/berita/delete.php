<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/berita/Berita.php';

  $berita = new Berita($dbh);

  $id_berita = $_POST['id_berita'];

  if (!empty($id_berita)){
    $berita->id_berita = $id_berita;

    if ($berita->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "Berita berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus berita"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus berita. Data tidak lengkap"));

  }

 ?>
