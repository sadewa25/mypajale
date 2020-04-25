<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/organisme/Organisme.php';

  $organisme = new Organisme($dbh);

  $organisme->id = isset($_GET['id_organisme']) ? $_GET['id_organisme'] : die();

  $data = $organisme->select('id', $organisme->id);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_organisme = array(
        'id_organisme' => $id,
        'nama' => $nama
      );

      array_push($result['result'], $data_organisme);
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
