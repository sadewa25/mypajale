<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-produk/KategoriProduk.php';

  $kategori = new KategoriProduk($dbh);

  $nama = $_POST['nama_kategori_produk'];

  if (!empty($nama)){
    $kategori->nama_kategori_produk = $nama;

    if ($kategori->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "Kategori Produk berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan kategori produk"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan kategori produk. Data tidak lengkap"));

  }

 ?>
