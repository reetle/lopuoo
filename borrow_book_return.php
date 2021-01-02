<?php
// including the database connection file
include_once("config.php");

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Laenutamine</title>
</head>
<body> 
	<div class="container">
	<div class="row" id="borrow" style="margin-top:50px;"  >
    <div class="col-6" style="margin-left:50px; "  >  
	   <form role="form" action=" " method="POST"  >
           <fieldset>	  
	
          <div class="form-group">
	       <label for="select">Sisesta tagastus kuupäev: </label>			
			
				<input type="date" name="tagastus_kp" class="form-control" required >
                 </div>
			  <div class="form-group">
				<input style="visibility:hidden;" name="id" value="<?php echo $_GET['id'];?>">
                 </div> 
              <div class="form-group">      
				<input type="submit" name="update" value="Tagasta" class="btn btn-secondary btn-sm">
		
              </div>
	   </fieldset>
	</form>
  


<?php

if(isset($_POST['update']))
{	

$id = mysqli_real_escape_string($conn, $_POST['id']);
$tagastus_kp = mysqli_real_escape_string($conn, $_POST['tagastus_kp']);	
	
        $sql="UPDATE laenutus SET tagastus_kp='$tagastus_kp' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Teavik tagastatud";
                } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 
    
}

?>  
          </div> </div>
     <br>
        <button onclick="self.close()" class="btn btn-secondary btn-sm">Sulge</button>    

    </div>
</body>
</html>