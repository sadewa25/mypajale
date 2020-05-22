<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/gejala/Gejala.php';

  $gejala = new Gejala($dbh);

  $nama = $_POST['nama'];
  $organ_terserang = $_POST['id_organ_terserang'];
  $tanaman = $_POST['id_tanaman'];

  if (!empty($nama) &&
      !empty($organ_terserang) &&
      !empty($tanaman)){

    $gejala->nama = $nama;
    $gejala->organ_terserang = $organ_terserang;
    $gejala->tanaman = $tanaman;

    if ($gejala->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "gejala tanaman berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan gejala tanaman"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan gejala tanaman. Data tidak lengkap"));

  }

 ?>
