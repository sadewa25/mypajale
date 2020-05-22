<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/opt/Opt.php';

  $opt = new Opt($dbh);

  $nama = $_POST['nama'];
  $gejala = $_POST['id_gejala'];
  $gambar_opt = $_POST['gambar_opt'];
  $solusi = $_POST['solusi'];
  $kategori = $_POST['id_kategori'];
  $organisme = $_POST['id_organisme'];
  $tanaman = $_POST['id_tanaman'];
  $deskripsi_opt = $_POST['deskripsi_opt'];

  if (!empty($nama) &&
      !empty($gejala) &&
      !empty($kategori) &&
      !empty($organisme) &&
      !empty($tanaman)){

    $opt->nama = $nama;
    $opt->gejala = $gejala;
    $opt->gambar_opt = $gambar_opt;
    $opt->solusi = $solusi;
    $opt->kategori = $kategori;
    $opt->organisme = $organisme;
    $opt->tanaman = $tanaman;
    $opt->deskripsi_opt = $deskripsi_opt;

    if ($opt->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "opt tanaman berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan opt tanaman"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan opt tanaman. Data tidak lengkap"));

  }

 ?>
