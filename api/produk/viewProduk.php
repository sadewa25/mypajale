<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];

  $sql = "SELECT produk.id_produk, produk.nama_produk, produk.gambar_produk, produk.deskripsi_produk, produk.nama_usaha, kategori_produk.nama_kategori_produk, users.nama_lengkap 
			FROM produk
			INNER JOIN kategori_produk ON kategori_produk.id_kategori_produk = produk.id_kategori_produk
			INNER JOIN users ON users.id_users = produk.id_users ORDER BY produk.id_produk DESC";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $res = mysqli_query($con,$sql);

  $result = array();

  if ($api == $apikey) {
    while($row = mysqli_fetch_array($res)){
      array_push($result, array('id_produk'=>$row[0], 'nama_produk'=>$row[1],'gambar_produk'=>$row[2],'deskripsi_produk'=>$row[3],
      	'nama_usaha'=>$row[4],'nama_kategori_produk'=>$row[5],'nama_lengkap'=>$row[6]));
    }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}