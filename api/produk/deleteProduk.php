<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_produk = $_POST['id_produk'];

  $sql = "DELETE FROM `produk` WHERE `id_produk` = '$id_produk' ";

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