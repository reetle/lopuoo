<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);

$inventari_nr = mysqli_real_escape_string($conn, $input["inventari_nr"]);
$kuupaev = mysqli_real_escape_string($conn, $input["kuupaev"]);
$saatedokument = mysqli_real_escape_string($conn, $input["saatedokument"]);

$hind = mysqli_real_escape_string($conn, $input["hind"]);
$markused = mysqli_real_escape_string($conn, $input["markused"]);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE meedia_eksemplar SET 
inventari_nr = '".$inventari_nr."', 
kuupaev = '".$kuupaev."' ,
saatedokument = '".$saatedokument."', 
hind = '".$hind."', 
markused = '".$markused."' 
 
 WHERE id = '".$input["id"]."'  ";
    

 mysqli_query($conn, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM meedia_eksemplar
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);
   

}

echo json_encode($input);

	
?>