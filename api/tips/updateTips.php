<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $judul_tips = $_POST['judul_tips'];
  $gambar_tips = $_POST['gambar_tips'];
  $deskripsi_tips = $_POST['deskripsi_tips'];
  $id_users = $_POST['id_users'];
  $id_kategori_tips = $_POST['id_kategori_tips'];
  $apikey = $_POST['api_key'];

  $id_tips = $_POST['id_tips'];

  $api = "b245fa2b067cae97fff0d626d3b3197e";

  $sql = "UPDATE `tips` SET `judul_tips`='$judul_tips',`gambar_tips`='$gambar_tips',`deskripsi_tips`='$deskripsi_tips',`id_users`='$id_users',`id_kategori_tips`='$id_kategori_tips' WHERE `id_tips` = '$id_tips' ";

  if ($api == $apikey) {
  	 if(mysqli_query($con,$sql)){
    	echo json_encode(array("value"=>1,"message"=>"Laporan Tips Berhasil"));
	  }else{
	    echo json_encode(array("value"=>0,"message"=>"Laporan Tips Gagal"));
	  }
  }else{
  	echo json_encode(array("value"=>0,"message"=>"API Key Token Salah"));
  }

  mysqli_close($con);

}