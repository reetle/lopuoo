<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>

<title>Lisa autor</title>
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
		<label for="nimi" class="col-2 col-form-label" >Nimi</label>
        <div class="col-10">
		<input type="text" name="nimi" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
        
        <div class="form-group row">
		<label for="eesnimi" class="col-2 col-form-label" >Eesnimi</label>
        <div class="col-10">
		<input type="text" name="eesnmini" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
       <div class="form-group row">
		<label for="eluaastad" class="col-2 col-form-label" >Eluaastad</label>
        <div class="col-10">
		<input type="text" name="eluaastad" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
		<div class="form-group row">
		<label for="rahvus" class="col-2 col-form-label" >Rahvus</label>
        <div class="col-10">
		<input type="text" name="rahvus" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
		
        <div class="form-group row">
		<label for="markused" class="col-2 col-form-label" >Märkused</label>
        <div class="col-10">
		<input type="text" name="markused" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
	

    <div class="form-group row">  
		<input type="submit" name="Submit" value="Lisa" class="btn btn-info">
          </div>
    </fieldset>
	</form>
    <?php
    if(isset($_POST['Submit'])){	 
        $nimi =  mysqli_real_escape_string($conn, $_POST['nimi']);	
		$eesnimi = mysqli_real_escape_string($conn, $_POST['eesnimi']);	
		$eluaastad = mysqli_real_escape_string($conn, $_POST['eluaastad']);	
		$rahvus =  mysqli_real_escape_string($conn, $_POST['rahvus']);	
		 $markused  =  mysqli_real_escape_string($conn, $_POST['markused']);	
    
	$result = mysqli_query($conn, "INSERT INTO autor (nimi, eesnimi, eluaastad, rahvus, markused) 
     VALUES('$nimi','$eesnimi','$eluaastad','$rahvus','$markused')");
	
		echo " <p>Lisatud </p>";
	}
         mysqli_close($conn);
	?>
</div>
<div class="row">
               <div class="col-2" style="margin-top:30px; margin-left:-35px;">
              
<a href="author_data.php" class="btn btn-info" role="button">Tagasi</a>
</div>
</div></div>
</body>
</html>