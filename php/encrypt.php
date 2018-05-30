<?php

include_once ('./password.php');

function AESencrypt($data) {
	$plaintext = $data;
	$method = 'aes-256-cbc';
	// $password is defined in password.php
	// $password = '...';    

	// Must be exact 32 chars (256 bit)
	$password = substr(hash('sha256', $password, true), 0, 32);

	// IV must be exact 16 chars (128 bit)
	$iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

	// encryption
	$encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));

	// My secret message 
	// $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);

	
	//echo "Hashed password:" . $password . "<br>";
	// echo 'plaintext=' . $plaintext . "<br>";
	// echo 'cipher=' . $method . "<br>";
	// echo 'encrypted to: ' . $encrypted . "<br>";
	// echo 'decrypted to: ' . $decrypted . "<br><br>";

	return $encrypted;

}