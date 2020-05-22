<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/gejala/Gejala.php';

  $gejala = new Gejala($dbh);

  $gejala->tanaman = isset($_GET['id_tanaman']) ? $_GET['id_tanaman'] : die();

  $data = $gejala->select('tanaman', $gejala->tanaman);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data_gejala = array(
        'id_gejala' => $id,
        'nama' => $nama,
        'organ_terserang' => $organ_terserang,
        'tanaman' => $tanaman,
        'id_organ_terserang' => $id_organ_terserang,
        'id_tanaman' => $id_tanaman
      );

      array_push($result['result'], $data_gejala);
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
