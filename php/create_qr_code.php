<?php
// http://api.qrserver.com/v1/
// doc http://goqr.me/api/doc/

https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example

$url = 'https://api.qrserver.com/v1/create-qr-code/';
$data = array('ecc'=>'M', 'color'=>'FF0000', 'size' => '300x300', 'data' => 'value2');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
base64_encode($result);
$data = base64_encode($result);

list($type, $data) = explode(';', $data);
$data = base64_decode($data);

file_put_contents('/tmp/image.png', $data);

var_dump($result);
