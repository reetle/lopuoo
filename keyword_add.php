<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>

<title>Lisa märksõna</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
 <body> 
<div class="container">  
      <div class="row" >
    <form method="post" action="book_add.php" role="form" class="form-inline" style="margin-top:15px;" >
        <fieldset>
					<legend>Lisa uus</legend><br>
    <div class="form-group row">
		<label for="nimi" class="col-2 col-form-label" >Nimi</label>
        <div class="col-10">
		<input type="text" name="nimi"  class="form-control form-control-sm" style="width:100%;" >
    </div> </div>
     <div class="form-group row">  
		<input type="submit" name="Submit" value="Lisa" class="btn btn-info">
    </div>
    	</fieldset>
	</form>        
 
    <?php
    if(isset($_POST['Submit'])){	 
        
        $nimi = mysqli_real_escape_string($conn, $_POST['nimi']);

	 $sql = "INSERT INTO marksona (nimi) 
     VALUES('$nimi') ON DUPLICATE KEY UPDATE nimi='nimi'";
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
              
<a href="keywords_data.php" class="btn btn-info" role="button">Tagasi</a>
</div>
    </div>
    </div>
</body>
</html>