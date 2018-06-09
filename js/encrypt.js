$(document).ready(function(){

	$('#formulaire').submit(function(e){
		event.preventDefault();


	//var string = 'asso.grangeauxarts@gmail.com617161639testtest0000';
	var securitystring = 
			$('#email').val()+
			$('#phone').val()+
			$('#firstname').val()+
			$('#lastname').val()+
			$('#nb_adults_sat').val()+
			$('#nb_kids_sat').val()+
			$('#nb_adults_sun').val()+
			$('#nb_kids_sun').val();

 			

	var password = 'imieimieimieimieimieimieimieimie';
	iv="imieimieimieimie";

	var encrypted = CryptoJS.AES.encrypt(securitystring, password, { iv: iv });
	console.log(encrypted.toString());
	// will output something like:
	// U2FsdGVkX1/l/LqNSCQixd0iPv4neKAGZvbQDbYUovZE4OcM7l3ULNDgkZQmrweN

	var decrypted = CryptoJS.AES.decrypt(encrypted, password, { iv: iv });
	console.log('with iv');
	console.log(decrypted.toString(CryptoJS.enc.Utf8));
	
		$('#security').val(encrypted);

		 event.currentTarget.submit();
	});

});

