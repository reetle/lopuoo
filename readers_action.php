<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);


		$klass = mysqli_real_escape_string($conn, $_POST['klass']);
		$perekonnanimi = mysqli_real_escape_string($conn, $_POST['perekonnanimi']);
		$eesnimi = mysqli_real_escape_string($conn, $_POST['eesnimi']);
		$aadress = mysqli_real_escape_string($conn, $_POST['aadress']);
		$linn = mysqli_real_escape_string($conn, $_POST['linn']);
		$maakond = mysqli_real_escape_string($conn, $_POST['maakond']);
		$postiindeks = mysqli_real_escape_string($conn, $_POST['postiindeks']);
		$telefon = mysqli_real_escape_string($conn, $_POST['telefon']);
		$markused = mysqli_real_escape_string($conn, $_POST['markused']);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE lugeja SET 
klass='".$klass."', 
perekonnanimi = '".$perekonnanimi."', 
eesnimi = '".$eesnimi."' ,
aadress = '".$aadress."', 
linn = '".$linn."' ,
maakond = '".$maakond."', 
postiindeks = '".$postiindeks."' ,
telefon = '".$telefon."', 
markused = '".$markused."' 
 
 WHERE id = '".$input["id"]."'  ";

 mysqli_query($conn, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM lugeja 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);

}

echo json_encode($input);

	
?>