<?php 

include_once("config.php");
//https://webdamn.com/login-and-registration-script-with-php-mysql/
session_start();
if(isset($_SESSION['userid'])) {
	header("Location: index.php");
}
$error = false;
if (isset($_POST['signup'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$uname_error = "Sobimatu nimi";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Vale email";
	}
	if(strlen($password) < 8) {
		$error = true;
		$password_error = "Salasõna peab olema vähemalt 8 tähemärki pikk";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Salasõnad ei kattu";
	}
	if (!$error) {
		if(mysqli_query($conn, "INSERT INTO users(user, email, pass) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
			$success_message = "Uus kasutaja loodud <a href='index.php'>Sisene</a>";
		} else {
			$error_message = "Ups, midagi läks valesti proovi hiljem uuesti.";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Registreeri</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
<meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" /> <!-- avab lehe seadme suurusega-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


</head>
  
<body>
<div class="container">
	<div class="row" style="margin-top:25px;" >
		<div class="col-7" id="login" >
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginform">
				<fieldset>
					<legend>Registreeri</legend><br>

					<div class="form-group">
						<label for="name">Nimi</label>
						<input type="text" name="name" placeholder="Ees- ja perekonnanimi" required value="<?php if($error) echo $name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Salasõna</label>
						<input type="password" name="password" placeholder="Salasõna" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Korda salasõna</label>
						<input type="password" name="cpassword" placeholder="Korda salasõna" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Loo kasutaja" class="btn  btn-sm" style=" background-color: #99CCFF ;" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>

		  <p>Oled juba kasutaja? <a href="index.php" >Sisene</a></p>
		</div>
	</div>	

</div>
    </body>
</html>