<?php
session_start();

require_once 'security.php';


$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];

?>



<!DOCTYPE HTML>

<html lang="pl">
<head>
<meta charset="utf-8" />
	<title> kontakt </title>
	<meta name="description" content="JA" />
	<meta name="keywords" content="coding" />
	<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />

<link rel="stylesheet" href="../style.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" 
	rel="stylesheet" type='text/css'> 
	
<style>

body 
{
	background-image: back.jpg;
	background-repeat: no-repeat;
}



</style>
	
</head>

	<body>

				<div class="contact">

					<?php if(!empty($errors)): ?>
					<div class="panel">
					wystapiły błędy przy wysłaniu wiadomości:
					<div class="eror">
					<ul>
					<li> <?php echo implode('</li><li>', $errors); ?> </li>
					</ul>
					</div>
					</div>
					<?php endif; ?>


							<form action="contact.php" method="post">
							
									<label>
									nick:* <br/> <input type="text" name="nick" autocomplite="off"<?php echo isset($fields['nick']) ? ' value="' .e($fields['nick']). '"' : ' ' ?>> 
									</label>
									<label>	
									e-mail:* <br/> <input type="e-mail" name="email" autocomplite="off"<?php echo isset($fields['email']) ? ' value="' .e($fields['email']). '"' : ' ' ?>>
									</label>
									<label>
									wiadomosc(mess):* 
									<textarea name="mess" rows="10"><?php echo isset($fields['mess']) ? e($fields['mess']) : '' ?></textarea> 
									</label>

									<input type="submit" value="wyslij" />

									<p class="muted"> * pola wymagane </p>



							</form>
					</div>
	</body>

<?php 

unset($_SESSION['errors']);
unset($_SESSION['fields']);

?>

</html>