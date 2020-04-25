<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];

  $sql = "SELECT kategori_tips.id_kategori_tips,kategori_tips.nama_kategori_tips,kategori_tips.keterangan_kategori_tips FROM kategori_tips";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $result = array();
  if ($api == $apikey) {
  	  $res = mysqli_query($con,$sql);
	  while($row = mysqli_fetch_array($res)){
	    array_push($result, array('id_kategori_tips'=>$row[0], 'nama_kategori_tips'=>$row[1], 'keterangan_kategori_tips'=>$row[2]));
	  }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}