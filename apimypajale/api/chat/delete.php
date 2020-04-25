<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/chat/Chat.php';

  $chat = new Chat($dbh);

  $id_chat = $_POST['id_chat'];

  if (!empty($id_chat)){
    $chat->id_chat = $id_chat;

    if ($chat->delete()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "chat berhasil dihapus"));
    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus chat"));
    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menghapus chat. Data tidak lengkap"));
  }

 ?>
