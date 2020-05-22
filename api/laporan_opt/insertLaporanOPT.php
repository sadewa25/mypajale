<?php

require_once('../konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $id_user = $_POST['id_user'];
  $judul_laporan = $_POST['judul_laporan'];
  $id_penyakit = $_POST['id_penyakit'];
  $id_kab = $_POST['id_kab'];
  $id_kec = $_POST['id_kec'];
  $desa = $_POST['desa'];
  $nama_kelompok_tani = $_POST['nama_kelompok_tani'];
  $id_jenis_tanaman = $_POST['id_jenis_tanaman'];
  $varietas = $_POST['varietas'];
  $umur = $_POST['umur'];
  $intensitas_serangan = $_POST['intensitas_serangan'];
  $luas_terserang = $_POST['luas_terserang'];
  $luas_hamparan = $_POST['luas_hamparan'];
  $gambar = $_POST['gambar'];
  $tanggal = $_POST['tanggal'];
  $jenis_musuh_alami = $_POST['jenis_musuh_alami'];
  $kesimpulan = $_POST['kesimpulan'];
  $rekomendasi = $_POST['rekomendasi'];
  $apikey = $_POST['api_key'];



  $api = "b245fa2b067cae97fff0d626d3b3197e";


  $sql = "INSERT INTO `laporan_opt`(`id_user`, `judul_laporan`, `id_penyakit`, `id_kab`, `id_kec`, `desa`, `nama_kelompok_tani`, `id_jenis_tanaman`, `varietas`, `umur`, `intensitas_serangan`, `luas_terserang`, `luas_hamparan`, `gambar`, `tanggal`, `jenis_musuh_alami`, `kesimpulan`, `rekomendasi`) VALUES ('$id_user','$judul_laporan','$id_penyakit','$id_kab','$id_kec','$desa','$nama_kelompok_tani','$id_jenis_tanaman','$varietas','$umur','$intensitas_serangan','$luas_terserang','$luas_hamparan','$gambar','$tanggal','$jenis_musuh_alami','$kesimpulan','$rekomendasi')";

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