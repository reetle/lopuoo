<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>

<title>Lisa keel</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
    <body> 
<div class="container">  
      <div class="row" >
    <form method="post" action=" " role="form" class="form-inline" >
        <fieldset>
					<legend>Lisa uus</legend><br>
            <div class="form-group row">
            <label for="nimi" class="col-2 col-form-label" >Nimi</label>
            <div class="col-10">
		          <input type="text" name="nimi" class="form-control form-control-sm">
            </div> </div>
            
            <div class="form-group row">  
		          <input type="submit" name="Submit" value="Lisa" class="btn btn-info">
            </div>
    	</fieldset>
    </form>   
          
 <?php
	if(isset($_POST['Submit'])) {
		
        $nimi = mysqli_real_escape_string($conn, $_POST['nimi']);	
	
	   $result = mysqli_query($conn, "INSERT INTO keel (nimi) 
	   VALUES('$nimi')");
        
		echo " <p>Lisatud </p>";
	}
         mysqli_close($conn);
?>

    
  </div>
          <div class="row">
               <div class="col-2" style="margin-top:30px; margin-left:-35px;">
              
<a href="languages_data.php" class="btn btn-info" role="button">Tagasi</a>
</div>
    </div>
    </div>
</body>
</html>