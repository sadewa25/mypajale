<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/laporan-opt-keliling/LaporanKeliling.php';

  $laporan = new LaporanKeliling($dbh);

  $laporan->id_laporan_opt = isset($_GET['id_laporan']) ? $_GET['id_laporan'] : die();

  $data = $laporan->select('id_laporan_opt', $laporan->id_laporan_opt);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data[0] as $row) {
      extract($row);

      $data = array(
        'id_laporan_opt' => $id_laporan_opt,
        'id_user' => $id_user,
        'nama_pegawai' => $nama_pegawai,
        'judul_laporan' => $judul_laporan,
        'id_penyakit' => $id_penyakit,
        'nama_penyakit' => $nama_penyakit,
        'id_kec' => $id_kec,
        'desa' => $desa,
        'id_jenis_tanaman' => $id_jenis_tanaman,
        'nama_tanaman' => $nama_tanaman,
        'varietas' => $varietas,
        'umur' => $umur,
        'intensitas_serangan' => $intensitas_serangan,
        'luas_terserang' => $luas_terserang,
        'luas_hamparan' => $luas_hamparan,
        'gambar' => $gambar,
        'tanggal' => $tanggal,
        'jenis_musuh_alami' => $jenis_musuh_alami,
        'kesimpulan' => $kesimpulan,
        'rekomendasi' => $rekomendasi,
        'id_status_report' => $id_status_report,
        'keterangan_tanaman' => $keterangan_tanaman,
        'longitude' => $longitude,
        'latitude' => $latitude,
        'nama_status_report' => $nama_status_report
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
