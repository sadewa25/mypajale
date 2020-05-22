<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/chat/Chat.php';

  $chat = new Chat($dbh);

  $id_group_chat = $_POST['id_group_chat'];
  $message_chat = $_POST['message_chat'];
  $sender_id = $_POST['sender_id'];
  $id_chat = $_POST['id_chat'];

  if (!empty($id_group_chat) &&
      !empty($sender_id) &&
      !empty($id_chat)){

    $chat->id_group_chat = $id_group_chat;
    $chat->message_chat = $message_chat;
    $chat->sender_id = $sender_id;
    $chat->id_chat = $id_chat;

    if ($chat->update()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "chat berhasil diperbarui"));
    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal memperbarui chat"));
    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal memperbarui chat. Data tidak lengkap"));
  }

 ?>
