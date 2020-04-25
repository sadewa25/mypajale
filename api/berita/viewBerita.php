<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];

  $sql = "SELECT berita.id_berita, berita.judul_berita, berita.deskripsi_berita,berita.tgl_berita, berita.gambar_berita, users.nama_lengkap
        FROM berita
        INNER JOIN users ON users.id_users = berita.id_users ORDER BY berita.id_berita DESC";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $res = mysqli_query($con,$sql);

  $result = array();

  if ($api == $apikey) {
    while($row = mysqli_fetch_array($res)){
      array_push($result, array('id_berita'=>$row[0], 'judul_berita'=>$row[1],'deskripsi_berita'=>$row[2],'tgl_berita'=>$row[3],'gambar_berita'=>$row[4],'nama_lengkap'=>$row[5]));
    }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}