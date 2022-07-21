<?php

function sendPushNotificationToGCM($tokenId, $notification) {
			
		//$registatoin_ids = array($tokenId);
		$registatoin_ids =array($tokenId);
		
		//echo "<pre>"; print_r($registatoin_ids); die;
		$url = 'https://fcm.googleapis.com/fcm/send';

		$fields = array (
				'registration_ids' => $registatoin_ids,
				'data' => $notification
		);
		//echo "<pre>"; print_r($fields); die;
	   $fields = json_encode ( $fields );
		//echo "<pre>"; print_r($fields); 
		$headers = array (
				'Authorization: key=' ."AAAAwEqJZFk:APA91bEZ-mPmCFo24wFiIVLzAOCJb0OqkiTqXG5GTDazHkiFZzvMoaSxYRNzi4-0gwuWhXLc4Jgd6_jBWpGH8w7KOo_BpQrbMAIttxQfQKK_qJZhaPe8M1HmcBHY_0K2hOYXLK_P9mVs",
				'Content-Type: application/json'
		);

		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec ( $ch );
		if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
		echo $result.'<br/>'; die;
		//echo "Notification sent.";
		$result1 = json_decode($result);
		//echo "<pre>"; print_r($result1); die;
		curl_close ( $ch );
	}