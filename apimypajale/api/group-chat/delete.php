<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/group-chat/GroupChat.php';

  $groupChat = new GroupChat($dbh);

  $id_group_chat = $_POST['id_group_chat'];

  if (!empty($id_group_chat)){
    $groupChat->id_group_chat = $id_group_chat;

    if ($groupChat->delete()) {
      http_response_code(201);
      echo json_encode(array("value" => 1, "message" => "Group chat berhasil dihapus"));

    } else {
      http_response_code(503);
      echo json_encode(array("value" => 0, "message" => "Gagal menghapus group chat"));

    }

  } else {
    http_response_code(400);
    echo json_encode(array("value" => 0, "message" => "Gagal menghapus group chat. Data tidak lengkap"));

  }

 ?>
