<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tanaman/Tanaman.php';

  $tanaman = new Tanaman($dbh);

  $stmt = $tanaman->select(1, 1, 'no');
  $num = $stmt->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_tanaman = array(
        'id_tanaman' => $id,
        'nama' => $nama,
        'deskripsi' => $deskripsi
      );

      array_push($result['result'], $data_tanaman);
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
