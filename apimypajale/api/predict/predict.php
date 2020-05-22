<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include '../../model/Model.php';
  include '../../dbhelper/connection.php';
  include '../../dbhelper/opt/Opt.php';
  include '../../dbhelper/gejala/Gejala.php';
  include '../../dbhelper/tanaman/Tanaman.php';

  $tanaman = new Tanaman($dbh);
  $gejala = new Gejala($dbh);
  $opt = new Opt($dbh);

  $dataTanaman = $tanaman->select();

  $dataGejalaPadi = $gejala->select("tanaman", "T1");
  //print_r($dataGejalaPadi);
  $dataGejalaJagung = $gejala->select("tanaman", "T2");
  $dataGejalaKedelai = $gejala->select("tanaman", "T3");

  $dataOptPadi = $opt->select("tanaman", "T1");
  $dataOptJagung = $opt->select("tanaman", "T2");
  $dataOptKedelai = $opt->select("tanaman", "T3");

  $modelPadi = new Model($dataOptPadi, $dataGejalaPadi);
  $modelJagung = new Model($dataOptJagung, $dataGejalaJagung);
  $modelKedelai = new Model($dataOptKedelai, $dataGejalaKedelai);

  $modelBaseOptPadi = $modelPadi->baseModelOpt();
  $modelBaseOptJagung = $modelJagung->baseModelOpt();
  $modelBaseOptKedelai = $modelKedelai->baseModelOpt();

  $modelOptPadi = $modelPadi->modelOPT($modelBaseOptPadi);
  $modelOptJagung = $modelJagung->modelOPT($modelBaseOptJagung);
  $modelOptKedelai = $modelKedelai->modelOPT($modelBaseOptKedelai);

  $model = $_POST['daftar_id_gejala'];
  $id_tanaman = $_POST['id_tanaman'];

  $result['value'] = 0;
  $result['result'] = array();

  if (!empty($model) && !empty($id_tanaman)){
    $model = explode(',', $model);
    if ($id_tanaman === "T1") {
      $result['value'] = 1;
      http_response_code(201);
      $result['result'] = $modelPadi->predict($model, $modelBaseOptPadi, $modelOptPadi);
      echo json_encode($result);

    }
    else if($id_tanaman === "T2"){
      $result['value'] = 1;
      http_response_code(201);
      $result['result'] = $modelJagung->predict($model, $modelBaseOptJagung, $modelOptJagung);
      echo json_encode($result);

    }
    else if($id_tanaman === "T3"){
      $result['value'] = 1;
      http_response_code(201);
      $result['result'] = $modelKedelai->predict($model, $modelBaseOptKedelai, $modelOptKedelai);
      echo json_encode($result);

    } else {
      http_response_code(200);
      echo json_encode(array("value" =>0, "result" => []));

    }

  } else {
    http_response_code(200);
    echo json_encode(array("value" =>0, "result" => []));

  }


?>
