<?php
include_once("config.php");
//lehek[le nummerdus
$record_per_page = 25; //näitab 50 kirjet ühel lehel
$page = '';
if(isset($_GET["page"])){
 $page = $_GET["page"];}
else{
 $page = 1;}
$start_from = ($page-1)* $record_per_page;

$sql= "select meedia.id, meedia.pealkiri,meedia.klass, meedia.autor, meedia.aasta, liik.nimi as l, keel.nimi as k, valjaandja.nimi as v, meedia_eksemplar.kogus as ko, meedia.riiul, meedia.marksona, meedia.markused
from ((((meedia
LEFT join  liik ON meedia.liik = liik.id)
LEFT JOIN keel ON meedia.keel = keel.id)
LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
LEFT JOIN meedia_eksemplar ON meedia.id=meedia_eksemplar.meedia)
where meedia_liik like 'TV' GROUP BY meedia_eksemplar.meedia HAVING COUNT(*) >= 1 LIMIT $start_from, $record_per_page "; 
$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

?>

<!DOCTYPE html>
<html>
<head>
<title>Õpikud</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
 <meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" /> <!-- avab lehe seadme suurusega-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script src="js/jquery.tabledit.min.js"></script>
<!-- Script to print the content of a div -->
<script src="js/print.js"></script>

</head>
<body>
 <div class="container-fluid">         
<div class="row" id="head">
<div class="col-lg"  id="head">
 <?php
include_once("header.php");
?>      
    </div>    
 </div> 
<div class="row justify-content-end" id="menyy">
    <div class="col-lg-2" >
    <div class= "menu">
        <?php
include_once("library_fund.php");
        ?>       
        
        </div></div>     
<!--otsimise ja filtreerimise menüü-->
  <div class="col-lg-10" style="margin-bottom:33rem; "id="filter">
	<div class="search_menu">
		<button onclick="window.location.href='book_add.php.php';">Lisa uus</button>
        <button type="submit" value="click" onclick="printDiv()">Prindi </button>
		<button type="submit" form="form2" name="export" class="export" >Ekspordi CSV</button>
		<button onclick="window.location.href='workbook_data.php';">Tühista filtreerimine</button>

<br><br>
<!--andmete eksport-->
 <form method="post" action="workbook_export.php" id="form2">  
                </form>  

	<!--filtreerimine tabeli pealkirjade järgi-->
	<form action=" workbook_data.php" method="POST" class="vorm" >
		<select name="column">
			<option value="pealkiri">Pealkiri</option>
            <option value="klass">Klass</option>
			<option value="autor">Autor</option>
			<option value="aasta">Aasta</option>
			<option value="liik.nimi">Liik</option>
			<option value="keel.nimi">Keel</option>
			<option value="valjaandja.nimi">Väljaandja</option>
			<option value="kogus">Kogus</option>
			<option value="riiul">Riiul</option>
			<option value="marksona">Märksõna</option>
			<option value="meedia.markused">Märkused</option>
		</select> 

 <?php
/*viimane otsing jääb otsing aknasse*/
			$search = (isset($_POST['search'])) ? htmlentities($_POST['search']) : ''; ?>
			<input type="text" name="search" value="<?= $search ?>" required>
			<input type ="submit" value="Filtreeri"> 	
		</form>
 		
</div> </div>

 <!-- Tabel-->
<div class="col-lg-10 " style="margin-top:-33rem" id="tabel">
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table id="editable_table" class="table table-sm table-hover  ">
    <thead>
		<tr>	
 <!-- filtreerib pealkirja järgi kasvavalt või kahanevalt, &#8693; lisab nooled -->	
		<th onclick="sortTable(0)" style="visibility:hidden;">#</th>  
		<th onclick="sortTable(1)">Pealkiri &#8693;</th> 
        <th onclick="sortTable(2)">Klass &#8693;</th>             
		<th onclick="sortTable(3)">Autor &#8693;</th> 
		<th onclick="sortTable(4)">Aasta &#8693;</th>
		<th onclick="sortTable(5)">Liik &#8693;</th> 
		<th onclick="sortTable(6)">Keel &#8693;</th>
		<th onclick="sortTable(7)">Väljaandja &#8693;</th> 
		<th onclick="sortTable(8)">Kogus &#8693;</th> 
		<th onclick="sortTable(9)">Riiul &#8693;</th>
		<th onclick="sortTable(10)">Märksõna &#8693;</th> 
		<th onclick="sortTable(11)">Märkused &#8693;</th>	
		<th>Muuda</th>
	       
	
				
		</tr>
	<thead>
	<tbody>
<?php
if ((isset($_POST['search'])) and (isset($_POST['column']))){
	$search=$_POST['search'];
	$column=$_POST['column'];


$sql= "select meedia.id, meedia.pealkiri,meedia.klass, meedia.autor, meedia.aasta, liik.nimi as l, keel.nimi as k, valjaandja.nimi as v, meedia_eksemplar.kogus as ko, meedia.riiul, meedia.marksona, meedia.markused
from ((((meedia
LEFT join  liik ON meedia.liik = liik.id)
LEFT JOIN keel ON meedia.keel = keel.id)
LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
LEFT JOIN meedia_eksemplar ON meedia.id=meedia_eksemplar.meedia)
where meedia_liik like 'TV' GROUP BY meedia_eksemplar.meedia HAVING COUNT(*) >= 1 and $column like '%$search%' " ;}
	

$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

  while($row = mysqli_fetch_array($result)) { 	
  echo '
  <tr>
	<td style="visibility:hidden;">'.$row["id"].'</td> 
	<td>'.$row["pealkiri"].'</td> 
    <td>'.$row["klass"].'</td>     
	<td>'.$row["autor"].'</td>
	<td>'.$row["aasta"].'</td>
	<td>'.$row["l"].'</td>
	<td>'.$row["k"].'</td>
	<td>'.$row["v"].'</td>
	   <td><a href="meedia_eksemplar_textbook.php?id='.$row["id"].'"  onclick="basicPopup(this.href); return false;">'.$row["ko"].'</a></td>
	<td>'.$row["riiul"].'</td>
	<td>'.$row["marksona"].'</td>
	<td>'.$row["markused"].'</td>
    <td><a class="btn btn-success btn-sm" style="font-size:10px;" href="book_edit.php?id='.$row["id"].'"  onclick="basicPopup(this.href); return false;">Muuda</a></td>
  </tr> '; }
 ?>
	</tbody>
	</table>
 <script>
// JavaScript popup window function
	function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=400,width=800,left=400,top=200,menubar=no, status=no')
	}

</script>    
    </div>   

 </div>	
 
    </div> 
    <div class="row justify-content-end" id="jalus">    
 <div class="col-lg-10" id="jalus">
 <div id="pagination">

<?php
	/*tabel kuvab 25 esimest kirjet ja jagab ülejäänud tabeli kehekülge https://www.webslesson.info/2016/05/how-to-make-simple-pagination-using-php-mysql.html*/
	$page_query = "SELECT *
	FROM  meedia
where meedia_liik like 'TV' ";
    $page_result = mysqli_query($conn, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
    if($difference <= 5) /*mitu lehekülge näitab korraga*/
    {
     $start_loop = $total_pages - 5;
    }
    $end_loop = $start_loop + 4;
    if($page > 1)
    {
     echo "<a href='workbook_data.php?page=1'> Algusesse </a>";
     echo "<a href='workbook_data.php?page=".($page - 1)."'> << </a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a href='workbook_data.php?page=".$i."'>" .$i. "</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='workbook_data.php?page=".($page + 1)."'> >> </a>";
     echo "<a href='workbook_data.php?page=".$total_pages."'> Lõppu </a>";
    }
  ?> 
 </div>       
        
        
        </div>
</div> </div> 
</body>
</html>


 <!-- tabelite headerite sorteerimiseks https://www.w3schools.com/howto/howto_js_sort_table.asp-->
<script src="js/sort.js"></script>