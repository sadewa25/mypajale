<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kecamatan/Kecamatan.php';

  $kecamatan = new Kecamatan($dbh);

  $stmt = $kecamatan->select();
  $num = $stmt->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data = array(
        'id_kec' => $id_kec,
        'id_kab' => $id_kab,
        'nama' => $nama
      );

      array_push($result['result'], $data);
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
