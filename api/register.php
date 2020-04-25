<?php

if($_SERVER['REQUEST_METHOD']=='POST') {

   $response = array();
   //mendapatkan data
   $nama_lengkap = $_POST['nama_lengkap'];
   $email_user = $_POST['email_user'];
   $password_user = md5($_POST['password_user']);
   $telephone_user = $_POST['telephone_user'];
   $profesi = $_POST['profesi'];
   $kabupaten = $_POST['kabupaten'];
   $kecamatan = $_POST['kecamatan'];
   $alamat = $_POST['alamat'];
   $id_status_users = $_POST['id_status_users'];


   require_once('konek.php');

   $sql2 = "SELECT `id_users`, `email_user`, `id_status_users` FROM `users` WHERE `email_user` = '$email_user'";
   $res = mysqli_query($con,$sql2);

   $result = array();

   while($row = mysqli_fetch_array($res)){
     array_push($result, array('id_users'=>$row[0], 'email_user'=>$row[1], 'id_status_users'=>$row[2]));
   }

   if(empty($result)){
     $sql = "INSERT INTO `users`(`nama_lengkap`, `email_user`, `password_user`, `telephone_user`, `profesi`, `kabupaten`, `kecamatan`, `alamat`, `id_status_users`) VALUES ('$nama_lengkap','$email_user','$password_user','$telephone_user','$profesi','$kabupaten','$kecamatan','$alamat','$id_status_users')";

	 if(mysqli_query($con,$sql)) {
	   $response["value"] = 1;
	   $response["message"] = "Sukses mendaftar";
	   echo json_encode($response);
	 } else {
	   $response["value"] = 0;
	   $response["message"] = "oops! Coba lagi!";
	   echo json_encode($response);
	 }
   }
   //Email Sudah terdaftar
   else{
    echo json_encode(array("value"=>0,"message"=>"Email Sudah Terdaftar","result"=>$result));
   }
   
   // tutup database
   mysqli_close($con);
} else {
  $response["value"] = 0;
  $response["message"] = "oops! Coba lagi!";
  echo json_encode($response);
}