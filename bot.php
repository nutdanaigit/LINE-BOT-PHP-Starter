<?php
$access_token = 'uJp+tDv/gAwRGmrb+xNTujrPMzJSHr7Q1zZbofzQrKjMSEb0x6hnkjjw+c3qcfUE6ry3lSUyh62EMG3RBCbYL45p07SXa4fhRH0qSumj69nX77mRG/cxLwRe1t1v3Xy5NbYSGiyf1h/hPp+BOtjGggdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

$arrayWebInformation = array('1','web','Web','เว็บ','เว็บไซต์');
$arrayPhone = array('2','May i have numberphone please?','phone','Phone','phone please','Phone Please','เบอร์','ขอเบอร์','ขอเบอร์หน่อย','ติดต่อพนักงาน','โทร','หมายเลข','เบอร์โทร','ขอเบอร์โทร','ขอเบอร์โทรครับ','ขอบเบอร์โทรค่ะ','เบอร์โทรครับ');
$arrayInformation = array('Information','information','ขอข้อมูล','ข้อมูล','สอบถามข้อมูลเพิ่มเติม','รายละเอียด','#');

		function ImageMap(){
				$area = [
					'x' => 0,
					'y' => 0,
					'width' => 460,
					'height' => 300
 				];
				
				$areaTwo = [
					'x' => 0,
					'y' => 300,
					'width' => 460,
					'height' => 100
 				];
				$action = [
					'type' => 'uri',
					'linkUri' => 'http://scbhelp.mybluemix.net',
					'area' => $area
				];
				$actionTwo =[
					'type' => 'message',
					'text' => 'Click To WebSite',
					'area' => $areaTwo
					];
				$baseSize = [
					'height' => 460,
					'width' => 460
				];
				// Build message to reply back
				return $messages = [
					'type' => 'imagemap',
					'baseUrl' => 'https://raw.githubusercontent.com/nutdanaigit/LINE-BOT-PHP-Starter/master',
					'altText' => 'this is a buttons template',
					'baseSize' => $baseSize,
					'actions' => [$action,$actionTwo]
				];
			}
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
			
			if(in_array($event['message']['text'] ,$arrayPhone)){
				$action = [
					'type' => 'uri',
					'label' => 'Call',
					'uri' => 'tel:027777777%2C0%2C%2C%23%2C2%2C1%2C2',
				];
				$template = [
					'type' => 'confirm',
					'text' => 'Please select',
					'actions' => [$action]
				];
				$messages = [
					'type' => 'template',
					'altText' => 'this is a confirm template',
					'template' => $template
				];
			}else if(in_array($event['message']['text'] ,$arrayWebInformation)){
					$ImageMap();
				
			}else if(in_array($event['message']['text'] ,$arrayInformation)){
				$messages = [
					'type' => 'text',
					'text' => ' รายการ
--> พิมพ์ 1 หรือ web หรือ เว็บ เพื่อเข้าดูข้อมูลที่เว็ปไซต์ค่ะ  
--> พิมพ์ 2 หรือ phone หรือ เบอร์ เพื่อโทรออกค่ะ '
				];
			}else if(in_array($event['message']['text'],'Click To WebSite' )){
				// Do in the future.
					$message = $ImageMap();
			}else{
				$messages = [
					'type' => 'text',
					'text' => 'ขออภัยครับ ท่านใส่รายการไม่ถูกต้อง T T  
--> กรุณาพิมพ์ "#" หรือ "รายละเอียด" เพื่อดูรายการค่ะ '
				];
			}


			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages]
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
echo "OK3";
?>
