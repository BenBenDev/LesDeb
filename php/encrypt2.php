<?php

include_once ('password.php');


function AESencrypt($data) {

	$plaintext = $data;
	$method = 'AES-256-CBC';
	$key = getPswd();
	// $password is defined in password.php
	// Must be exact 32 chars (256 bit)
	// $password = '...';    

	// IV must be exact 16 chars (128 bit)
	$iv = substr($key, 0, 16);

	// encryption
	$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));
	
	// https://developer.mozilla.org/fr/docs/D%C3%A9coder_encoder_en_base64
	// https://stackoverflow.com/questions/33402956/aes-256-encryption-php-with-padding
	// https://www.davidebarranca.com/2012/10/crypto-js-tutorial-cryptography-for-dummies/
	
	// My secret message 
	$decrypted = openssl_decrypt($encrypted, $method, $key, OPENSSL_RAW_DATA, $iv);


	echo "key:" . $key . "<br>";
	echo "iv:" . $iv . "<br>";
	echo 'plaintext=' . $plaintext . "<br>";
	echo 'cipher=' . $method . "<br>";
	echo 'encrypted to: ' . $encrypted . "<br>";
	echo 'decrypted to: ' . $decrypted . "<br><br>";

	return $encrypted;

}