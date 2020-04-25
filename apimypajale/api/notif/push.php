<?php
    $ch = curl_init();
  	$headers  = [
  	            'Authorization: key=AAAAg8GMOfI:APA91bHF_0l9en25oTPW506qVCYHhMtxcV2diTpM5dPLESXyKjEHkdJLgBV4FZ4Nc6jnWxT33SRS2aFCjfm3p7G_2Ax25eB_pP9yz4Gx9fsq8Y0p1Fxqrthg0714Cpk0wOGOvImdB4nS',
  	            'Content-Type: application/json'
  	        ];
    $notification = [
  		"body" => $_POST['message'],
  		"title"=> $_POST['title'],
  		"priority"=>"high"
  	];

  	$postData = [
  	    'to' => '/topics/global',
  	    'notification' => $notification
  	];

  	curl_setopt($ch, CURLOPT_URL,"https://fcm.googleapis.com/fcm/send");
  	curl_setopt($ch, CURLOPT_POST, 1);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
  	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  	$result     = curl_exec ($ch);
  	$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
?>
