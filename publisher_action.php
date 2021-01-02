<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);

$nimi = mysqli_real_escape_string($conn, $input["nimi"]);
$aadress = mysqli_real_escape_string($conn, $input["aadress"]);
$linn = mysqli_real_escape_string($conn, $input["linn"]);
$maakond= mysqli_real_escape_string($conn, $input["maakond"]);
$postiindeks = mysqli_real_escape_string($conn, $input["postiindeks"]);
$telefon= mysqli_real_escape_string($conn, $input["telefon"]);
$markused = mysqli_real_escape_string($conn, $input["markused"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE valjaandja SET 
nimi = '".$nimi."', 
aadress  = '".$aadress ."' ,
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
 DELETE FROM valjaandja
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);

}

echo json_encode($input);

	
?>