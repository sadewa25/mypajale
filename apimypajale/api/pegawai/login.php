<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/pegawai/Pegawai.php';

  $pegawai = new Pegawai($dbh);
  $data = $pegawai->select();
  print_r($data->fetchAll());

  $nip_pegawai  = $_POST['nip_pegawai'];
  $password_pegawai  = $_POST['password_pegawai'];

  if (!empty($nip_pegawai) && !empty($password_pegawai)){

    $pegawai->nip_pegawai = $nip_pegawai;
    $pegawai->password_pegawai = md5($password_pegawai);

    $stmt = $pegawai->login();
    //print_r($stmt);
    $num = $stmt->rowCount();

    if ($num > 0) {
      $result = array();
      $result['value'] = 1;
      $result['result'] = array();

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $data_user = array(
          'nip_pegawai' => $nip_pegawai,
          'nama_pegawai' => $nama_pegawai,
          'nip_koordinator' => $nip_koordinator
        );

        array_push($result['result'], $data_user);
      }

      http_response_code(200);

      echo json_encode($result);
    } else {
      http_response_code(200);

      echo json_encode(
        array("value" =>0, "result" => [])
      );
    }
  } else {
    http_response_code(200);
    echo json_encode(
      array("value" =>0, "result" => [])
    );
  }

 ?>
