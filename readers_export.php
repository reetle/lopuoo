<?php  
include_once("config.php");
      //export.php  
 if(isset($_POST["export"]))  
 {  
 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id, perekonnanimi', 'eesnimi', 'aadress', 'linn', 'maakond', 'postiindeks', 'telefon', 'markused' ));  
      $query = "SELECT lugeja.id, klass.klass as k, lugeja.perekonnanimi, lugeja.eesnimi, lugeja.aadress, lugeja.linn, lugeja.maakond, lugeja.postiindeks, lugeja.telefon, lugeja.markused from (lugeja LEFT join klass ON lugeja.klass = klass.id)"; 
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  