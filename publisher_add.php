<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>

<title>Lisa Väljaandja</title>
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
		<label for="aadress" class="col-2 col-form-label" >Aadress</label>
        <div class="col-10">
		<input type="text" name="aadress" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
		<div class="form-group row">
		<label for="linn" class="col-2 col-form-label" >Linn</label>
        <div class="col-10">
		<input type="text" name="linn" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
		<div class="form-group row">
		<label for="maakond" class="col-2 col-form-label" >Maakond</label>
        <div class="col-10">
		<input type="text" name="maakond" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
        <div class="form-group row">
		<label for="postiindeks" class="col-2 col-form-label" >Postiindeks</label>
        <div class="col-10">
		<input type="text" name="postiindeks" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
		<div class="form-group row">
		<label for="telefon" class="col-2 col-form-label" >Telefon</label>
        <div class="col-10">
		<input type="text" name="telefon" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
        
        <div class="form-group row">
		<label for="markused" class="col-2 col-form-label" >Märkused</label>
        <div class="col-10">
		<input type="text" name="markused" required class="form-control form-control-sm" style="width:100%;" >
	 </div> </div>
	

    <div class="form-group row">  
		<input type="submit" name="save" value="Lisa" class="btn btn-info">
          </div>
    </fieldset>
	</form>
    <?php
    if(isset($_POST['save'])){	 
        $nimi =  mysqli_real_escape_string($conn, $_POST['nimi']);
		$aadress=  mysqli_real_escape_string($conn, $_POST['aadress']);
		$linn = mysqli_real_escape_string($conn, $_POST['linn']);
		$maakond =  mysqli_real_escape_string($conn, $_POST['maakond']);
        $postiindeks =  mysqli_real_escape_string($conn, $_POST['postiindeks']);
		$telefon=  mysqli_real_escape_string($conn, $_POST['telefon']);
		 $markused  = mysqli_real_escape_string($conn, $_POST['markused']);
    
	 $sql = "INSERT INTO valjaandja (nimi, aadress, linn, maakond, postiindeks, telefon, markused) 
     VALUES('$nimi','$aadress','$linn','$maakond','$postiindeks','$telefon','$markused')";
	 if (mysqli_query($conn, $sql)) {
		
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>
    
  </div>
<div class="row">
               <div class="col-2" style="margin-top:30px; margin-left:-35px;">
              
<a href="publisher_data.php" class="btn btn-info" role="button">Tagasi</a>
</div>
</div></div>
</body>
</html>