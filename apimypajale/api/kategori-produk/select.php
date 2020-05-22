<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-produk/KategoriProduk.php';

  $kategori = new KategoriProduk($dbh);

  $stmt = $kategori->select();
  $num = $stmt->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kategori = array(
        'id_kategori_produk' => $id_kategori_produk,
        'nama_kategori_produk' => $nama_kategori_produk
      );

      array_push($result['result'], $data_kategori);
    }

    http_response_code(200);

    echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" => 0,"result" => [])
    );
  }
 ?>
