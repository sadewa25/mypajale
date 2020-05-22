<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_laporan_opt = $_POST['id_laporan_opt'];

  $sql = "DELETE FROM `laporan_opt` WHERE `id_laporan_opt` = '$id_laporan_opt' ";

  $api = "b245fa2b067cae97fff0d626d3b3197e";

  $result = array();

  if ($api == $apikey) {
    if(mysqli_query($con,$sql)){
      echo json_encode(array("value"=>1,"message"=>"Berhasil Di Hapus"));
    }else{
      echo json_encode(array("value"=>0,"message"=>"Gagal Di Hapus"));
    }
  }

  

  mysqli_close($con);

}