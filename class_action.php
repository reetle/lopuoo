<?php
include_once("config.php");

$input = filter_input_array(INPUT_POST);

$klass = mysqli_real_escape_string($conn, $_POST['klass']);
		$taht = mysqli_real_escape_string($conn, $_POST['taht']);
		$klassijuhataja = mysqli_real_escape_string($conn, $_POST['klassijuhataja']);
		$klassiruum = mysqli_real_escape_string($conn, $_POST['klassiruum']);
		$markused = mysqli_real_escape_string($conn,  $_POST['markused']);

if($input["action"] === 'edit')
{
 $query = "
 UPDATE klass  SET 
klass = '".$klass."', 
taht = '".$taht."' ,
klassijuhataja = '".$klassijuhataja."', 
klassiruum = '".$klassiruum."' ,
markused = '".$markused."' 
 
 WHERE id = '".$input["id"]."'  ";

 mysqli_query($conn, $query);

}

if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM klass
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($conn, $query);

}

echo json_encode($input);

	
?>