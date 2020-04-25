<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/berita/Berita.php';

  $berita = new Berita($dbh);

  $judul_berita = $_POST['judul_berita'];
  $deskripsi_berita = $_POST['deskripsi_berita'];
  $tgl_berita = $_POST['tgl_berita'];
  $gambar_berita = $_POST['gambar_berita'];
  $id_users = $_POST['id_users'];
  $id_tanaman = $_POST['id_tanaman'];

  if (!empty($judul_berita) &&
      !empty($deskripsi_berita) &&
      !empty($tgl_berita) &&
      !empty($id_tanaman) &&
      !empty($id_users)){

    $berita->judul_berita = $judul_berita;
    $berita->deskripsi_berita = $deskripsi_berita;
    $berita->tgl_berita = $tgl_berita;
    $berita->gambar_berita = $gambar_berita;
    $berita->id_users = $id_users;
    $berita->id_tanaman = $id_tanaman;

    if ($berita->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "Berita berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan berita"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan berita. Data tidak lengkap"));

  }

 ?>
