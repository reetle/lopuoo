<?php  
include_once("config.php");
      //export.php  
 if(isset($_POST["export"]))  
 {  
 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id, pealkiri', 'ilmumisaasta', 'liik', 'keel', 'valjaandja', 'nr','riiul',' marksona', 'markused' ));  
      $query = "select meedia.id,meedia.pealkiri, meedia.aasta, liik.nimi as l, keel.nimi as k, valjaandja.nimi as v, meedia.kogus, meedia.riiul, meedia.marksona, meedia.markused
from (((meedia
LEFT join  liik ON meedia.liik = liik.id)
LEFT JOIN keel ON meedia.keel = keel.id)
LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
where meedia_liik like 'PE'"; 
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  