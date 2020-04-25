<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-produk/KategoriProduk.php';

  $kategori = new KategoriProduk($dbh);

  $kategori->id_kategori_produk = isset($_GET['id_kategori_produk']) ? $_GET['id_kategori_produk'] : die();

  $data = $kategori->select('id_kategori_produk', $kategori->id_kategori_produk);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
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
