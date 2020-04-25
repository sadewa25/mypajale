<?php

require_once('konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_kec = $_POST['id_kec'];

  $sql = "SELECT `id_kel`, `id_kec`, `nama`, `id_jenis` FROM `kelurahan` WHERE `id_kec` = '$id_kec' ";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $result = array();
  if ($api == $apikey) {
      $res = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($res)){
      array_push($result, array('id_kel'=>$row[0], 'id_kec'=>$row[1], 'nama'=>$row[2]));
    }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}