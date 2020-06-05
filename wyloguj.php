<?php
 
 
 session_start();
 
session_destroy();
echo ("zostales wylogowany") ;
header('Location: log.php');
 
?>    