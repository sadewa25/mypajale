<?php

require_once('konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];

  $sql = "SELECT penyakit.ID_PENYAKIT, penyakit.NAMA_PENYAKIT, penyakit.SOLUSI FROM penyakit";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $result = array();
  if ($api == $apikey) {
  	  $res = mysqli_query($con,$sql);
	  while($row = mysqli_fetch_array($res)){
	    array_push($result, array('id_penyakit'=>$row[0], 'nama_penyakit'=>$row[1], 'solusi'=>$row[2]));
	  }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}