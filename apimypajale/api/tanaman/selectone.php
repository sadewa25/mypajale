<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tanaman/Tanaman.php';

  $tanaman = new Tanaman($dbh);

  $tanaman->id = isset($_GET['id_tanaman']) ? $_GET['id_tanaman'] : die();

  $data = $tanaman->select('id', $tanaman->id);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
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
