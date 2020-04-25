<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_tips = $_POST['id_tips'];

  $sql = "SELECT tips.id_tips, tips.judul_tips, tips.id_users, tips.deskripsi_tips, tips.id_kategori_tips, kategori_tips.nama_kategori_tips, users.nama_lengkap,tips.gambar_tips
		FROM tips, users, kategori_tips
		WHERE tips.id_tips = kategori_tips.id_kategori_tips AND tips.id_users = users.id_users AND tips.id_tips = '$id_tips' ";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $result = array();
  if ($api == $apikey) {
  	  $res = mysqli_query($con,$sql);
	  while($row = mysqli_fetch_array($res)){
	    array_push($result, array('id_tips'=>$row[0], 'judul_tips'=>$row[1], 'id_users'=>$row[2],'deskripsi_tips'=>$row[3],'id_kategori_tips'=>$row[4],'nama_kategori_tips'=>$row[5],
        'nama_lengkap'=>$row[6],'gambar_tips'=>$row[7]
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