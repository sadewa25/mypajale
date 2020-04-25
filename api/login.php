<?php

require_once('konek.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

  $email_user = $_POST['email_user'];
  $password_user = md5($_POST['password_user']);

  $sql = "SELECT `id_users`, `email_user`, `id_status_users` FROM `users` WHERE `email_user` = '$email_user' AND `password_user` = '$password_user'";

  $res = mysqli_query($con,$sql);

  $result = array();

  while($row = mysqli_fetch_array($res)){
    array_push($result, array('id_users'=>$row[0], 'email_user'=>$row[1], 'id_status_users'=>$row[2]));
  }

  if(empty($result)){
    echo json_encode(array("value"=>0,"result"=>$result));
  }else{
    echo json_encode(array("value"=>1,"result"=>$result));
  }

  mysqli_close($con);

}