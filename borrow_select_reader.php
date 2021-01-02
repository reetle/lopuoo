<?php
include_once("config.php");
session_start();

$sql= "SELECT lugeja.id, klass.klass as k, lugeja.perekonnanimi, lugeja.eesnimi, lugeja.aadress, lugeja.linn, lugeja.maakond, lugeja.postiindeks, lugeja.telefon, lugeja.markused from (lugeja LEFT join klass ON lugeja.klass = klass.id)"; 
$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));



	

?>

<!DOCTYPE html>
<html>
<head>
<title>Laenutus</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
<meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" /> <!-- avab lehe seadme suurusega-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>      

<script src="js/jquery.tabledit.min.js"></script>
   <script src="js/print.js"></script>
</head>
<body>
   <div class="container-fluid">         

       
<div class="row justify-content-end">
    
    </div>
       
 <div class="col" style="margin-bottom:33rem; "id="filter">
	<div class="search_menu" style="margin-top:10px;" >

<button onclick="window.location.href='borrow_select_reader.php';" style="margin-top:10px; margin-bottom:5px;" >Tühista filtreerimine</button>


	<!--filtreerimine tabeli pealkirjade järgi-->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="vorm">
	
 <?php
/*viimane otsing jääb otsing aknasse*/
			$search = (isset($_POST['search'])) ? htmlentities($_POST['search']) : ''; ?>
			<input type="text" name="search" value="<?= $search ?>" required>
			<input type ="submit" value="Filtreeri" style=" margin-bottom:5px;" > 	
		</form>

</div> </div>

 <div class="col " style="margin-top:-33rem" id="tabel">
  
<div class="table-wrapper-scroll-y my-custom-scrollbar">

    <table id="editable_table" class="table table-sm table-hover" style="width:50%;">
<thead>
    <tr>
        
		<td  style="visibility:hidden;">ID</td>
         <th></th>
        <th>Nimi</th>
        <th>Klass</th>
   
    </tr>
	</thead>
	<tbody>		
<?php
if (isset($_POST['search'])){
	$search=$_POST['search'];



$sql= "SELECT lugeja.id, klass.klass as k, lugeja.perekonnanimi, lugeja.eesnimi, lugeja.aadress, lugeja.linn, lugeja.maakond, lugeja.postiindeks, lugeja.telefon, lugeja.markused from (lugeja LEFT join klass ON lugeja.klass = klass.id) where perekonnanimi like '%$search%' OR eesnimi like '%$search%' " ;}



$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

  while($row = mysqli_fetch_array($result)) { 
      $_SESSION['uid'] = $row['id'];
  echo '
  <tr>
	<td style="visibility:hidden;">'.$row["id"].'</td> 
	<td><a  class="btn btn-primary btn-sm" style="font-size:10px;" href="borrow_select_meedia.php?id='.$row["id"].'"   >Vali</a></td>
	<td>'.$row["perekonnanimi"].' '.$row["eesnimi"].'</td>
    <td>'.$row["k"].'</td> 
	
  </tr> '; 
      
     
;}
 ?>
	</tbody>
	</table>

    
</div> 


</div>	
</div> 
</body>
</html>

