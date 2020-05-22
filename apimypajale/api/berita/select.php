<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/berita/Berita.php';

  $berita = new Berita($dbh);

  $stmt = $berita->select();

  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
      extract($row);

      $data = array(
        'id_berita' => $id_berita,
        'judul_berita' => $judul_berita,
        'deskripsi_berita' => $deskripsi_berita,
        'tgl_berita' => $tgl_berita,
        'gambar_berita' => $gambar_berita,
        'nama_lengkap' => trim($nama_lengkap),
        'tanaman' => $tanaman,
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
      array("value" => 0, "result" => [])
    );
  }
 ?>
