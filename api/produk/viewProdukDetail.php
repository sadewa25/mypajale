<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_produk = $_POST['id_produk'];

  $sql = "SELECT
	produk.id_produk,
	produk.nama_produk,
	produk.gambar_produk,
	produk.deskripsi_produk,
	produk.nama_usaha,
	produk.id_users,
	produk.id_kategori_produk,
	users.nama_lengkap,
	kategori_produk.nama_kategori_produk
	FROM
	produk
	INNER JOIN users ON users.id_users = produk.id_users
	INNER JOIN kategori_produk ON kategori_produk.id_kategori_produk = produk.id_kategori_produk WHERE id_produk = '$id_produk' ";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $res = mysqli_query($con,$sql);

  $result = array();

  if ($api == $apikey) {
    while($row = mysqli_fetch_array($res)){
      array_push($result, array(
        'id_produk'=>$row[0], 'nama_produk'=>$row[1],'gambar_produk'=>$row[2],'deskripsi_produk'=>$row[3],'nama_usaha'=>$row[4],'id_users'=>$row[5],
        'id_kategori_produk'=>$row[6], 'nama_lengkap'=>$row[7],'nama_kategori_produk'=>$row[8]
      ));
    }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}