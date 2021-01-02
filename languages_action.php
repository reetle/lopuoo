<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);

$nimi = mysqli_real_escape_string($conn, $input["nimi"]);


if($input["action"] === 'edit')
{
 $query = "
 UPDATE keel SET 
nimi = '".$nimi."'


 
 WHERE id = '".$input["id"]."'  ";

 mysqli_query($conn, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM keel
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);

}

echo json_encode($input);

	
?>