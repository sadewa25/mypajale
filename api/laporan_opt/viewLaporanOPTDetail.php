<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $apikey = $_POST['api_key'];
  $id_laporan_opt = $_POST['id_laporan_opt'];

  $sql = "SELECT
        laporan_opt.id_laporan_opt,
        kabupaten.nama AS kabupaten,
        kecamatan.nama AS kecamatan,
        laporan_opt.judul_laporan,
        users.nama_lengkap,
        jenis_tanaman.nama_jenis_tanaman,
        laporan_opt.desa,
        penyakit.NAMA_PENYAKIT,
        laporan_opt.nama_kelompok_tani,
        laporan_opt.varietas,
        laporan_opt.umur,
        laporan_opt.intensitas_serangan,
        laporan_opt.luas_terserang,
        laporan_opt.luas_hamparan,
        laporan_opt.gambar,
        laporan_opt.tanggal,
        laporan_opt.jenis_musuh_alami,
        laporan_opt.kesimpulan,
        laporan_opt.rekomendasi,
        laporan_opt.id_penyakit,
        laporan_opt.id_kab,
        laporan_opt.id_kec,
        laporan_opt.id_jenis_tanaman,
        laporan_opt.gambar
        FROM
        laporan_opt
        INNER JOIN kabupaten ON laporan_opt.id_kab = kabupaten.id_kab
        INNER JOIN kecamatan ON laporan_opt.id_kec = kecamatan.id_kec
        INNER JOIN jenis_tanaman ON laporan_opt.id_jenis_tanaman = jenis_tanaman.id_jenis_tanaman
        INNER JOIN users ON users.id_users = laporan_opt.id_user
        INNER JOIN penyakit ON laporan_opt.id_penyakit = penyakit.ID_PENYAKIT
        WHERE laporan_opt.id_laporan_opt = '$id_laporan_opt'
        ";

  $api = "b245fa2b067cae97fff0d626d3b3197e";
  $res = mysqli_query($con,$sql);

  $result = array();

  if ($api == $apikey) {
    while($row = mysqli_fetch_array($res)){
      array_push($result, array(
        'id_laporan_opt'=>$row[0], 'kabupaten'=>$row[1],'kecamatan'=>$row[2],'judul_laporan'=>$row[3],'nama_lengkap'=>$row[4],'nama_jenis_tanaman'=>$row[5],
        'desa'=>$row[6], 'nama_penyakit'=>$row[7],'nama_kelompok_tani'=>$row[8],'varietas'=>$row[9],'umur'=>$row[10],'intensitas_serangan'=>$row[11],
        'luas_terserang'=>$row[12], 'luas_hamparan'=>$row[13],'gambar'=>$row[14],'tanggal'=>$row[15],'jenis_musuh_alami'=>$row[16],'kesimpulan'=>$row[17],'rekomendasi'=>$row[18],
        'id_penyakit'=>$row[19], 'id_kab'=>$row[20],'id_kec'=>$row[21],'id_jenis_tanaman'=>$row[22],'gambar'=>$row[23]
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