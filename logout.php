<?php
 session_start();
    // Lõpeta session
    if(session_destroy()) {    
        header("Location: index.php");
    }
?>