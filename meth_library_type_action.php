<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);

$nimi = mysqli_real_escape_string($conn, $input["nimi"]);
$markused = mysqli_real_escape_string($conn, $input["markused"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE andmekandja  SET 
nimi = '".$nimi."', 

markused = '".$markused."' 
 
 WHERE id = '".$input["id"]."'  ";

 mysqli_query($conn, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM andmekandja
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);

}

echo json_encode($input);

	
?>