<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/status-user/StatusUser.php';

  $status = new StatusUser($dbh);

  $status->id_status_user = isset($_GET['id_status']) ? $_GET['id_status'] : die();

  $data = $status->select('id_status_user', $status->id_status_user);
  $num = $data->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kel = array(
        'id_status_user' => $id_status_user,
        'nama_status_user' => $nama_status_user
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
