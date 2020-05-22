<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kabupaten/Kabupaten.php';

  $kabupaten = new Kabupaten($dbh);

  $id_prov = $_POST['id_prov'];
  $nama = $_POST['nama'];
  $id_jenis = $_POST['id_jenis'];
  $id_kab = $_POST['id_kab'];

  if (!empty($id_prov) && !empty($nama) && !empty($id_jenis) && !empty($id_kab)){
    $kabupaten->id_prov = $id_prov;
    $kabupaten->nama = $nama;
    $kabupaten->id_jenis = $id_jenis;
    $kabupaten->id_kab = $id_kab;

    if ($kabupaten->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "Kabupaten berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan kabupaten"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menambahkan kabupaten. Data tidak lengkap"));

  }

 ?>
