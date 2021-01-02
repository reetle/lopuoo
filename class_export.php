<?php  
include_once("config.php");
      //export.php  
 if(isset($_POST["export"]))  
 {  
 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id, klass', 'taht', 'klassijuhataja', 'klassiruum', 'markused' ));  
      $query = "SELECT * FROM klass"; 
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  