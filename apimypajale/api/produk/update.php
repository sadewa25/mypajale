<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/produk/Produk.php';

  $produk = new Produk($dbh);

  $nama_produk = $_POST['nama_produk'];
  $gambar_produk = $_POST['gambar_produk'];
  $deskripsi_produk = $_POST['deskripsi_produk'];
  $nama_usaha = $_POST['nama_usaha'];
  $id_users = $_POST['id_users'];
  $id_kategori_produk = $_POST['id_kategori_produk'];
  $id_tanaman = $_POST['id_tanaman'];
  $id_produk = $_POST['id_produk'];

  if (!empty($nama_produk) &&
      !empty($id_tanaman) &&
      !empty($nama_usaha) &&
      !empty($id_users) &&
      !empty($id_kategori_produk) &&
      !empty($id_produk)){

    $produk->nama_produk = $nama_produk;
    $produk->gambar_produk = $gambar_produk;
    $produk->deskripsi_produk = $deskripsi_produk;
    $produk->nama_usaha = $nama_usaha;
    $produk->id_users = $id_users;
    $produk->id_kategori_produk = $id_kategori_produk;
    $produk->id_tanaman = $id_tanaman;
    $produk->id_produk = $id_produk;

    if ($produk->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "produk berhasil diperbarui"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal memperbarui produk"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal memperbarui produk. Data tidak lengkap"));

  }

 ?>
