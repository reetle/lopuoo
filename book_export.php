<?php  
include_once("config.php");
      //export.php  
 if(isset($_POST["export"]))  
 {  
 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id, meedia_liik, pealkiri', 'autor', 'ilmumisaasta', 'liik', 'keel', 'valjaandja', 'kogus','riiul',' marksona', 'markused' ));  
      $query = "select meedia.id, meedia.pealkiri, meedia.autor, meedia.aasta, liik.nimi as l, keel.nimi as k, valjaandja.nimi as v, meedia.kogus, meedia.riiul, meedia.marksona, meedia.markused
      from (((meedia
      left join  liik ON meedia.liik = liik.id)
      left JOIN keel ON meedia.keel = keel.id)
      left JOIN valjaandja ON meedia.valjaandja =valjaandja.id)
      where meedia_liik like 'RA'"; 
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  