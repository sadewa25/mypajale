<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/users/Users.php';

  $users = new Users($dbh);

  $stmt = $users->select();
  //print_r($stmt->fetchAll());
  $num = $stmt->rowCount();
  //echo $num;
  if ($num > 0) {
    $result = array();
    $result['result'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $data_user = array(
        'id_user' => $id_users,
        'email_user' => $email_user,
        'nama_lengkap' => trim($nama_lengkap),
        'password_user' => $password_user,
        'telephone_user' => $telephone_user,
        'profesi' => $profesi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'alamat' => $alamat,
        'id_koordinator' => $id_koordinator,
        'id_status_users' => $id_status_users,
      );
      array_push($result['result'], $data_user);
    }
    http_response_code(200);
    //print_r($result);
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" =>0, "result" => [])
    );
  }
 ?>
