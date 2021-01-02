<?php
include_once("config.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Kanna manha</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
 <meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" /> <!-- avab lehe seadme suurusega-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<!--tabeli lives muutmiseks-->
<script src="js/jquery.tabledit.min.js"></script>
  
    
<!-- Script to print the content of a div -->
   <script src="js/print.js"></script>
    <style>       

        </style> 
     
</head>
<body>
     <div class="container">         
<div class="row" id="borrow" style=" margin-top:25px;">
<div class="col-4"  >
 <br>

 <p> Kas sa soovid antud teost maha kanda: </p>

        
 

 <?php
    $id = $_GET["id"];
 $sql= "select meedia.id, meedia.pealkiri,meedia.klass, meedia.autor, meedia.aasta, keel.nimi as k, valjaandja.nimi as v, meedia.riiul, meedia.marksona, meedia.markused
    from (((meedia
    LEFT JOIN keel ON meedia.keel = keel.id)
    LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
    LEFT JOIN meedia_eksemplar ON meedia.id=meedia_eksemplar.meedia)
    where meedia.id=$id GROUP BY meedia_eksemplar.meedia HAVING COUNT(*) >= 1";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_assoc($result)) {
		echo
            "Õpik:  <br> Pealkiri: " . $row["pealkiri"]. 
             " <br> Klass: " . $row["klass"].
            " <br> Autor: " . $row["autor"]. 
            " <br> Aasta: " . $row["aasta"].
            " <br> Väljaandja: " . $row["v"].
            " <br> Keel: " . $row["k"].
            " <br> Märksõna: " . $row["marksona"].
            " <br> Märkused:" . $row["markused"].
            "<br>  " ;
        }
   echo "</table>";
    }
?>  <br>
    </div>
		<div class="col-4" style="margin-top:25px; " >     
 
    <form action=" " method="post">   
          <fieldset> 
      
        <input type="text" name="id" value="<?= $id ?>" style="visibility:hidden;" >
        <br>   
     <div class="form-group">
        <label for="kogus">kogus</label>     
        <input type="text" name="kogus" required class="form-control">	
           </div>
        <div class="form-group">
            <label for="pohjus">Põhjus: </label>
              <input type="text" name="pohjus" class="form-control">
           </div>      
          <div class="form-group">   
    <label for="kogus">Kuupäev</label>     
        <input type="date" name="kuupaev" value="<?php echo date('Y-m-d');?>" class="form-control" >	
             </div>
  
        <div class="form-group">
       <input type ="submit" name="Submit" value="Kanna maha" class="btn btn-secondary btn-sm"  onclick="myFunction()" > 
              </div></fieldset>
            </form>
           
<script>
function myFunction() {
  var txt;
  if (confirm("Kas sa soovid andtud teost maha kanda")== true) {
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
    if(isset($_POST['Submit'])){	
       

        $pohjus = mysqli_real_escape_string($conn, $_POST['pohjus']);
		$kuupaev = mysqli_real_escape_string($conn, $_POST['kuupaev']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $kogus = mysqli_real_escape_string($conn, $_POST['kogus']);
     
		
    
	$result = mysqli_query($conn, "INSERT INTO mahakandmine (kuupaev, pohjus, kogus,  meedia_id)
    SELECT '$kuupaev','$pohjus', '$kogus', meedia_eksemplar.meedia
    FROM meedia_eksemplar WHERE meedia_eksemplar.meedia=$id");
     
        $result = mysqli_query($conn, "UPDATE meedia_eksemplar SET kogus=(kogus - '$kogus') WHERE meedia_eksemplar.meedia=$id");  
        
        echo  "<script type='text/javascript'>";
        echo "window.close();";
        echo "</script>";
      
    }
         mysqli_close($conn);
	?>
  <br>
    </div> 
      <button onclick="self.close()" class="btn btn-secondary btn-sm">Tühista</button> 
         
 </div>        
          
      
  

</body>
</html>

    