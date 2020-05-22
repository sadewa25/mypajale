<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/koordinator/Koordinator.php';

  $koordinator = new Koordinator($dbh);

  $nip_koordinator  = $_POST['nip_koordinator'];
  $password_koordinator  = $_POST['password_koordinator'];

  if (!empty($nip_koordinator) && !empty($password_koordinator)){

    $koordinator->nip_koordinator = $nip_koordinator;
    $koordinator->password_koordinator = md5($password_koordinator);

    $stmt = $koordinator->login();
    //print_r($stmt);
    $num = $stmt->rowCount();

    if ($num > 0) {
      $result = array();
      $result['value'] = 1;
      $result['result'] = array();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $data_user = array(
          'nip_koordinator' => $nip_koordinator,
          'nama_koordinator' => $nama_koordinator,
          'id_kabupaten' => $id_kabupaten
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
