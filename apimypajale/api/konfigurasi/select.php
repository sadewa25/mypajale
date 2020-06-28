<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/konfigurasi/Konfigurasi.php';

  $konfigurasi = new Konfigurasi($dbh);

  $stmt = $konfigurasi->select();
  $num = $stmt->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data = array(
        'id_konfigurasi' => $id_konfigurasi,
        'nama_konfigurasi' => $nama_konfigurasi,
        'versi_konfigurasi' => $versi_konfigurasi
      );

      array_push($result['result'], $data);
    }

    http_response_code(200);

    echo json_encode($result);
  } else {

    http_response_code(200);

    echo json_encode(
      array("value" => 0,"result" => [])
    );
  }
 ?>
