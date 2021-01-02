<?php 

include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Mahakandmine</title>

</head>
<body> 
<div class="container">
<div class="row"  id="borrow" style=" margin-top:25px;">
    <div class="col-4" >   
        
     
  <br> 
  <p> Kas sa soovid antud teost maha kanda: </p>
  <?php
        
    $id = $_GET["id"];
 $sql= "select meedia_eksemplar.inventari_nr, meedia.pealkiri, meedia.autor, meedia.aasta, meedia.valjaandja, meedia.liik, meedia.keel, meedia.markused, meedia.marksona from (meedia_eksemplar left join meedia on meedia.id = meedia_eksemplar.meedia)  where meedia_eksemplar.inventari_nr=$id";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
		echo "Raamat <br>Inventari nr: " . $row["inventari_nr"]. 
            " <br> Pealkiri: " . $row["pealkiri"]. 
            " <br> Autor: " . $row["autor"]. 
            " <br> Aasta: " . $row["aasta"].
            " <br> Väljaandja: " . $row["valjaandja"].
            " <br> Liik: " . $row["liik"].
            " <br> Keel: " . $row["keel"].
            " <br> Märksõna: " . $row["marksona"].
            " <br> Märkused:" . $row["markused"].
            "<br>  " ;
        }
   echo "</table>";
    }
?>  <br>
  </div> 
		<div class="col-4"  >     
     
  <form action=" " method="post">      
      <input type="text" name="id" value="<?= $id ?>" style="visibility:hidden;">
        <br>
         <div class="form-group">
            <label for="pohjus">Põhjus </label>
              <input type="text" name="pohjus" class="form-control"  required>
           </div>
        <div class="form-group">
          <label for="kuupaev">Kuupäev </label>
              <input type="date" name="kuupaev" value="<?php echo date('Y-m-d');?>" class="form-control">
        </div>
      <div class="form-group">
		<input type="submit" name="Submit" value="Kanna maha" class="btn btn-secondary btn-sm" onclick="myFunction()"  >
       
		</div>   			
	</form>
 


<script>
function myFunction() {
  var txt;
  if (confirm("Kas sa soovid antud teost maha kanda! // Pärast nupule vajutamist sulgetakse aken automaatselt!")== true) {
    txt = "Maha kantud";
  } else {
    txt = "Maha kandmine tühistatud";
  }
  document.getElementById(" ").innerHTML = txt;
}
</script>
 </div>   
<?php
	$id = $_GET["id"];
            
	if(isset($_POST['Submit'])) {

		$pohjus = mysqli_real_escape_string($conn, $_POST['pohjus']);
		$kuupaev = mysqli_real_escape_string($conn, $_POST['kuupaev']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
	

$result = mysqli_query($conn, "INSERT INTO mahakandmine (kuupaev, inventari_nr, pohjus, meedia_id)
SELECT '$kuupaev','$id','$pohjus', meedia_eksemplar.meedia
FROM meedia_eksemplar WHERE meedia_eksemplar.inventari_nr=$id");
        
$result = mysqli_query($conn, "DELETE FROM meedia_eksemplar WHERE inventari_nr=$id");
        
        
    echo  "<script type='text/javascript'>";
    echo "window.close();";
    echo "</script>";
}
     mysqli_close($conn);
    
?> 
            

            
 </div>        
        

 <br>
 <button onclick="self.close()" class="btn btn-secondary btn-sm">Sulge</button>
           
 </div> 
</body>
</html>
