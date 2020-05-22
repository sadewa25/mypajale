<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $email_user  = $_POST['email_user'];
  $password_user  = $_POST['password_user'];

  if (!empty($email_user) && !empty($password_user)){

    $users->email_user = $email_user;
    $users->password_user = md5($password_user);

    $stmt = $users->select('email_user', $users->email_user);
    $num = $stmt->rowCount();

    if ($users->changePassword() && $num > 0) {
      http_response_code(201);
      echo json_encode(array("value" => 1,"message" => "Data user berhasil diubah"));

    } else {
      http_response_code(200);
      echo json_encode(array("value" => 0,"message" => "Gagal mengubah password user"));
    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0,"message" => "Gagal mengubah password user. Data tidak lengkap"));

  }

 ?>
