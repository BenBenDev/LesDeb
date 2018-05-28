<?php
echo ('image.php');


//   https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example
$url = 'https://api.qrserver.com/v1/create-qr-code/';
$data = array('ecc'=>'M', 'color'=>'FF0000', 'size' => '300x300', 'data' => "j'ai des données dans ce QRcode ;) ");

// use key 'http' even if you send the request to https://...
$options = array(
  'http' => array(
    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    'method'  => 'POST',
    'content' => http_build_query($data)
  )
);
$context  = stream_context_create($options);
// call to the API
$data = file_get_contents($url, false, $context);

if ($data){
  // string to GD resource
  $image = imagecreatefromstring ($data);
  //save resource to file
  imagepng($image,'../QRcodes/qr.png');
  //imagepng($image);
} else {
  echo('<p>Error : no image !</p>');
}
?>
