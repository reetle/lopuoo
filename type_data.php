<?php
include_once("config.php");
//lehek[le nummerdus
$record_per_page = 20; //näitab 25 kirjet ühel lehel
$page = '';
if(isset($_GET["page"])){
 $page = $_GET["page"];}
else{
 $page = 1;}
$start_from = ($page-1)*$record_per_page;

$sql= "SELECT * FROM liik LIMIT $start_from, $record_per_page "; 
$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

 
 ?> 
<!DOCTYPE html>
<html>
<head>
<title>Tüübid</title>
<link rel="stylesheet" href="styles.css" type="text/css"/>
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
include_once("additional_data.php");
?>
	</div>     
    </div>
       
 <div class="col-lg-10" style="margin-bottom:33rem; "id="filter">
	<div class="search_menu">
		<button onclick="window.location.href='type_add.php';">Lisa uus</button>
        <button type="submit" value="click" onclick="printDiv()">Prindi </button>
	<!--	<button type="submit" form="form2" name="export"  >Ekspordi CSV</button>-->
		<button onclick="window.location.href='type_data.php';">Tühista filtreering</button>
<br><br>
<!--andmete eksport--> 
 <form method="post" action="type_export.php" id="form2" name="export">  </form>  


	<!--filtreerimine tabeli pealkirjade järgi-->
	<form action=" " method="POST" class="vorm">
		<select name="column">
			<option value="nimi">Nimi</option>
			<option value="markused">Märkused</option>
			
	
		</select> 

 <?php
/*viimane otsing jääb otsing aknasse*/
			$search = (isset($_POST['search'])) ? htmlentities($_POST['search']) : ''; ?>
			<input type="text" name="search" value="<?= $search ?>" required>
			<input type ="submit" value="Filtreeri"> 	
		</form>
 <!--filtreeringu tühistamiseks laeb lehe uuesti-->		
		</div> </div>

 <div class="col-lg-10 " style="margin-top:-33rem" id="tabel">
  
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table id="editable_table" class="table table-sm table-hover " style="margin-left:-30px;">
    <thead>
		<tr>	
 <!-- filtreerib pealkirja järgi kasvavalt või kahanevalt, &#8693; lisab nooled -->	
		<th onclick="sortTable(0)" style="visibility:hidden;">ID</th>  
		
		<th onclick="sortTable(1)">Nimi &#8693;</th> 
		<th onclick="sortTable(2)">Märkused &#8693;</th> 
			
		</tr>
	<thead>
	<tbody>
<?php
if ((isset($_POST['search'])) and (isset($_POST['column']))){
	$search=$_POST['search'];
	$column=$_POST['column'];

$sql= "SELECT * FROM liik where $column like '%$search%' " ;}


$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));

  while($row = mysqli_fetch_array($result)) { 	
  echo '
  <tr>
	<td style="visibility:hidden;">'.$row["id"].'</td> 
	<td>'.$row["nimi"].'</td> 
	<td>'.$row["markused"].'</td> 

  </tr> '; }
 ?>
	</tbody>
	</table>
</div>  </div>  </div>  
<div class="row justify-content-end" id="jalus">    
 <div class="col-lg-10" >
<div id="pagination">
<style>

</style>

<?php
	/*tabel kuvab 25 esimest kirjet ja jagab ülejäänud tabeli kehekülge https://www.webslesson.info/2016/05/how-to-make-simple-pagination-using-php-mysql.html*/
	$page_query = "SELECT *
	FROM liik ";
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
     echo "<a href='type_data.php?page=".($page - 1)."'> << </a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a href='type_data.php?page=".$i."'>" .$i. "</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a href='type_data.php?page=".($page + 1)."'> >> </a>";
     echo "<a href='type_data.php?page=".$total_pages."'> Lõppu </a>";
    }
  ?>  
  -->
 </div>
</div>	
</div>  </div>  
</body>
</html>

<script>  //tabelis lives muutmine
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'type_action.php',
buttons: {
        edit: {
            html: ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>',
            action: 'edit'
        
		  },

        delete: {
            html: ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg>',
            action: 'delete'
		}
    },
	
		columns:{
       identifier:[0, "id"],
       editable:[[1, 'nimi'], [2, 'markused']]
      },
   restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      }
     });
 
});  
 </script>
 <!-- tabelite headerite sorteerimiseks https://www.w3schools.com/howto/howto_js_sort_table.asp-->
<script src="js/sort.js"></script>