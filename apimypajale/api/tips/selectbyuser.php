<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tips/Tips.php';

  $tips = new Tips($dbh);

  $tips->id_tips = isset($_POST['id_users']) ? $_POST['id_users'] : die();

  $data = $tips->select('id_users', $tips->id_tips);
  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data = array(
        'id_tips' => $id_tips,
        'judul_tips' => $judul_tips,
        'gambar_tips' => $gambar_tips,
        'deskripsi_tips' => $deskripsi_tips,
        'nama_lengkap' => $nama_lengkap,
        'nama_kategori_tips' => $nama_kategori_tips,
        'tanaman' => $tanaman,
        'id_users' => $id_users,
        'id_kategori_tips' => $id_kategori_tips,
        'id_tanaman' => $id_tanaman,
        'id_users' => $id_users
      );

      array_push($result['result'], $data);
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
