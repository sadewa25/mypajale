<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tips/Tips.php';

  $tips = new Tips($dbh);

  $stmt = $tips->select();
  //print_r($stmt);
  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
      extract($row);

      $data = array(
        'id_tips' => $id_tips,
        'judul_tips' => $judul_tips,
        'gambar_tips' => $gambar_tips,
        'deskripsi_tips' => $deskripsi_tips,
        'nama_lengkap' => $nama_lengkap,
        'nama_kategori_tips' => $nama_kategori_tips,
        'tanaman' => $tanaman,
        'id_tanaman' => $id_tanaman,
        'id_kategori_tips' => $id_kategori_tips,
        'id_users' => $id_users,
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
