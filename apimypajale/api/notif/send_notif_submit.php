<?PHP
	function sendMessage($email,$title){

		$content = array(
			"en" => $title
			);

		$fields = array(
			'app_id' => "a1e9a3db-3d2f-467a-910b-924e651a893a",
			'headings' => array('en' => "Laporan OPT Baru"),
			'filters' => array(array("field" => "email", "value" => $email)),
			'contents' => $content
		);

		$fields = json_encode($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MDc0NTE1NTctNWFmZC00Yjk3LWJlYjYtMjI0YzUxNzdhOTlj'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

   	$title = $_POST['title'];
		$id_users = $_POST['id_users'];

		// sendMessage('196308121987021001@gmail.com',$title);

		require_once '../../dbhelper/connection.php';

		$sql = "SELECT `id_koordinator` FROM `users` WHERE `id_users` = ?";
		$stmt = $dbh->prepare($sql);
		$stmt->execute([$id_users]);

		$sqlFour = "SELECT `id_koordinator` FROM `users` WHERE `id_status_users` = 4";
		$stmtFour = $dbh->prepare($sqlFour);
		$stmtFour->execute();
		// $res = mysqli_query($dbh, $sql);
		//print_r($stmt->fetchAll());
    $result = array();
    while($row = $stmt->fetchAll()){
			$text = $row[0][0].'@gmail.com';
			//echo $text;
     	$response = sendMessage($text,$title);
    }
		$resultFour = array();
    while($rowFour = $stmtFour->fetchAll()){
			$textFour = $rowFour[0][0].'@gmail.com';
			//echo $text;
     	$responseFour = sendMessage($textFour,$title);
    }
		$return = array();
		$return["result"] = [$response, $responseFour];
		echo json_encode($return);
	}
?>
