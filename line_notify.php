<?php

$url = 'https://notify-api.line.me/api/notify';
		$token      = "n1SoD4vgfekL9P153zMhTOGralrMeJilKQ8ZO7T5Fnv";
		$headers    = [
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Bearer '.$token
			];
			

		$fields     = "message=  test message ";

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec( $ch );
		curl_close( $ch );

		var_dump($result);
		$result = json_decode($result,TRUE);


?>