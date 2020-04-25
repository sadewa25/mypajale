<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/berita/Berita.php';

  $berita = new Berita($dbh);

  $berita->id_berita = isset($_POST['id_users']) ? $_POST['id_users'] : die();

  $data = $berita->select('id_users', $berita->id_berita);
  print_r($data);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
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
