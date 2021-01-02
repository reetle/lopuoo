<?php
include_once("config.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Raamatud</title>
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
<div class="row" id="head">
<div class="col-lg" style="background-color:snow; font-size:12px;"   >
 <br>
<p> <strong>Kas soovita antud teost laenutada:</strong></p>
<?php   
$uid = $_SESSION["uid"];

$result = mysqli_query($conn, "SELECT * FROM lugeja WHERE id=$uid") ;
   
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "Lugeja: " . $row["perekonnanimi"]. " " . $row["eesnimi"]. "<br>  " ;
  }
} 
?>
    <br>

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
            " " ;
        }
   echo "</table>";
    }
?>  
      

  <?php
$result = mysqli_query($conn, "SELECT meedia_eksemplar FROM laenutus WHERE meedia_eksemplar=$id and tagastus_kp is null") ;
   
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<p> <strong>Antud teos on juba välja laenutatud!</strong></p> " ;}
 }
     else{ 
         "Antud teos on vaba laenutamiseks" ;}

    ?>
    <form action=" " method="post">   
        <fieldset>	 
     
     
        <input type="text" name="uid" value="<?= $uid = $_SESSION["uid"];?>" style="visibility:hidden;">
        <br>   
       
     
        <input type="text" name="nr" value="<?= $id ?>" style="visibility:hidden;" >
        <br>   
        
        <div class="form-group">
        <label for="kuupaev">Laenutus kuupäev</label>     
        <input type="date" name="laenutus_kp" value="<?php echo date('Y-m-d');?>" class="form-control" style="width:20%;">	
           
  </div>
        <div class="form-group">
    <label for="tähtaeg">Tagastus tähtaeg</label>     
        <input type="date" name="tahtaeg_kp" value="<?php echo date('Y-m-d', strtotime('+ 14 days'));?>" class="form-control" style="width:20%;">	 
  </div>
        <div class="form-group">
       <input type ="submit" name="Submit" value="Laenuta" class="btn btn-primary btn-sm"> 
       </div>
        </fieldset>
            </form>
     


 <?php
    $uid = $_SESSION["uid"]; 
    $id = $_GET["id"];
    if(isset($_POST['Submit'])){	
       
        $uid=  mysqli_real_escape_string($conn, $_POST['uid']);	
        $nr=  mysqli_real_escape_string($conn, $_POST['nr']);	
        $kogus =  mysqli_real_escape_string($conn, $_POST['kogus']);	
		$laenutus_kp = mysqli_real_escape_string($conn, $_POST['laenutus_kp']);	
		$tahtaeg_kp = mysqli_real_escape_string($conn, $_POST['tahtaeg_kp']);	
     
		
    
	$result = mysqli_query($conn, "INSERT INTO laenutus (meedia_eksemplar,lugeja,  kogus, laenutus_kp, tahtaeg_kp, meedia) 
     SELECT '$nr','$uid', '1','$laenutus_kp','$tahtaeg_kp', meedia_eksemplar.meedia   
 FROM meedia_eksemplar
 WHERE meedia_eksemplar.inventari_nr LIKE '$nr'" );
      echo "<script>window.close();</script>";
	}
    
         mysqli_close($conn);
	?>
  <br>
  
    
         
        
  <?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>  
  </div> </div>
           <button onclick="self.close()" class="btn btn-primary btn-sm" style="margin-top:25px;">Tühista</button>   
            </div>            
</body>
</html>

    