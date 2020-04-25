<?php

require_once('konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $sql = "SELECT `id_jenis_tanaman`, `nama_jenis_tanaman` FROM `jenis_tanaman`";
  $res = mysqli_query($con,$sql);

  $result = array();

  $api = "b245fa2b067cae97fff0d626d3b3197e";

  if ($api == $apikey) {
    while($row = mysqli_fetch_array($res)){
      array_push($result, array('id_jenis_tanaman'=>$row[0], 'nama_jenis_tanaman'=>$row[1]));
    }
    if(empty($result)){
      echo json_encode(array("value"=>0,"result"=>$result));
    }else{
      echo json_encode(array("value"=>1,"result"=>$result));
    }
  }else{
    echo json_encode(array("value"=>0,"message"=>"API Key Token Anda Salah"));
  }

  mysqli_close($con);

}