<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/chat/Chat.php';

  $chat = new Chat($dbh);

  $stmt = $chat->select();

  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
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
