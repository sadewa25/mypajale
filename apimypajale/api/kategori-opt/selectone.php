<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-opt/KategoriOPT.php';

  $kategori = new KategoriOPT($dbh);

  $kategori->id = isset($_GET['id_kategori_opt']) ? $_GET['id_kategori_opt'] : die();

  $data = $kategori->select('id', $kategori->id);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kategori = array(
        'id_kategori_opt' => $id,
        'nama' => $nama
      );

      array_push($result['result'], $data_kategori);
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
