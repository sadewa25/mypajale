<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_berita = $_POST['id_berita'];

  $sql = "DELETE FROM `berita` WHERE `id_berita` = '$id_berita' ";

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