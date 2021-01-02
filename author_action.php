<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);

$nimi = mysqli_real_escape_string($conn, $input["nimi"]);
$eesnimi = mysqli_real_escape_string($conn, $input["eesnimi"]);
$eluaastad = mysqli_real_escape_string($conn, $input["eluaastad"]);
$rahvus = mysqli_real_escape_string($conn, $input["rahvus"]);
$markused = mysqli_real_escape_string($conn, $input["markused"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE autor  SET 
nimi = '".$nimi."', 
eesnimi = '".$eesnimi."' ,
eluaastad = '".$eluaastad."' ,
rahvus = '".$rahvus."', 

markused = '".$markused."' 
 
 WHERE id = '".$input["id"]."'  ";

 mysqli_query($conn, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM autor
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);

}

echo json_encode($input);

	
?>