<?php

require_once('konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_kab = $_POST['id_kab'];

  $sql = "SELECT `id_kec`, `id_kab`, `nama` FROM `kecamatan` WHERE `id_kab` = '$id_kab' ";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $result = array();
  if ($api == $apikey) {
      $res = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($res)){
      array_push($result, array('id_kec'=>$row[0], 'id_kab'=>$row[1], 'nama'=>$row[2]));
    }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}