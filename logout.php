<?php   
session_start(); //to same session
session_regenerate_id();
session_destroy(); 
header("location: index.php"); 
exit();
?>