<?php
include_once("config.php");
$record_per_page =25; //näitab 25 kirjet ühel lehel
$page = '';
if(isset($_GET["page"])){
 $page = $_GET["page"];}
else{
 $page = 1;}
$start_from = ($page-1)*$record_per_page;

$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id  LIMIT $start_from, $record_per_page "; 
$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
     <script src="js/print.js"></script>
<title>Mahakandmine</title>
</head>
<body>
 <div class="container-fluid">         
<div class="row" id="head">
<div class="col-lg" id="head">
 <?php
include_once("header.php");
?>      
    </div>    </div>

       
<div class="row justify-content-end" id="menyy">
    <div class="col-lg-2" >
    <div class= "menu">
<?php
include_once("doings.php");
?>
	</div>     
    </div>
       
 <div class="col-lg-10" style="margin-bottom:33rem; "id="filter">
<div class="search_menu">
 
	<button onclick="window.open('select_media_write_off.php', 'newwindow',                          'width=800,height=600, left=400,top=200,');     return false;">Uus mahakandmine</button>
     <button type="submit" value="click" onclick="printDiv()">Prindi </button>
     <button onclick="window.location.href='write_off.php';">Tühista filtreerimine</button>



    

<br>
  <br>
  <form action=" " method="POST" class="vorm">
		<select name="column">
			<option value="all">Kõik</option>
			<option value="book">Raamatud</option>
			<option value="textbook">Õpikud</option>
			<option value="periodicals">Perioodika</option>
			<option value="audio_video">Audio-video</option>
			<option value="workbook">Töövihikud</option>
			<option value="meth_library">Metoodiline kirjandus</option>  
		</select> 
			Põhjus <input type="text" name="submit">
			<input type ="submit" value="Otsi"> 	
		</form>
</div> </div>

 <div class="col-lg-10 " style="margin-top:-33rem" id="tabel">
  
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    
    <table id="editable_table" class="table table-sm table-hover ">
    <thead>
		<tr>	
 <!-- filtreerib pealkirja järgi kasvavalt või kahanevalt, &#8693; lisab nooled -->	
		<th onclick="sortTable(0)">Akti nr</th>  
		<th onclick="sortTable(1)">Kuupäev &#8693;</th> 
		<th onclick="sortTable(2)">Meedia liik &#8693;</th> 
		<th onclick="sortTable(3)">Pealkiri &#8693;</th>
		<th onclick="sortTable(4)">Autor &#8693;</th> 
		<th onclick="sortTable(5)">Põhjus &#8693;</th>	
		</tr>
	<thead>
	<tbody>
<?php
if ((isset($_POST['column']))and (isset($_POST['submit']))) {
	$column=$_POST['column'];
	$submit=$_POST['submit'];

if($column == 'all'){
$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id  where pohjus like '%$submit%' " ;
}
elseif($column == 'book'){
$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id  where meedia.meedia_liik like 'ra' and pohjus like '%$submit%' " ;
}
elseif($column == 'textbook'){
$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id where meedia.meedia_liik like 'op' and pohjus like '%$submit%' " ;
}	
elseif($column == 'periodicals'){
$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id where meedia.meedia_liik like 'pe' and pohjus like '%$submit%' ";
} 
elseif($column == 'audio_video'){
$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id  meedia.where meedia_liik like 'av' and pohjus like '%$submit%' " ;
}
elseif($column == 'workbook'){
$sql= "select akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id  meedia.where meedia_liik like 'tv' and pohjus like '%$submit%' ";
}
elseif($column == 'meth_library'){
$sql= "Sselect akt_nr, kuupaev, meedia.meedia_liik, meedia.pealkiri, meedia.autor, pohjus
from mahakandmine
left join meedia on mahakandmine.meedia_id=meedia.id where meedia.meedia_liik like 'mk' and pohjus like '%$submit%' " ;
}  
}
$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

  while($row = mysqli_fetch_array($result)) { 	
  echo '
  <tr>
	<td >'.$row["akt_nr"].'</td> 
	<td>'.$row["kuupaev"].'</td> 
	<td>'.$row["meedia_liik"].'</td>
	<td>'.$row["pealkiri"].'</td>
	<td>'.$row["autor"].'</td>
	<td>'.$row["pohjus"].'</td>
  </tr> '; 
} 
 ?>
	</tbody>
	</table>
</div>  </div>  </div>  
<div class="row justify-content-end" id="jalus">    
 <div class="col-lg-10" >
<div id="pagination">

<?php
	/*tabel kuvab 25 esimest kirjet ja jagab ülejäänud tabeli kehekülge https://www.webslesson.info/2016/05/how-to-make-simple-pagination-using-php-mysql.html*/
	$page_query = "SELECT *
	FROM mahakandmine ";
    $page_result = mysqli_query($conn, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 1) /*mitu lehekülge näitab korraga*/
    {
     $start_loop = $total_pages - 1;
    }
    $end_loop = $start_loop + 1;
    if($page > 1)
    {
     echo "<a href='write_off.php?page=1'> Algusesse </a>";
     echo "<a href='write_off.php?page=".($page - 1)."'> << </a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a href='write_off.php?page=".$i."'>" .$i. "</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='write_off.php?page=".($page + 1)."'> >> </a>";
     echo "<a href='write_off.php?page=".$total_pages."'> Lõppu </a>";
    }
  ?>  
 </div>	</div> 
</div>	</div>	
</body>
</html>

<script src="js/sort.js"></script>
 <script>
// JavaScript popup window function
	function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=400,width=800,left=400,top=200,menubar=no, status=no')
	}

</script>