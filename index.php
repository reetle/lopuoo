<?php 

include_once("config.php");
session_start();
if(isset($_SESSION['userid'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['userid'] = $row['id'];
		header("Location: menu.php"); 	} 
		else {
		$error_message = "Vale email või parool";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" /> <!-- avab lehe seadme suurusega-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
   

<div class="container">
	
	<div class="row" style="margin-top:175px;" >
		<div class="col-7" id="login">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginform">
				<fieldset>	
                    <legend>Sisene</legend>
					<div class="form-group">
						<label for="name" >Email</label>
						<input type="text" name="email" placeholder="Sisesta email" required class="form-control" />
					</div>	
					<div class="form-group">
						<label for="name">Salasõna</label>
						<input type="password" name="password" placeholder="Sisesta salasõna" required class="form-control" />
					</div>	
					<div class="form-group">
						<input type="submit" name="login" value="Sisene" class="btn btn-sm"  style=" background-color: #99CCFF ;"/>
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
            
            
           <p> Ei ole kasutajat? <a href="register.php">Registreeri</a></p>
		</div>
	</div>

		
		

		
		
	
</div>
    </body>
</html>