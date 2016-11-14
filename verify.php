<?php
$access_token = 'uJp+tDv/gAwRGmrb+xNTujrPMzJSHr7Q1zZbofzQrKjMSEb0x6hnkjjw+c3qcfUE6ry3lSUyh62EMG3RBCbYL45p07SXa4fhRH0qSumj69nX77mRG/cxLwRe1t1v3Xy5NbYSGiyf1h/hPp+BOtjGggdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
