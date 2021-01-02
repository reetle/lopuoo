<!DOCTYPE html>
<html>
<head>

<title>Sisukaart</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<style>
    .settings{
        font-size:13px;  
        margin-left: 25px;
       
    }
    .settings a{
        color:black;
    }
    .settings li{
      list-style-type:circle;
    }
</style>    
<body>
    <?php
include_once("header.php");
?>   
 	<div class="settings" >
        <p>Sisukaart</p>
        <ul> <li> <a href="menu.php">Avaleht</a> 
		<ul>
			<li> <a href="data.php"> Andmed </a> <ul>
			     <li> <a href="library_fund.php"> Raamatukogu fond </a> 
                <ul>
			             <li> <a href="book_data.php"> Raamatud </a> </li>  
			             <li> <a href="textbook_data.php"> Õpikud </a></li>
			             <li> <a href="periodicals_data.php">Perioodika </a></li>
			             <li> <a href="audio_data.php">Audio-Video</a></li>	
                         <li> <a href="workbook_data.php">Töövihikud</a></li>
			             <li> <a href="meth_library_data.php">Metoodiline kirjandus</a></li>	
                </ul>              
                </li>  
			     <li> <a href="readers.php"> Lugejad </a>
                     <ul>
                        <li> <a href="readers_data.php"> Lugejad</a></li>
			             <li> <a href="class_data.php">Klassid</a></li>								
		</ul>
                
                </li>
			     <li> <a href="additional_data.php">Lisaandmed</a>
                     <ul>
			             <li> <a href="author_data.php">Autorid</a> </li>  
			             <li> <a href="publisher_data.php">Väljaandja</a></li>
			             <li> <a href="type_data.php">Liigid</a></li>
                         <li> <a href="audio_video_type.php">Audio_video tüübid</a></li>
			             <li> <a href="met_library_type_data.php">Metoodilise kirjanduse tüübid</a></li>	
                         <li> <a href="languages_data.php">Keeled</a></li>
			             <li> <a href="keywords_data.php">Märksõnad</a></li>	
                </ul>    
                </li>				
		</ul></li>
			<li> <a href="doings.php"> Toimingud </a>
                <ul>
			             <li> <a href="borrow.php">Laenutamine</a> </li>  
			             <li> <a href="write_off.php">Mahakandmine</a></li>
                </ul>              
            </li>
			<li> <a href="statistics.php">Statistika </a></li>
			<li> <a href="settings.php">Programmi seaded </a></li>						
		</ul>
            </li>
        </ul>
       	 <a href="menu.php">Tagasi </a>
	</div> 

</body>
</html>