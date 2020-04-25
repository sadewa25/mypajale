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

  if (!empty($id_group_chat) &&
      !empty($sender_id)){

    $chat->id_group_chat = $id_group_chat;
    $chat->message_chat = $message_chat;
    $chat->sender_id = $sender_id;

    if ($chat->insert()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "chat berhasil ditambahkan"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menambahkan chat"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menambahkan chat. Data tidak lengkap"));

  }

 ?>
