<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Lisa klass</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body> 

 <div class="container">  
      <div class="row" >
    <form method="post" action=" " class="form-inline" style="margin-top:15px;">
                <fieldset>
                    
        <div class="form-group row">
		<label for="klass" class="col-3 col-form-label" >Klass</label>
        <div class="col-9">
		<input type="text" name="klass" required class="form-control form-control-sm" style="width:100%;" >
	    </div> </div>
        
		<div class="form-group row">
		<label for="taht" class="col-3 col-form-label" >Täht</label>
        <div class="col-9">
		<input type="text" name="taht" required class="form-control form-control-sm" style="width:100%;" >
        </div> </div>
        
			<div class="form-group row">
		<label for="klassijuhataja" class="col-3 col-form-label" >Klassijuhataja</label>
        <div class="col-9">
		<input type="text" name="klassijuhataja" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
        
			<div class="form-group row">
		<label for="klassiruum" class="col-3 col-form-label" >Klassiruum</label>
        <div class="col-9">
		<input type="text" name="klassiruum" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
        
				<div class="form-group row">
		<label for="markused" class="col-3 col-form-label" >Märkused</label>
        <div class="col-9">
		<input type="text" name="markused" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
                    
	  <div class="form-group row">  
		<input type="submit" name="Submit" value="Lisa" class="btn btn-info">
          </div>
    </fieldset>
	</form>

	<?php
	if(isset($_POST['Submit'])) {
		$klass = mysqli_real_escape_string($conn, $_POST['klass']);
		$taht = mysqli_real_escape_string($conn, $_POST['taht']);
		$klassijuhataja = mysqli_real_escape_string($conn, $_POST['klassijuhataja']);
		$klassiruum = mysqli_real_escape_string($conn, $_POST['klassiruum']);
		$markused = mysqli_real_escape_string($conn,  $_POST['markused']);
	
	$result = mysqli_query($conn, "INSERT INTO klass(klass, taht, klassijuhataja, klassiruum, markused) 
	VALUES('$klass','$taht','$klassijuhataja','$klassiruum','$markused')");
		echo "Lisatud";	}
	?>
</div>
<div class="row">
               <div class="col-2" style="margin-top:30px; margin-left:-35px;">
              
<a href="class_data.php" class="btn btn-info" role="button">Tagasi</a>
</div>
</div></div>
</body>
</html>