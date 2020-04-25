<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/produk/Produk.php';

  $produk = new Produk($dbh);

  $produk->id_produk = isset($_POST['id_users']) ? $_POST['id_users'] : die();

  $data = $produk->select('id_users', $produk->id_produk);
  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
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
        'id_users' => $id_users,
        'id_kategori_produk' => $id_kategori_produk,
        'id_tanaman' => $id_tanaman,
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
