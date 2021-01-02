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
<title>Statistika</title>
</head>
<body>
   <div class="container-fluid">         
<div class="row" id="head">
<div class="col-lg" >
 <?php
include_once("header.php");
?>      
    </div>
    
 </div>   
<div class="row justify-content-end">
    <div class="col-lg-2" id="menu" style="margin-right:-10px;">
    <div class= "menu">
		<ul style="list-style-type:none">
			<li> <a href="data.php"> Andmed </a> </li>  
			<li> <a href="doings.php"> Toimingud </a></li>
			<li> <a href="statistics.php">Statistika </a></li>
			<li> <a href="settings.php">Programmi seaded </a></li>						
		</ul>
	</div>     
    </div>
    <div class="col-lg-10" style="margin-bottom:33rem;  margin-right:10px;" id="filter">
    
    <form action=" " method="POST" class="vorm">
        <div class="form-group" style="margin-top:10px; ">
		<select name="column">
			<option value="fond">Raamatukogu fond</option>
			<option value="readers">Lugejad</option>
			<option value="data">Lisaandmed</option>	
		</select> 
			<input type="submit" value="Näita">  
            </div> 
		</form>    
    
    
    </div>
    <div class="col-lg-10 " style="margin-top:-33rem; font-size:12px; margin-right:10px;" id="tabel">
        <?php
if (isset($_POST['column'])){
$column=$_POST['column'];

//Raamatukogu fond
if ($_POST['column'] == 'fond') {
	$sql= "SELECT 'Raamatud', COUNT(*) as C, SUM(meedia.kogus) as S, meedia_eksemplar.kogus * meedia_eksemplar.hind as summa FROM 
(meedia_eksemplar right JOIN meedia ON meedia_eksemplar.meedia=meedia.id) where meedia_liik like 'RA'
UNION
SELECT 'Õpikud', COUNT(*) as C, SUM(meedia.kogus) as S, meedia_eksemplar.kogus * meedia_eksemplar.hind as summa FROM 
(meedia_eksemplar right JOIN meedia ON meedia_eksemplar.meedia=meedia.id) where meedia_liik like 'op'
UNION
SELECT 'Audio-video', COUNT(*) as C, SUM(meedia.kogus) as S, meedia_eksemplar.kogus * meedia_eksemplar.hind as summa FROM 
(meedia_eksemplar right JOIN meedia ON meedia_eksemplar.meedia=meedia.id) where meedia_liik like 'av'
UNION
SELECT 'Töövihikud', COUNT(*) as C, SUM(meedia.kogus) as S, meedia_eksemplar.kogus * meedia_eksemplar.hind as summa FROM 
(meedia_eksemplar right JOIN meedia ON meedia_eksemplar.meedia=meedia.id) where meedia_liik like 'tv'
UNION
SELECT 'Metoodiline kirjandus', COUNT(*) as C, SUM(meedia.kogus) as S, meedia_eksemplar.kogus * meedia_eksemplar.hind as summa FROM 
(meedia_eksemplar right JOIN meedia ON meedia_eksemplar.meedia=meedia.id) where meedia_liik like 'mk';" ;
	$result = mysqli_query($conn, $sql);
	
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:50%;'><tr><th>Liik</th><th>Erinevad</th><th>Kokku</th><th>Summa</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		 echo '
  <tr>
	<td>'.$row["Raamatud"].'</td>
	<td>'.$row["C"].'</td>
	<td>'.$row["S"].'</td>
	<td>'.$row["S"].'</td>

  </tr> '; }
   echo "</table>";
	}
}	
//lugejad
elseif ($_POST['column']== 'readers' ) {	
	$sql= "SELECT klass.klass as k,  COUNT(*) as l FROM (lugeja LEFT join klass ON lugeja.klass = klass.id) GROUP BY lugeja.klass HAVING COUNT(*) > 1 ;" ;
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:25%;'><tr><th>Klass</th><th>Lugejad</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		 echo '
  <tr>
	<td>'.$row["k"].'</td>
	<td>'.$row["l"].'</td>
    
  </tr> '; }
   echo "</table>";
	}
}
//lisaandmed
elseif ($_POST['column'] == 'data' ) {	
	$sql= "SELECT 'Autorid',  COUNT(*) as C FROM autor
		UNION
		SELECT 'Väljaandjad',  COUNT(*) as C FROM valjaandja
		UNION
		SELECT 'Liigid',  COUNT(*) as C FROM liik
		UNION
		SELECT 'Audio-Video tüübid',  COUNT(*) as C FROM andmekandja 
		UNION
		SELECT 'Met.kirjanduse tüübid',  COUNT(*)as C FROM andmekandja
		UNION
		SELECT 'Keeled',  COUNT(*) as C FROM keel
		UNION
		SELECT 'Märksõnad',  COUNT(*) as C FROM marksona; " ;
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:25%;'><tr><th>Lisaandmed</th><th>Kokku</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		 echo '
  <tr>
	<td>'.$row["Autorid"].'</td>
	<td>'.$row["C"].'</td>
  </tr> '; }
   echo "</table>";
	}
}}

 ?>
    </div>

    </div>   

<div class="row">       
 <div class="col-lg" id="jalus"></div>
</div>
    </div>


</body>
</html>
