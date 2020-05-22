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

  $id_laporan_opt = $_POST['id_laporan_opt'];


  $api = "b245fa2b067cae97fff0d626d3b3197e";


  $sql = "UPDATE `laporan_opt` SET `id_user`='$id_user',`judul_laporan`='$judul_laporan',`id_penyakit`='$id_penyakit',`id_kab`='$id_kab',`id_kec`='$id_kec',`desa`='$desa',`nama_kelompok_tani`='$nama_kelompok_tani',`id_jenis_tanaman`='$id_jenis_tanaman',`varietas`='$varietas',`umur`='$varietas',`intensitas_serangan`='$intensitas_serangan',`luas_terserang`='$luas_terserang',`luas_hamparan`='$luas_hamparan',`gambar`='$gambar',`tanggal`='$tanggal',`jenis_musuh_alami`='$jenis_musuh_alami',`kesimpulan`='$kesimpulan',`rekomendasi`='$rekomendasi' WHERE `id_laporan_opt` = '$id_laporan_opt' ";

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