<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kecamatan/Kecamatan.php';

  $kecamatan = new Kecamatan($dbh);

  $kecamatan->id_kec = isset($_GET['id_kec']) ? $_GET['id_kec'] : die();

  $data = $kecamatan->select('id_kec', $kecamatan->id_kec);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kec = array(
        'id_kec' => $id_kec,
        'id_kab' => $id_kab,
        'nama' => $nama
      );

      array_push($result['result'], $data_kec);
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
