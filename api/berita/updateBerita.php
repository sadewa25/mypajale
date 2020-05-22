<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $judul_berita = $_POST['judul_berita'];
  $deskripsi_berita = $_POST['deskripsi_berita'];
  $tgl_berita = $_POST['tgl_berita'];
  $gambar_berita = $_POST['gambar_berita'];
  $id_users = $_POST['id_users'];
  $id_berita = $_POST['id_berita'];
  $apikey = $_POST['api_key'];

  $api = "b245fa2b067cae97fff0d626d3b3197e";


  $sql = "UPDATE `berita` SET `judul_berita`='$judul_berita',`deskripsi_berita`='$deskripsi_berita',`tgl_berita`='$tgl_berita',`gambar_berita`='$gambar_berita',`id_users`='$id_users' WHERE id_berita ='$id_berita' ";

  if ($api == $apikey) {
  	if(mysqli_query($con,$sql)){
    	echo json_encode(array("value"=>1,"message"=>"Berita Berhasil"));
	  }else{
	    echo json_encode(array("value"=>0,"message"=>"Berita Gagal"));
	  }
  }else{echo json_encode(array("value"=>0,"message"=>"API Key Token Salah"));}

  mysqli_close($con);

}