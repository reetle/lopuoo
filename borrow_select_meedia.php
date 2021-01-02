<?php 

include_once("config.php");

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    



 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

   <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" /> <!-- avab lehe seadme suurusega--> 
    <!-- dropdovn search-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Laenutamine</title>
    </head>  
<style>
   

    </style>   
    



<style>
.myDiv{
	display:none;
   
}  
    </style>
<script>
$(document).ready(function(){
    $('#meedia').on('change', function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });
});
</script>


<body> 
 <div class="container-fluid">
<div class="row" id="borrow">
    
    
    <div class="col" style="margin-top:10px;">
     <a href="borrow_select_reader.php" class="btn btn-secondary btn-sm" role="button" style="position: absolute; right:10px;">Vali uus lugeja</a>   
     
<?php        
$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM lugeja WHERE id=$id") ;
  
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
           $_SESSION['uid'] =$id;
    echo "Lugeja: " . $row["perekonnanimi"]. " " . $row["eesnimi"]. "<br>  " ;
  }
     
} 
?> 
              
     
<br>

  <form action=" " method="post" id="test" class="vorm" >      
        <div class="form-group">
            <select name="meedia" id="meedia" onchange="show();"  >
                <option value=" ">Vali meedia tüüp</option>
                <option value="RA">Raamatud</option>
                <option value="OP">Õpikud</option>
                <option value="AV">Audio-video</option>
                <option value="PE">Perioodika</option>
                <option value="TV">Töövihikud</option>
                <option value="MK">Metoodiline kirjandus</option>
            </select>
              <br>  <br>
            <label for="inventari nr" >Sisesta</label> 
             <label for="inventari nr"  class="myDiv" id="showRA" >inventari number</label>       
            <label for="pealkiri"  class="myDiv" id="showOP" >pealkiri</label>
             <label for="pealkiri"  class="myDiv" id="showAV" >inventari number</label>    
             <label for="pealkiri"  class="myDiv" id="showPE" >pealkiri</label>    
             <label for="pealkiri"  class="myDiv" id="showTV" >pealkiri</label>    
             <label for="pealkiri"  class="myDiv" id="showMK" >pealkiri</label>              
            
            <br>
            <input type="text" name="search"> 
            <input type ="submit" value="Vali"> 
   
      
         </div> 
      </form>

 <div class="col" style="background-color:snow;">        

<?php
  if ((isset($_POST['meedia']))and(isset($_POST['search']))){
     $meedia=$_POST['meedia'];
     $search=$_POST['search'];


//Raamat
	if ($meedia == 'RA') {  

 $sql= "select meedia_eksemplar.inventari_nr, meedia.pealkiri, meedia.autor, meedia.aasta,  meedia.markused, meedia.marksona from (meedia_eksemplar left join meedia on meedia.id = meedia_eksemplar.meedia)  where meedia_liik like 'RA' and meedia_eksemplar.inventari_nr like '%$search%'";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:50%; font-size:12px;'>
         <tr>
         <th>Vali</th>
        <th>Nr</th>
        <th>Pealkiri</th>
         <th>autor</th>
         <th>aasta</th>
         <th>riiul</th>
         <th>märksõna</th>
         <th>markused</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		 echo '
  <tr>
     <td><a  class="btn btn-primary btn-sm" href="borrow_book.php?id='.$row["inventari_nr"].' ">Vali</a></td>
	<td>'.$row["inventari_nr"].'</td>
	<td>'.$row["pealkiri"].'</td>
	<td>'.$row["autor"].'</td>
    <td>'.$row["aasta"].'</td>
	<td>'.$row["marksona"].'</td>
    <td>'.$row["markused"].'</td>


  </tr> '; }
   echo "</table>";
        
    }
    }
 elseif ($meedia == 'AV') {  

 $sql= "select meedia_eksemplar.inventari_nr, meedia.pealkiri, meedia.autor, meedia.aasta,  meedia.markused, meedia.marksona from (meedia_eksemplar left join meedia on meedia.id = meedia_eksemplar.meedia)  where meedia_liik like 'AV' and meedia_eksemplar.inventari_nr like '%$search%'";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:50%; font-size:12px;'>
         <tr>
         <th>Vali</th>
        <th>Nr</th>
        <th>Pealkiri</th>
         <th>autor</th>
         <th>aasta</th>
         <th>riiul</th>
         <th>märksõna</th>
         <th>markused</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		 echo '
  <tr>
     <td><a class="btn btn-primary btn-sm"  href="borrow_book.php?id='.$row["inventari_nr"].' ">Vali</a></td>
	<td>'.$row["inventari_nr"].'</td>
	<td>'.$row["pealkiri"].'</td>
	<td>'.$row["autor"].'</td>
    <td>'.$row["aasta"].'</td>
	<td>'.$row["marksona"].'</td>
    <td>'.$row["markused"].'</td>


  </tr> '; }
   echo "</table>";
        
    }
    }
      
  //õpik
