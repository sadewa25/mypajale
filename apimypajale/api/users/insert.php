<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $username_user = $_POST['username_user'];
  $nama_lengkap  = $_POST['nama_lengkap'];
  $email_user  = $_POST['email_user'];
  $password_user  = $_POST['password_user'];
  $telephone_user  = $_POST['telephone_user'];
  $profesi  = $_POST['profesi'];
  $kabupaten  = $_POST['kabupaten'];
  $kecamatan  = $_POST['kecamatan'];
  $alamat  = $_POST['alamat'];
  $id_koordinator = $_POST['id_koordinator'];
  $foto_user = $_POST['foto_user'];
  $id_status_users  = $_POST['id_status_users'];

  if (!empty($nama_lengkap) &&
      !empty($username_user) &&
      !empty($email_user) &&
      !empty($password_user) &&
      !empty($id_status_users)){

    $users->username_user = $username_user;
    $users->nama_lengkap = $nama_lengkap;
    $users->email_user = $email_user;
    $users->password_user = md5($password_user);
    $users->telephone_user = $telephone_user;
    $users->profesi = $profesi;
    $users->kabupaten = $kabupaten;
    $users->kecamatan = $kecamatan;
    $users->alamat = $alamat;
    $users->id_koordinator = $id_koordinator;
    $users->foto_user = $foto_user;
    $users->id_status_users = $id_status_users;

    if ($users->checkUsername() > 0) {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Username sudah digunakan."));
    }
    else if ($users->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "User berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0,"message" => "Gagal menambahkan user"));
    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal menambahkan user. Data tidak lengkap"));

  }

 ?>
