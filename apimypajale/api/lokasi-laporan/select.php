<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/lokasi-laporan/LokasiLaporan.php';

  $laporan = new LokasiLaporan($dbh);

  $stmt = $laporan->select();

  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
      extract($row);

      $data = array(
        'id_lokasi_laporan' => $id_lokasi_laporan,
        'nip_users' => $nip_users,
        'nama_kecamatan' => $nama_kecamatan
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
