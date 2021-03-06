<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/produk/Produk.php';

  $produk = new Produk($dbh);

  $stmt = $produk->select();

  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
      extract($row);

      $data = array(
        'id_produk' => $id_produk,
        'nama_produk' => $nama_produk,
        'gambar_produk' => $gambar_produk,
        'deskripsi_produk' => $deskripsi_produk,
        'nama_usaha' => $nama_usaha,
        'nama_lengkap' => $nama_lengkap,
        'nama_kategori_produk' => $nama_kategori_produk,
        'tanaman' => $tanaman,
        'id_users' => $id_users
      );

      array_push($result['result'], $data);
    }

    http_response_code(200);

    echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" =>0, "result" => [])
    );
  }
 ?>