elseif ($meedia == 'OP' ) {	
      $sql="select meedia.id, meedia.pealkiri,meedia.klass, meedia.autor, meedia.aasta, keel.nimi as k, valjaandja.nimi as v, meedia_eksemplar.kogus as ko, meedia.riiul, meedia.marksona, meedia.markused
    from (((meedia
    LEFT JOIN keel ON meedia.keel = keel.id)
    LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
    LEFT JOIN meedia_eksemplar ON meedia.id=meedia_eksemplar.meedia)
    where meedia_liik like 'OP' GROUP BY meedia_eksemplar.meedia HAVING COUNT(*) >= 1 and pealkiri like '%$search%'";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:75%; font-size:12px; margin-left:-45px;'>
          
          <th style='visibility:hidden;'>id</th>
        <th>Vali</th>
         <th>pealkiri</th>
         <th>klass</th>
         <th>autor</th>
         <th>kogus</th>
         <th>aasta</th>
         <th>keel</th>
         <th>väljaandja</th>
         <th>markused</th>
  
         </tr>";
		while($row = mysqli_fetch_assoc($result)) {
		  echo '
  <tr>
	<td style="visibility:hidden;">'.$row["id"].'</td>
    
    <td><a class="btn btn-primary btn-sm" href="borrow_textbook.php?id='.$row["id"].'" >Vali</a></td>
    
	<td>'.$row["pealkiri"].'</td>
    <td>'.$row["klass"].'</td>
	<td>'.$row["autor"].'</td>
	<td>'.$row["ko"].'</td>    
    <td>'.$row["aasta"].'</td>
	<td>'.$row["k"].'</td>
	<td>'.$row["v"].'</td>
    <td>'.$row["markused"].'</td>

  </tr> '; }
   echo "</table>";
}}
        //töövihik
elseif ($meedia == 'TV' ) {	
      $sql="select meedia.id, meedia.pealkiri,meedia.klass, meedia.autor, meedia.aasta, keel.nimi as k, valjaandja.nimi as v, meedia_eksemplar.kogus as ko, meedia.riiul, meedia.marksona, meedia.markused
    from (((meedia
    LEFT JOIN keel ON meedia.keel = keel.id)
    LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
    LEFT JOIN meedia_eksemplar ON meedia.id=meedia_eksemplar.meedia)
    where meedia_liik like 'TV' GROUP BY meedia_eksemplar.meedia HAVING COUNT(*) >= 1 and pealkiri like '%$search%'";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:75%; font-size:12px; margin-left:-45px;'>
          
          <th style='visibility:hidden;'>id</th>
        <th>Vali</th>
         <th>pealkiri</th>
         <th>klass</th>
         <th>autor</th>
         <th>kogus</th>
         <th>aasta</th>
         <th>keel</th>
         <th>väljaandja</th>
         <th>markused</th>
  
         </tr>";
		while($row = mysqli_fetch_assoc($result)) {
		  echo '
  <tr>
	<td style="visibility:hidden;">'.$row["id"].'</td>
    
    <td><a class="btn btn-primary btn-sm" href="borrow_textbook.php?id='.$row["id"].'" >Vali</a></td>
    
	<td>'.$row["pealkiri"].'</td>
    <td>'.$row["klass"].'</td>
	<td>'.$row["autor"].'</td>
	<td>'.$row["ko"].'</td>    
    <td>'.$row["aasta"].'</td>
	<td>'.$row["k"].'</td>
	<td>'.$row["v"].'</td>
    <td>'.$row["markused"].'</td>

  </tr> '; }
   echo "</table>";
}}
      
      elseif ($meedia == 'MK' ) {	
      $sql="select meedia.id, meedia.pealkiri,meedia.klass, meedia.autor, meedia.aasta, keel.nimi as k, valjaandja.nimi as v, meedia_eksemplar.kogus as ko, meedia.riiul, meedia.marksona, meedia.markused
    from (((meedia
    LEFT JOIN keel ON meedia.keel = keel.id)
    LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
    LEFT JOIN meedia_eksemplar ON meedia.id=meedia_eksemplar.meedia)
    where meedia_liik like 'MK' GROUP BY meedia_eksemplar.meedia HAVING COUNT(*) >= 1 and pealkiri like '%$search%'";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:75%; font-size:12px; margin-left:-45px;'>
          
          <th style='visibility:hidden;'>id</th>
        <th>Vali</th>
         <th>pealkiri</th>
         <th>klass</th>
         <th>autor</th>
         <th>kogus</th>
         <th>aasta</th>
         <th>keel</th>
         <th>väljaandja</th>
         <th>markused</th>
  
         </tr>";
		while($row = mysqli_fetch_assoc($result)) {
		  echo '
  <tr>
	<td style="visibility:hidden;">'.$row["id"].'</td>
    
    <td><a class="btn btn-primary btn-sm" href="borrow_textbook.php?id='.$row["id"].'" >Vali</a></td>
    
	<td>'.$row["pealkiri"].'</td>
    <td>'.$row["klass"].'</td>
	<td>'.$row["autor"].'</td>
	<td>'.$row["ko"].'</td>    
    <td>'.$row["aasta"].'</td>
	<td>'.$row["k"].'</td>
	<td>'.$row["v"].'</td>
    <td>'.$row["markused"].'</td>

  </tr> '; }
   echo "</table>";
}}
      //perioodika    
 elseif ($meedia == 'PE') {  

 $sql= "select meedia.id, meedia.pealkiri, meedia.aasta,  meedia.markused, meedia.marksona from (meedia_eksemplar left join meedia on meedia.id = meedia_eksemplar.meedia)  where meedia_liik like 'PE' and meedia_eksemplar.inventari_nr like '%$search%'";
    $result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
		 echo "<table class='table table-sm table-hover' style='width:50%; font-size:12px; margin-left:-45px;'>
         <tr>
         <th>Vali</th>
        <th>Nr</th>
        <th>Pealkiri</th>
         <th>aasta</th>
         <th>riiul</th>
         <th>märksõna</th>
         <th>markused</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
		 echo '
  <tr>
     <td><a class="btn btn-secondary btn-sm" href="write_off_book.php?id='.$row["inventari_nr"].'  ">Kanna maha</a></td>
	<td>'.$row["inventari_nr"].'</td>
	<td>'.$row["pealkiri"].'</td>
    <td>'.$row["aasta"].'</td>
	<td>'.$row["marksona"].'</td>
    <td>'.$row["markused"].'</td>


  </tr> '; }
   echo "</table>";
        
    }
    }
  
  
  }
 ?> 
   
   </div>  </div>   </div>  </div> 
</body>
</html>
