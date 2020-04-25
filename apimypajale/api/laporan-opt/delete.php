<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/laporan-opt/LaporanOPT.php';

  $laporan = new LaporanOPT($dbh);

  $id_laporan_opt = $_POST['id_laporan_opt'];

  if (!empty($id_laporan_opt)){
    $laporan->id_laporan_opt = $id_laporan_opt;

    if ($laporan->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "laporan berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus laporan"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus laporan. Data tidak lengkap"));

  }

 ?>
