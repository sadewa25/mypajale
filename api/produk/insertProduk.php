<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $nama_produk = $_POST['nama_produk'];
  $gambar_produk = $_POST['gambar_produk'];
  $deskripsi_produk = $_POST['deskripsi_produk'];
  $nama_usaha = $_POST['nama_usaha'];
  $id_users = $_POST['id_users'];
  $id_kategori_produk = $_POST['id_kategori_produk'];
  $apikey = $_POST['api_key'];

  $api = "b245fa2b067cae97fff0d626d3b3197e";

  $sql = "INSERT INTO `produk`(`nama_produk`, `gambar_produk`, `deskripsi_produk`, `nama_usaha`, `id_users`, `id_kategori_produk`) VALUES ('$nama_produk','$gambar_produk','$deskripsi_produk','$nama_usaha','$id_users','$id_kategori_produk')";

  if ($api == $apikey) {
  	  if(mysqli_query($con,$sql)){
    	echo json_encode(array("value"=>1,"message"=>"Penambahan Produk Berhasil"));
	  }else{
	    echo json_encode(array("value"=>0,"message"=>"Penambahan Produk Gagal"));
	  }
  }else{
  	echo json_encode(array("value"=>0,"message"=>"API Key Token Salah"));
  }

  mysqli_close($con);

}