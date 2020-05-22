<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tips/Tips.php';

  $tips = new Tips($dbh);

  $judul_tips = $_POST['judul_tips'];
  $gambar_tips = $_POST['gambar_tips'];
  $deskripsi_tips = $_POST['deskripsi_tips'];
  $id_users = $_POST['id_users'];
  $id_kategori_tips = $_POST['id_kategori_tips'];
  $id_tanaman = $_POST['id_tanaman'];
  $id_tips = $_POST['id_tips'];

  if (!empty($judul_tips) &&
      !empty($id_tanaman) &&
      !empty($id_users) &&
      !empty($id_kategori_tips) &&
      !empty($id_tips)){

    $tips->judul_tips = $judul_tips;
    $tips->gambar_tips = $gambar_tips;
    $tips->deskripsi_tips = $deskripsi_tips;
    $tips->id_users = $id_users;
    $tips->id_kategori_tips = $id_kategori_tips;
    $tips->id_tanaman = $id_tanaman;
    $tips->id_tips = $id_tips;

    if ($tips->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "tips berhasil diperbarui"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal memperbarui tips"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal memperbarui tips. Data tidak lengkap"));

  }

 ?>
