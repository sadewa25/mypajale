<?php defined('BASEPATH') OR exit('No direct script access allowed');

  include 'functions.php';

  class UsersModel extends CI_Model {

    function getUsers($username_user, $password_user)
    {
      // echo $username_user.$password_user;
      // $result = http_request("http://mypajale.id/apimypajale/api/users/select.php");
      // $result = json_decode($result, TRUE);
      // return $result;
      $data = [
              'username_user' => $username_user,
              'password_user' => $password_user
            ];
     $curl = curl_init('http://mypajale.id/apimypajale/api/users/login.php');
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     $response = curl_exec($curl);
     curl_close($curl);
     return json_decode($response);
    }
  }
