<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/produk/Produk.php';

  $produk = new Produk($dbh);

  $id_produk = $_POST['id_produk'];

  if (!empty($id_produk)){
    $produk->id_produk = $id_produk;

    if ($produk->delete()) {
      http_response_code(200);
      echo json_encode(array("value" => 1, "message" => "produk berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus produk"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menghapus produk. Data tidak lengkap"));

  }

 ?>
