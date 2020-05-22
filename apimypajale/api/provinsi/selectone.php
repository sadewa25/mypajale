<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/provinsi/Provinsi.php';

  $provinsi = new Provinsi($dbh);

  $provinsi->id_prov = isset($_GET['id_prov']) ? $_GET['id_prov'] : die();

  $data = $provinsi->select('id_prov', $provinsi->id_prov);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kel = array(
        'id_prov' => $id_prov,
        'nama' => $nama
      );

      array_push($result['result'], $data_kel);
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
