<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/gejala/Gejala.php';

  $gejala = new Gejala($dbh);

  $stmt = $gejala->select();

  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
      extract($row);

      $gejala = array(
        'id_gejala' => $id,
        'nama' => $nama,
        'organ_terserang' => $organ_terserang,
        'tanaman' => $tanaman,
        'id_organ_terserang' => $id_organ_terserang,
        'id_tanaman' => $id_tanaman
      );

      array_push($result['result'], $gejala);

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
