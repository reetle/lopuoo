<?php  
include_once("config.php");
      //export.php  
 if(isset($_POST["export"]))  
 {  
 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('id, meedia_liik, pealkiri', 'andmekandja', 'autor', 'ilmumisaasta', 'liik', 'keel', 'valjaandja', 'kogus','riiul',' marksona', 'markused' ));  
      $query = "Select meedia.id, meedia.pealkiri, andmekandja.nimi as a, meedia.autor, meedia.aasta, meedia.keel, liik.nimi as l, keel.nimi as k, valjaandja.nimi as v, count(inventari_nr) as c, meedia.riiul, meedia.marksona, meedia.markused from (((((meedia LEFT join liik ON meedia.liik = liik.id) LEFT JOIN andmekandja on meedia.andmekandja=andmekandja.id) LEFT JOIN keel ON meedia.keel = keel.id) LEFT JOIN meedia_eksemplar ON meedia.id = meedia_eksemplar.meedia) LEFT JOIN valjaandja ON meedia.valjaandja =valjaandja.id) where meedia_liik like 'AV'" ; 
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
 ?>  