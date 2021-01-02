<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>

<title>Lisa lugeja</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body> 
     <div class="container">  
      <div class="row" >
    <form method="post" action=" " class="form-inline" style="margin-top:15px;">
                <fieldset>
		 <div class="form-group row">    
        <label for="klass" class="col-2 col-form-label">Klass</label>   
        <div class="col-10">
		<?php
            $query = "SELECT * FROM klass";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="klass" name="klass" class="form-control form-control-sm"  style="width:100%;">
            <option value=""> </option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['klass'] . "</option>";}
?>            </select>  
        </div> </div>
        
		<div class="form-group row">
		<label for="perekonnanimi" class="col-2 col-form-label" >Perenimi</label>
        <div class="col-10">
		<input type="text" name="perekonnanimi" required class="form-control form-control-sm" style="width:100%;" >
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
	if(isset($_POST['save'])) {
        
		$klass = mysqli_real_escape_string($conn, $_POST['klass']);
		$perekonnanimi = mysqli_real_escape_string($conn, $_POST['perekonnanimi']);
		$eesnimi = mysqli_real_escape_string($conn, $_POST['eesnimi']);
		$aadress = mysqli_real_escape_string($conn, $_POST['aadress']);
		$linn = mysqli_real_escape_string($conn, $_POST['linn']);
		$maakond = mysqli_real_escape_string($conn, $_POST['maakond']);
		$postiindeks = mysqli_real_escape_string($conn, $_POST['postiindeks']);
		$telefon = mysqli_real_escape_string($conn, $_POST['telefon']);
		$markused = mysqli_real_escape_string($conn, $_POST['markused']);
	

	
	$sql= "INSERT INTO lugeja (klass, perekonnanimi, eesnimi, aadress, linn, maakond, postiindeks, telefon , markused) 
	VALUES('$klass','$perekonnanimi','$eesnimi','$aadress','$linn','$maakond','$postiindeks', '$telefon','$markused')";
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
              
<a href="readers_data.php" class="btn btn-info" role="button">Tagasi</a>
</div>
</div></div>
</body>
</html>