<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $judul_berita = $_POST['judul_berita'];
  $deskripsi_berita = $_POST['deskripsi_berita'];
  $tgl_berita = $_POST['tgl_berita'];
  $gambar_berita = $_POST['gambar_berita'];
  $id_users = $_POST['id_users'];
  $apikey = $_POST['api_key'];

  $api = "b245fa2b067cae97fff0d626d3b3197e";


  $sql = "INSERT INTO `berita`(`judul_berita`, `deskripsi_berita`, `tgl_berita`, `gambar_berita`, `id_users`) VALUES ('$judul_berita','$deskripsi_berita','$tgl_berita','$gambar_berita','$id_users')";

  if ($api == $apikey) {
  	if(mysqli_query($con,$sql)){
    	echo json_encode(array("value"=>1,"message"=>"Berita Berhasil"));
	  }else{
	    echo json_encode(array("value"=>0,"message"=>"Berita Gagal"));
	  }
  }else{echo json_encode(array("value"=>0,"message"=>"API Key Token Salah"));}

  mysqli_close($con);

}