<?php
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Tagastus</title>
</head>
<body> 

<div class="container">
<div class="row" id="borrow" style="margin-top:50px;"  >
    <div class="col-6" style="margin-left:50px; backgound-color:snow; "  >   
        <form role="form" action=" " method="POST"  >
    	<fieldset>	
            <div class="form-group">
              <label for="select">Sisesta invenatri nr: </label>
             <input type="text" name="select" class="form-control" >
	  </div>
        <div class="form-group">
              <label for="tagastus_kp">Sisesta tagastamis kuupäev </label>
            <input type="date" name="tagastus_kp" class="form-control" required >
              </div>
         <div class="form-group">
			<input type ="submit" value="Tagasta" class="btn btn-secondary btn-sm"> 
       </div> 
            </fieldset>
		</form>


</div> 


 <?php
 if ((isset($_POST['select']))) {
     $select=$_POST['select'];

$tagastus_kp = mysqli_real_escape_string($conn, $_POST['tagastus_kp']);	



	$result = mysqli_query($conn, "UPDATE laenutus SET tagastus_kp='$tagastus_kp' WHERE meedia_eksemplar=$select" );
 }
 ?>

</div>	
<br><br>
<button onclick="self.close()" class="btn btn-secondary btn-sm">Tühista</button>
 
</div>
</body>
</html>