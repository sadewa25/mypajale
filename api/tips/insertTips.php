<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $judul_tips = $_POST['judul_tips'];
  $gambar_tips = $_POST['gambar_tips'];
  $deskripsi_tips = $_POST['deskripsi_tips'];
  $id_users = $_POST['id_users'];
  $id_kategori_tips = $_POST['id_kategori_tips'];
  $apikey = $_POST['api_key'];

  $api = "b245fa2b067cae97fff0d626d3b3197e";

  $sql = "INSERT INTO `tips`(`judul_tips`, `gambar_tips`, `deskripsi_tips`, `id_users`, `id_kategori_tips`) VALUES ('$judul_tips','$gambar_tips','$deskripsi_tips','$id_users','$id_kategori_tips')";

  if ($api == $apikey) {
  	 if(mysqli_query($con,$sql)){
    	echo json_encode(array("value"=>1,"message"=>"Laporan OPT Berhasil"));
	  }else{
	    echo json_encode(array("value"=>0,"message"=>"Laporan OPT Gagal"));
	  }
  }else{
  	echo json_encode(array("value"=>0,"message"=>"API Key Token Salah"));
  }

  mysqli_close($con);

}