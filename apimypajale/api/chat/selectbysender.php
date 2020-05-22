<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/chat/Chat.php';

  $chat = new Chat($dbh);

  $chat->sender_id = isset($_GET['id_sender']) ? $_GET['id_sender'] : die();

  $data = $chat->select('sender_id', $chat->sender_id);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data = array(
        'id_chat' => $id_chat,
        'id_group_chat' => $id_group_chat,
        'message_chat' => $message_chat,
        'sender_id' => $sender_id
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
