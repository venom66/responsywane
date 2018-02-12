<?php

session_start();

$errors = [];

if(isset ($_POST['nick'], $_POST['email'], $_POST['mess']))
{
	$fields = [
	'nick' => $_POST['nick'],
	'email' => $_POST['email'],
	'mess' => $_POST['mess']
	];
	
	foreach ($fields as $field => $data) 
	{
		if(empty($data))
		{
			$errors[] = 'pole '.$field.' jest wymagane.';			
		}
	
	}
	
	
	if(empty($errors))
	{
		/*
		$m = new PHPMailer;
		
		$m->isSMTP();
		$m->SMTPAuth = true;
		
		$m->SMTPDebug = 1;
		
		$m->Host = 'smtp.gmail.com';
		$m->Username = 'bdobrosielski@edu.cdv.pl';
		$m->Password = 'Cashmoney1';
		$m->SMTPSecure = 'ssl';
		$m->Port=465;
		
		$m->isHTML();
		
		$m->Subject = 'formulaz kontaktowy';
		$m->Body = 'Form: ' . $fields['nick'] . ' (' . $fields['email']. ' ) <p>' . $fields ['mess']. '</p>';
		
		$m->FromName = 'Kontakt';
		$m->AddAddress ('bdobrosielski@edu.cdv.pl', 'bd');
		
		if($m->send())
		{
			require_once "connect.php";

			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
				if($polaczenie->query("INSERT INTO message VALUES (NULL, 'nick', 'email', 'mess')"))
				{
				header('Location: thanks.php');
				$polaczenie->close();
				break;
				}
				
		}else
		{
			echo "cos poszlo nie tak";
		}
		$polaczenie->close();
	}
	*/
			$nick=$fields['nick'];
			$email=$fields['email'];
			$mess=$fields['mess'];
		
			
			require_once "../connect.php";

			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
				if($polaczenie->query("INSERT INTO message VALUES (NULL, '$nick', '$email', '$mess')"))
				{
				
							
							require_once '../PHPMailer/PHPMailerAutoload.php';
							
						
							$mail = new PHPMailer;

							//$mail->SMTPDebug = 3;                               // Enable verbose debug output

							$mail->isSMTP();                                      // Set mailer to use SMTP
							$mail->Host = 'mail.k.lapy.pl';  					// Specify main and backup SMTP servers
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = 'noreplay@k.lapy.pl';                 // SMTP username
							$mail->Password = 'honey6';                           // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 587;                                    // TCP port to connect to

							$mail->setFrom('noreplay@k.lapy.pl', 'Mailer');
							$mail->addAddress($fields['email'], $nick);     // Add a recipient // tu zmienialem
							$mail->addAddress();               // Name is optional
							$mail->addReplyTo('g8824@wp.pl', 'Information');
							$mail->addCC('cc@example.com');
							$mail->addBCC('bcc@example.com');

							$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
							$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'formularz kontaktu';
							$mail->Body    = 'Form: ' . $fields['nick'] . ' (' . $fields['email']. ' ) <p>' . $fields ['mess']. '</p>';;
						
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
							

							if(!$mail->send()) 
							{
								echo 'message could not be sent.';
								echo 'Mailer Error: ' . $mail->ErrorInfo;
							} else 
								{
								echo 'message has been sent';
								header('Location: thanks.php');
								break;
								}
			
	
	
	
}
$polaczenie->close();
}


$_SESSION['errors']= $errors;
$_SESSION['fields']= $fields;



header('Location: kontaktf.php');

//session_unset();
}
?>