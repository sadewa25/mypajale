<?php
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/opt/Opt.php';

  $opt = new Opt($dbh);

  $id_tanaman = $_POST['id_tanaman'];
  if(!empty($id_tanaman)){
    $opt->tanaman = $id_tanaman;

    $stmt = $opt->select('tanaman', $opt->tanaman);

    if (sizeof($stmt) > 0) {
      $result = array();
      $result['value'] = 1;
      $result['result'] = array();

      foreach ($stmt as $row) {
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
  }else {
    http_response_code(200);
    echo json_encode(array("value" => 0,"result" => []));
  }

 ?>
