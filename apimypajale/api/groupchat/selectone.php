<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/group-chat/GroupChat.php';

  $groupChat = new GroupChat($dbh);

  $groupChat->id_group_chat = isset($_GET['id_group_chat']) ? $_GET['id_group_chat'] : die();

  $data = $groupChat->select('id_group_chat', $groupChat->id_group_chat);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data = array(
        'id_group_chat' => $id_group_chat,
        'id_pakar' => $id_pakar,
        'id_users' => $id_users
      );

      array_push($result['result'], $data);
    }

    http_response_code(200);

    echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" => 0, "result" => [])
    );
  }
 ?>
