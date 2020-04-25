<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];

  $sql = "SELECT laporan_opt.id_laporan_opt, kabupaten.nama as 'kabupaten', kecamatan.nama as 'kecamatan', laporan_opt.judul_laporan, users.nama_lengkap, jenis_tanaman.nama_jenis_tanaman
    FROM laporan_opt
    INNER JOIN kabupaten ON laporan_opt.id_kab = kabupaten.id_kab
    INNER JOIN kecamatan ON laporan_opt.id_kec = kecamatan.id_kec
    INNER JOIN jenis_tanaman ON laporan_opt.id_jenis_tanaman = jenis_tanaman.id_jenis_tanaman
    INNER JOIN users ON users.id_users = laporan_opt.id_user ORDER BY laporan_opt.id_laporan_opt DESC";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $res = mysqli_query($con,$sql);

  $result = array();

  if ($api == $apikey) {
    while($row = mysqli_fetch_array($res)){
      array_push($result, array('id_laporan_opt'=>$row[0], 'kabupaten'=>$row[1],'kecamatan'=>$row[2],'judul_laporan'=>$row[3],'nama_lengkap'=>$row[4],'nama_jenis_tanaman'=>$row[5]));
    }
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}