<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/lokasi-laporan/LokasiLaporan.php';

  $laporan = new LokasiLaporan($dbh);

  $laporan->id_lokasi_laporan = isset($_GET['id_lokasi_laporan']) ? $_GET['id_lokasi_laporan'] : die();

  $data = $laporan->select('id_lokasi_laporan', $laporan->id_lokasi_laporan);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
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
