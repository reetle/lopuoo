<?php
include_once("config.php");
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
    <form method="post" action=" " role="form" class="form-inline" style="margin-top:15px;" >
        <fieldset>
    <div class="form-group row">
		<label for="pealkiri" class="col-4 col-form-label" >Meedia liik</label>
        <div class="col-8">
		<select id="meedia_liik" name="meedia_liik" class="form-control form-control-sm" style="width:100%;"  required>
             <option value=""></option>
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
		<input type="text" name="pealkiri"  class="form-control form-control-sm" style="width:100%;" required>
    </div> </div>  
    <div class="form-group row">           
		<label for="klass" class="col-4 col-form-label">Klass</label>
        <div class="col-8">
		<input type="text" name="klass" class="form-control form-control-sm" style="width:100%;" >
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
		<input type="text" name="autor" class="form-control form-control-sm" style="width:100%;" >
    </div> </div>
            
    <div class="form-group row">
		<label for="aasta" class="col-4 col-form-label">Ilmumisaasta</label>
        <div class="col-8">
		<input type="text" name="aasta" class="form-control form-control-sm" style="width:100%;">
    </div></div>
            
    <div class="form-group row">    
        <label for="liik" class="col-4 col-form-label">Liik</label>   
        <div class="col-8">
        <?php
            $query = "SELECT * FROM liik";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="liik" name="liik" class="form-control form-control-sm"  style="width:100%;">
            <option value=""> </option> 
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
            <option value=""> </option> 
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
            <option value=""> </option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['nimi'] . "</option>";}
?>           </select>          
 	 </div> </div>
      
     <div class="form-group row" >
      <label for="riiul" class="col-4 col-form-label">Kogus</label>
        <div class="col-8">
		<input type="text" name="riiul" class="form-control form-control-sm" style="width:100%;">
    </div> </div>
            
	<div class="form-group row" >
      <label for="riiul" class="col-4 col-form-label">Riiul</label>
        <div class="col-8">
		<input type="text" name="riiul" class="form-control form-control-sm" style="width:100%;">
    </div> </div>
		
            
    <div class="form-group row">
	<label for="marksona"  class="col-4 col-form-label">Märksõna</label>
        <div class="col-8">
		 <?php
            $query = "SELECT * FROM marksona";
            $result = mysqli_query($conn, $query); ?>
       
        <select id="marksona" name="marksona" class="form-control form-control-sm" style="width:100%;">
            <option value=""> </option> 
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row['nimi'] . "'>" . $row['nimi'] . "</option>";}
?>            </select>      
    </div> </div>
            
            
    <div class="form-group row">    
        <label for="markused" class="col-4 col-form-label">Märkused</label>
        <div class="col-8">
		<input type="text" name="markused" class="form-control form-control-sm" style="width:100%;">

    </div>	 </div>
    <div class="form-group row">  
		<input type="submit" name="Submit" value="Lisa" class="btn btn-primary btn-sm">
    </div>
    	</fieldset>
	</form>
<?php
    if(isset($_POST['Submit'])) { 
        $meedia_liik =mysqli_real_escape_string($conn, $_POST['meedia_liik']);
		$pealkiri =mysqli_real_escape_string($conn, $_POST['pealkiri']);
		$klass = mysqli_real_escape_string($conn, $_POST['klass']);
        $andmekandja = mysqli_real_escape_string($conn, $_POST['andmekandja']);
        $autor = mysqli_real_escape_string($conn, $_POST['autor']);
		$aasta = mysqli_real_escape_string($conn, $_POST['aasta']);
		$liik = mysqli_real_escape_string($conn, $_POST['liik']);
		$keel= mysqli_real_escape_string($conn, $_POST['keel']);
		$valjaandja = mysqli_real_escape_string($conn, $_POST['valjaandja']);
		//$kogus = mysqli_real_escape_string($conn, $_POST['kogus']);
		$riiul = mysqli_real_escape_string($conn, $_POST['riiul']);
		$marksona = mysqli_real_escape_string($conn, $_POST['marksona']);
		$markused = mysqli_real_escape_string($conn, $_POST['markused']);
	
	$result = mysqli_query($conn, "INSERT INTO meedia (
    meedia_liik, 
    pealkiri,
    klass, 
    andmekandja,  
    autor, 
    aasta,
    liik,
    keel, 
    valjaandja, 
    riiul, 
    marksona, 
    markused) 
	VALUES(
    '$meedia_liik', 
    '$pealkiri',
    '$klass',
    '$andmekandja',   
    '$autor',
    '$aasta', 
    '$liik',
    '$keel',
    '$valjaandja',
    '$riiul',
    '$marksona',
    '$markused')");
		echo "<br> <p>Lisatud </p>";
	}                             
	 
	 mysqli_close($conn);
          
?>
          
    </div>
          <div class="row">
               <div class="col-2" style="margin-top:30px; margin-left:-35px;">
              
<a href="book_data.php" class="btn btn-primary btn-sm" role="button">Tagasi</a>
</div>
    </div>
    </div>
</body>
</html>