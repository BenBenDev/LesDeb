<!--
http://api.qrserver.com/v1/
doc http://goqr.me/api/doc/ -->
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Festival LES DÉBROUSSAILLEUSES</title>
		<meta name="description" content="Débroussailler : défricher, éclaircir ce qui est confus. 2 jours pour se débrousailler l'esprit !">
		<meta name="keywords" content="Trémentines, festival,concerts,Les ELLES,SURBOUM TORRIDE,FANFARES,EXPOS,ARTS EQUESTRES,IMPROMPTUS,La grange aux Arts,Photaumatic,SALON de TATOUAGE,MARCHÉ DE PRODUCTEURS,LECTURES,ATELIERS ENFANTS,The HORNY WACKERS,PROJECTIONS,DÉBATS CITOYENS,CONFÉRENCE GESTICULEE,Les Mutins de Pangée, Les chineurs de son">
		<link rel="icon" type="image/png" href="images/debr-ico2.png" />
		<meta property="og:url" content="http://lesdebroussailleuses.docteurparadi.com"/>
		<meta property="og:image" content="http://lesdebroussailleuses.docteurparadi.com/assets/banniere.png"/>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/BenBen_style.css" rel="stylesheet">

	</head>
	<body>

		<h3>QRcode</h3>
		<?php

		include_once('./image.php');
		include_once('./encrypt2.php');

		if (!isset($_POST['firstname']) ) {
			echo ("No data from the form (firstname is required). Can't process");
		} else {

			$firstname = htmlspecialchars($_POST['firstname']);
			$lastname= htmlspecialchars($_POST['lastname']);
			$email= htmlspecialchars($_POST['email']);
			$phone= htmlspecialchars($_POST['phone']);
			$nb_adults_sat= ($_POST['nb_adults_sat']);
			$nb_kids_sat= ($_POST['nb_kids_sat']);
			$nb_adults_sun= ($_POST['nb_adults_sun']);
			$nb_kids_sun= ($_POST['nb_kids_sun']);

			$firstname = ($firstname) ? $firstname : "no data";
			$lastname = ($lastname) ? $lastname : "no data";
			$email = ($email) ? $email : "no data";
			$phone = ($phone) ? $phone : "no data";
			$nb_adults_sat = ($nb_adults_sat) ? $nb_adults_sat : 0;
			$nb_kids_sat = ($nb_kids_sat) ? $nb_kids_sat : 0;
			$nb_adults_sun = ($nb_adults_sun) ? $nb_adults_sun : 0;
			$nb_kids_sun = ($nb_kids_sun) ? $nb_kids_sun : 0;
			$ecrypted_data = AESencrypt( $email . $phone . $firstname . $lastname . $nb_adults_sat . $nb_kids_sat . $nb_adults_sun . $nb_kids_sun);

			$pre_data = array(
				'firstname' => $firstname,
				'lastname' => $lastname,
				'email' => $email,
				'phone' => $phone,
				'nb_adults_sat' => $nb_adults_sat,
				'nb_kids_sat' => $nb_kids_sat,
				'nb_adults_sun' => $nb_adults_sun,
				'nb_kids_sun' => $nb_kids_sun,
				'security' => $ecrypted_data
			);

			$post_data = json_encode($pre_data);

		}

		if (file_exists('./image.php')) {
			//generation of QRcode + file name
			$suffix = time();      
			toQRcode($post_data, $suffix);
			//display of QRcode
			echo '<img src="../QRcodes/qr-'. $suffix .'.png" />';
		} else {
			echo 'No image generation...';
		}
		?>


		<p>end</p>
	</body>
