<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kabupaten/Kabupaten.php';

  $kabupaten = new Kabupaten($dbh);

  $kabupaten->id_kab = isset($_GET['id_kab']) ? $_GET['id_kab'] : die();

  $data = $kabupaten->select('id_kab', $kabupaten->id_kab);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kab = array(
        'id_kab' => $id_kab,
        'id_prov' => $id_prov,
        'nama' => $nama,
        'id_jenis' => $id_jenis
      );

      array_push($result['result'], $data_kab);
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
