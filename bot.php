<?php
$access_token = 'uJp+tDv/gAwRGmrb+xNTujrPMzJSHr7Q1zZbofzQrKjMSEb0x6hnkjjw+c3qcfUE6ry3lSUyh62EMG3RBCbYL45p07SXa4fhRH0qSumj69nX77mRG/cxLwRe1t1v3Xy5NbYSGiyf1h/hPp+BOtjGggdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
// 			$action = [
// 				'type' => 'uri',
// 				'label' => 'Call',
// 				'uri' => 'tel:027777777%2C0%2C%2C%23%2C2%2C1%2C2',
// 			];
			
			$area = [
				'x' => '0',
				'y' => '0',
				'width' => '300',
				'height' => '300',
 			];
			
			$action = [
				'type' => 'uri',
				'linkUri' => 'tel:027777777%2C0%2C%2C%23%2C2%2C1%2C2:,
				'area' => $area,
			];
			
// 			$action = [
// 				'type' => 'message',
// 				'label' => 'No',
// 				'text' => 'no',
// 			];
// 			$action2 = [
// 				'type' => 'message',
// 				'label' => 'Yes',
// 				'text' => 'yes',
// 			];
			
			$baseSize = [
				'height' => '300',
				'width' => '300',
			];
			
			$template = [
				'type' => 'confirm',
				'text' => 'Please select',
				
				
			];
			
			
			// Build message to reply back
			$messages = [
				'type' => 'imagemap',
				'baseUrl' => 'https://raw.githubusercontent.com/nutdanaigit/LINE-BOT-PHP-Starter/master',
				'altText' => 'this is a buttons template',
				'baseSize' => $baseSize,
				'actions' => [$action],
				
// 				'template' => $template,
// 				'packageId' => '1',
// 				'stickerId' => '1',
	
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK325";
