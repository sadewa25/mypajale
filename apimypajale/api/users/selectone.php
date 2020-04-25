<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $users->id_users = isset($_GET['id_users']) ? $_GET['id_users'] : die();

  $data = $users->select('id_users', $users->id_users);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data = array(
        'id_user' => $id_users,
        'nama_lengkap' => $nama_lengkap,
        'email_user' => $email_user,
        'password_user' => $password_user,
        'telephone_user' => $telephone_user,
        'profesi' => $profesi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'alamat' => $alamat,
        'id_koordinator' => $id_koordinator,
        'id_status_users' => $id_status_users,
      );

      array_push($result['result'], $data);
    }

    http_response_code(200);

    echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" =>0, "result" => [])
    );
  }
 ?>
