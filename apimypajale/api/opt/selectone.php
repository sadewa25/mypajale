<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header('Content-Type: application/json');

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/opt/Opt.php';

  $opt = new Opt($dbh);

  $opt->id = isset($_GET['id_opt']) ? $_GET['id_opt'] : die();

  $data = $opt->select('id', $opt->id);

  if (sizeof($data) > 0) {
    $result = array();
    $result['value'] = 1;
    $result['result'] = array();

    foreach ($data as $row) {
      extract($row);

      $data_opt = array(
        'id' => $id,
        'nama' => $nama,
        'gejala' => $gejala,
        'gambar_opt' => $gambar_opt,
        'deskripsi_opt' => $deskripsi_opt,
        'solusi' => $solusi,
        'kategori' => $kategori,
        'organisme' => $organisme,
        'tanaman' => $tanaman,
        'id_organisme' => $id_organisme,
        'id_tanaman' => $id_tanaman
      );

      array_push($result['result'], $data_opt);
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
