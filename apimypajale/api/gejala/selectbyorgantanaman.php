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
  $gejala->organ_terserang = isset($_GET['id_organ_terserang']) ? $_GET['id_organ_terserang'] : die();

  $data = $gejala->selectOrganTanaman();

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data_gejala = array(
        'id' => $id,
        'nama' => $nama,
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
