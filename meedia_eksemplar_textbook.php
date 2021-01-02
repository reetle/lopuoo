<?php
include_once("config.php");

?>
<!DOCTYPE html>
<html>
<head>

<title>Meedia eksemplar</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/jquery.tabledit.min.js"></script>
</head>
    <style>
   
            
        }
    </style>
<body> 
     <div class="container" >
         <div class="row" id="borrow" style="background-color:snow;">
             <div class="col"  style="margin-top:15px; font-size:12px;"  > 
  <?php  
             
$id = $_GET['id'];
    
$result = mysqli_query($conn, "SELECT * FROM meedia WHERE id=$id") ;
   
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<strong> ". $row["pealkiri"]. "</strong> <br>  " . $row["autor"]. "<br> " . $row["aasta"]."<br>";
  }
} 
?> 
        
  <br>
                 <strong>Eksemplarid: </strong>
<table id="editable_table"  class="table table-sm table-hover " style="font-size:12px;" >
     
    <thead>
		<tr>	

            <th style="visibility:hidden;">ID</th> 
		<th>Kuupäev</th> 
		<th>Saatedokument</th>
        <th>Kogus</th>
        <th>Hind</th>
        <th>Summa</th>
        <th>Markused</th>
        <th>Muuda/Kustuta</th>
  
        </tr>
        </thead>
    <tbody>
<?php
        
    
$id = $_GET['id'];
        
$sql= "select meedia_eksemplar.id, meedia_eksemplar.kuupaev, meedia_eksemplar.saatedokument, meedia_eksemplar.kogus, meedia_eksemplar.hind, meedia_eksemplar.kogus * meedia_eksemplar.hind as summa,
meedia_eksemplar.markused 
from (meedia_eksemplar
      left join meedia on meedia_eksemplar.meedia = meedia.id) where meedia.id=$id ";
   
$result = mysqli_query($conn, $sql) or die("error:".mysqli_error($conn));
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_array($result)) { 	
    echo '
  <tr>
   <td style="visibility:hidden;">'.$row["id"].'</td> 
	<td>'.$row["kuupaev"].'</td> 
	<td>'.$row["saatedokument"].'</td>
    <td>'.$row["kogus"].'</td>  
	<td>'.$row["hind"].'</td>  
    <td>'.$row["summa"].'<p> &euro;</p></td>  
	<td>'.$row["markused"].'</td> 
  </tr> '; }
  
 }
?>
        <!-- <p> &euro;</p>-->
    </tbody>

                 </table>
             </div> </div> 
 <!-- max inventari nr +1    -->            
<?php 
              
 
     ?> 
    <div class="row" id="borrow" style="background-color:snow;">         
  <div class="col"  style="margin-top:15px; font-size:12px;"  > 
        <div id="myDiv">
        <form action=" " method="post" style="margin-top:-25px; margin-left:10px;">   
  
   
    
        <input type="date" name="date" value="<?php echo date('Y-m-d');?>" size="25">
    
            <input type="text" name="saatdedokument" placeholder="saatedokument" size="20">
            <input type="text" name="kogus" placeholder="kogus" size="6"> 
            <input type="text" name="hind" placeholder="hind" size="6">
          
            
            <input type="text" name="markused" placeholder="Märkused" size="8">
       <br>
     <br>
       <input type ="submit" name="Submit" value="Salvesta"> 
      </form>    <br>
            </div>   
                 <input id="info" type="button" value="Lisa" class="btn btn-secondary btn-sm">  
                <button onclick="self.close()" class="btn btn-secondary btn-sm">Sulge</button>
<script>

var button = document.getElementById("info");
var myDiv = document.getElementById("myDiv");

function toggle() {
    myDiv.style.visibility = myDiv.style.visibility === "hidden" ? "visible" :  "hidden";
}

toggle();

button.addEventListener("click", toggle, false);
  </script>  

 <?php
    $id = $_GET['id']; 
    if(isset($_POST['Submit'])){
      
        $hind =  mysqli_real_escape_string($conn, $_POST['hind']);
        $kogus =  mysqli_real_escape_string($conn, $_POST['kogus']);
        $markused =  mysqli_real_escape_string($conn, $_POST['markused']);
        
        $result = mysqli_query($conn, "INSERT INTO meedia_eksemplar ( hind, kogus, meedia, markused) VALUES( '$hind', '$kogus','$id', '$markused') ");
        
        header("Refresh:0;");

	 mysqli_close($conn);

    }
?>


       
    
  
<div id="back_but">


 
 </div>        </div>   </div>   </div>  
</body>
</html>
<script>  //tabelis lives muutmine
$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'meedia_action_textbook.php',
        buttons: {
        edit: {
            html: ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" style="color:green"/>Muuda</svg>',
            action: 'edit'
        },

        delete: {
            html: ' <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"  /></svg>',
            action: 'delete'
		}
    },

	
		columns:{
       identifier:[0, "id"],
       editable:[[1, 'kuupaev'], 
                 [2, 'saatedokument'], 
                 [3, 'kogus'],
                 [4, 'hind'],  
                 [6, 'markused'],
       	   
	   
	   ]
      },

 restoreButton:false,

   onSuccess:function(data, textStatus, jqXHR)
    {
    if(data.action == 'delete')
    {
     $('#'+data.id).remove();
 }
   }
     });
 
});  
 </script>
<script src="js/sort.js"></script>