<?php

/* set your database credentials here */
$db_host = "localhost";
$db_name = "mesibo_sample";         
$db_user = "sadewa";           
$db_pass = "M4njaddawajadda!";     

/* Signup to https://mesibo.com to get your app token */
$mesibo_app_token = '6d263otn89o094ynue0rtuqz2o4fphrftnlni0wvs9u5joco651x8f9muo8wat2z';

if($db_host == '' || $db_name == '' || $db_user == '' || $db_pass == '' || $mesibo_app_token == '') {
	echo "ERROR: DB or mesibo app token is not set";
	exit;
}
	
define("FILES_FOLDER", "../demofiles");


