<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/laporan-opt-keliling/LaporanKeliling.php';

  $laporan = new LaporanKeliling($dbh);

  $stmt = $laporan->select();
  //print_r($stmt[1]);
  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    // $result['laporan_bulanan'] = $stmt[1][0]['laporan_bulanan'];
    // $result['laporan_harian'] = $stmt[1][0]['laporan_harian'];

    $result['result'] = array();

    foreach ($stmt[0] as $row) {
      extract($row);

      $data = array(
        'id_laporan_opt' => $id_laporan_opt,
        'id_user' => $id_user,
        'nama_pegawai' => $nama_pegawai,
        'judul_laporan' => $judul_laporan,
        'id_penyaki' => $id_penyakit,
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
