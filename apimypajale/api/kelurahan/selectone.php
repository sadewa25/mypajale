<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kelurahan/Kelurahan.php';

  $kelurahan = new Kelurahan($dbh);

  $kelurahan->id_kel = isset($_GET['id_kel']) ? $_GET['id_kel'] : die();

  $data = $kelurahan->select('id_kel', $kelurahan->id_kel);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kel = array(
        'id_kel' => $id_kel,
        'id_kec' => $id_kec,
        'nama' => $nama
      );

      array_push($result['result'], $data_kel);
    }

    http_response_code(200);

    echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" => 0,"result" => [])
    );
  }
 ?>
