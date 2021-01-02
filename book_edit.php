<?php
include_once("config.php");


if(isset($_POST['Submit']))
{
	$id = $_POST['id'];
    
	$meedia_liik = $_POST['meedia_liik'];
	$pealkiri = $_POST['pealkiri'];
	$klass = $_POST['klass'];
    $andmekandja = $_POST['andmekandja'];
    $autor = $_POST['autor'];
	$aasta = $_POST['aasta'];
	$liik = $_POST['liik'];
	$keel= $_POST['keel'];
	$valjaandja = $_POST['valjaandja'];
	$riiul = $_POST['riiul'];
	$marksona = $_POST['marksona'];
	$markused = $_POST['markused'];	

	//update meedia
	$result = mysqli_query($conn, "UPDATE meedia
    
    SET 
	meedia_liik='$meedia_liik', 
    pealkiri='$pealkiri',  
    
   
	klass='$klass',    
	autor='$autor',
	aasta='$aasta',
 


	marksona='$marksona', 
	markused='$markused'	
	WHERE id=$id");
echo'
	<p>Muudetud</p>';
}
?>
<?php
$id = $_GET['id'];

$sql= "SELECT meedia.meedia_liik, meedia.klass, meedia.andmekandja, meedia.id, meedia.pealkiri, meedia.autor, meedia.aasta, 
liik.nimi as l, keel.nimi as k, valjaandja.nimi as v, 
meedia.riiul, meedia.marksona, meedia.markused 
    FROM meedia 
        LEFT join liik ON meedia.liik = liik.id
        LEFT JOIN keel ON meedia.keel = keel.id
        LEFT JOIN meedia_eksemplar ON meedia.id = meedia_eksemplar.meedia 
        LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id
WHERE meedia.id=$id " ;

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
{   $meedia_liik = $row['meedia_liik'];
	$pealkiri = $row['pealkiri'];
    $klass = $row['klass'];
    $andmekandja = $row['andmekandja'];
	$autor = $row['autor'];
	$aasta = $row['aasta'];
	$liik = $row['l'];
	$keel= $row['k'];
	$valjaandja = $row['v'];
	$riiul = $row['riiul'];
	$marksona = $row['marksona'];
	$markused = $row['markused'];
}
?>
<!DOCTYPE html>
<html>
<head>

<title>Lisa raamat</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<body> 
     <div class="container">  
      <div class="row" >
            <p>Muuda</p>
    <form method="post" action=" " role="form" class="form-inline" style="margin-top:15px; margin-left:25px; font-size:12px;" >
        <fieldset>
             <div class="form-group row">
		<label for="pealkiri" class="col-4 col-form-label" >Meedia liik</label>
        <div class="col-8">
		<select id="meedia_liik" name="meedia_liik" class="form-control form-control-sm" style="width:100%;" >
            <option value='<?php echo $meedia_liik;?>'></option> 
            <option value="RA">Raamat</option>
             <option value="OP">Õpik</option>
             <option value="AV">Audio-Video</option>
             <option value="TV">Töövihik</option>
            <option value="PE">Perioodika</option>
             <option value="MK">Metoodiline kirjandus</option> 
          </select>
    </div> </div>
            
    <div class="form-group row">
		<label for="pealkiri" class="col-4 col-form-label" >Pealkiri</label>
        <div class="col-8">
		<input type="text" name="pealkiri"  class="form-control form-control-sm" style="width:100%;" value='<?php echo $pealkiri;?>'>
    </div> </div>
            
    <div class="form-group row">           
		<label for="klass" class="col-4 col-form-label">Klass</label>
        <div class="col-8">
		<input type="text" name="klass" class="form-control form-control-sm" style="width:100%;" value='<?php echo $klass;?>'>
    </div> </div>  
    
            <div class="form-group row">     
       <label for="keel" class="col-4 col-form-label">Tüüp</label> 
        <div class="col-8">
        <?php
            $query = "SELECT * FROM andmekandja";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="andmekandja" name="andmekandja" class="form-control form-control-sm"  style="width:100%;">
            <option value="">  </option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nimi'] . "</option>";}
?>            </select>
            
    </div> </div>       
            
    <div class="form-group row">           
		<label for="autor" class="col-4 col-form-label">Autor</label>
        <div class="col-8">
		<input type="text" name="autor" class="form-control form-control-sm" style="width:100%;" value='<?php echo $autor;?>'>
    </div> </div>
            
            
    <div class="form-group row">
		<label for="aasta" class="col-4 col-form-label">Ilmumisaasta</label>
        <div class="col-8">
        
		<input type="text" name="aasta" class="form-control form-control-sm" style="width:100%;" value=<?php echo $aasta;?>>
    </div></div>
            
            
    <div class="form-group row">    
        <label for="liik" class="col-4 col-form-label">Liik</label>   
        <div class="col-8">
        <?php
            $query = "SELECT * FROM liik";
            $result = mysqli_query($conn, $query); ?>
        <select id="liik" name="liik" class="form-control form-control-sm"  style="width:100%;">
           
        <?php
            while ($row = mysqli_fetch_array($result)) {
                 echo "<option value='" . $row['id'] . "'>" . $row['markused'] . "</option>";}
?>            </select>  
    </div> </div>
            
            
    <div class="form-group row">    
        <label for="keel" class="col-4 col-form-label">Keel</label> 
        <div class="col-8">
        <?php
            $query = "SELECT * FROM keel";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="keel" name="keel" class="form-control form-control-sm"  style="width:100%;">
            <option value=""><?php echo $keel;?>   </option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nimi'] . "</option>";}
?>            </select>
            
            
    </div> </div>
    <div class="form-group row">    
        <label for="valjaandja" class="col-4 col-form-label">Väljaandja</label>  
        <div class="col-8">
        <?php
            $query = "SELECT * FROM valjaandja";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="valjaandja" name="valjaandja"class="form-control form-control-sm" style="width:100%;" >
            <option value=""><?php echo $valjaandja;?></option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nimi'] . "</option>";}
?>           </select>          
 	 </div> </div>
            
            
	<div class="form-group row" >
      <label for="riiul" class="col-4 col-form-label">Riiul</label>
        <div class="col-8">
		<input type="text" name="riiul" class="form-control form-control-sm" style="width:100%;" value='<?php echo $riiul;?>'>
    </div> </div>
		
    <div class="form-group row">
	<label for="marksona"  class="col-4 col-form-label">Märksõna</label>
        <div class="col-8">
		 <?php
            $query = "SELECT * FROM marksona";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="marksona" name="marksona" class="form-control form-control-sm" style="width:100%;">
            <option value=""><?php echo $marksona;?> </option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['nimi'] . "'>" . $row['nimi'] . "</option>";}
?>            </select>      
    </div> </div>
            
            
    <div class="form-group row">    
        <label for="markused" class="col-4 col-form-label">Märkused</label>
        <div class="col-8">
		<input type="text" name="markused" class="form-control form-control-sm" style="width:100%;" value='<?php echo $markused;?>'>

    </div>	 </div>
    <div class="form-group row">  
        <input type="hidden" name="id" value='<?php echo $_GET['id'];?>'>
		<input type="submit" name="Submit" value="Muuda" class="btn btn-primary btn-sm">
    </div>
    	</fieldset>
	</form>
  </div>
 
    </div>
</body>
</html>