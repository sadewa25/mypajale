<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/gejala/Gejala.php';

  $gejala = new Gejala($dbh);

  $id = $_POST['id_gejala'];
  $nama = $_POST['nama'];
  $organ_terserang = $_POST['id_organ_terserang'];
  $tanaman = $_POST['id_tanaman'];

  if (!empty($id) &&
      !empty($nama) &&
      !empty($organ_terserang) &&
      !empty($tanaman)){

    $gejala->id = $id;
    $gejala->nama = $nama;
    $gejala->organ_terserang = $organ_terserang;
    $gejala->tanaman = $tanaman;

    if ($gejala->update()) {
      http_response_code(200);
      echo json_encode(array("value" => 1,"message" => "gejala tanaman berhasil dirubah"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal merubah gejala tanaman"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal merubah gejala tanaman. Data tidak lengkap"));

  }

 ?>
