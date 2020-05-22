<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/kategori-tips/KategoriTips.php';

  $kategori = new KategoriTips($dbh);

  $stmt = $kategori->select();
  $num = $stmt->rowCount();

  if ($num > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $data_kategori = array(
        'id_kategori_tips' => $id_kategori_tips,
        'nama_kategori_tips' => $nama_kategori_tips,
        'keterangan_kategori_tips' => $keterangan_kategori_tips
      );

      array_push($result['result'], $data_kategori);
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
