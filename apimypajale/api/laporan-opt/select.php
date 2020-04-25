<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/laporan-opt/LaporanOPT.php';

  $laporan = new LaporanOPT($dbh);

  $stmt = $laporan->select();
  //print_r($stmt);
  if (sizeof($stmt) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($stmt as $row) {
      extract($row);

      $data = array(
        'id_laporan_opt' => $id_laporan_opt,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'judul_laporan' => $judul_laporan,
        'nama_lengkap' => $nama_lengkap,
        'tanaman' => $tanaman,
        'desa' => $desa,
        'nama_opt' =>  $nama_opt,
        'nama_kelompok_tani' => $nama_kelompok_tani,
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
        'id_penyakit' => $id_penyakit,
        'id_user' => $id_user
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
