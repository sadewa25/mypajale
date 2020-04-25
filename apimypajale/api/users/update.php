<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $nama_lengkap  = $_POST['nama_lengkap'];
  $email_user  = $_POST['email_user'];
  $password_user  = $_POST['password_user'];
  $telephone_user  = $_POST['telephone_user'];
  $profesi  = $_POST['profesi'];
  $kabupaten  = $_POST['kabupaten'];
  $kecamatan  = $_POST['kecamatan'];
  $alamat  = $_POST['alamat'];
  $id_status_users  = $_POST['id_status_users'];
  $id_users = $_POST['id_users'];

  if (!empty($id_users) &&
      !empty($nama_lengkap) &&
      !empty($email_user) &&
      !empty($password_user) &&
      !empty($telephone_user) &&
      !empty($profesi) &&
      !empty($kabupaten) &&
      !empty($kecamatan) &&
      !empty($alamat) &&
      !empty($id_status_users)){

    $users->id_users = $id_users;
    $users->nama_lengkap = $nama_lengkap;
    $users->email_user = $email_user;
    $users->password_user = md5($password_user);
    $users->telephone_user = $telephone_user;
    $users->profesi = $profesi;
    $users->kabupaten = $kabupaten;
    $users->kecamatan = $kecamatan;
    $users->alamat = $alamat;
    $users->id_status_users = $id_status_users;

    if ($users->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "Data user berhasil diubah"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal mengubah data user"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal mengubah data user. Data tidak lengkap"));

  }

 ?>
