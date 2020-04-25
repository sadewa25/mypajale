<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';
  require_once '../../dbhelper/pegawai/Pegawai.php';
  require_once '../../dbhelper/koordinator/Koordinator.php';

  $users = new Users($dbh);

  $username_user  = $_POST['username_user'];
  $password_user  = $_POST['password_user'];

  // echo $username_user.$password_user;

  if (!empty($username_user) && !empty($password_user)){

    $users->username_user = $username_user;
    $users->password_user = md5($password_user);
    // echo $users->password_user;

    $stmt_user = $users->login();
    //print_r($stmt_user->fetch(PDO::FETCH_ASSOC));
    $num_user = $stmt_user->rowCount();
    //echo $num_user;

    if ($num_user > 0) {
      $result = array();
      $result['value'] = 1;
      $result['result'] = array();

      while ($row = $stmt_user->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $data_user = array(
          'id_user' => $id_users,
          'nama_lengkap' => trim($nama_lengkap),
          'email_user' => $email_user,
          'id_status_users' => $id_status_users,
        );

        array_push($result['result'], $data_user);
      }

      http_response_code(200);

      echo json_encode($result);
    } else {
      http_response_code(200);
      echo json_encode(
        array("value" =>0, "result" => [])
      );
    }
  } else {
    http_response_code(200);
    echo json_encode(
      array("value" =>0, "result" => [])
    );
  }

 ?>
