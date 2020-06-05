<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylelog.css">
    
</head>

  
<body>
<div class="nav">
    <a href="index.html" class="glow">Strona główna</a>
    <a href="specjalisci.html" class="spec">Specjaliści</a>
    <a href="log.php" class="log1">Logowanie</a>
  </div>

<div>
<a href="rejestracja.php">Rejestracja</a>
</div>

<div class="forma">

    <form action="zaloguj.php" method="post" >
   
    <select name="wybor">
    <option value = "1">Klient</option>
    <option value = "2">Asystent</option>
    <option value = "3">Weterynarz</option>
    </select>
    <br />

       <p> login:</p> <input type="text" name="login" /> 
        <p>hasło: </p> <input type="password" name="haslo" /> <br/>

        <input type="submit" value="zaloguj się" class="btn">
        
        <?php

if(isset($_SESSION['blad']))

echo $_SESSION['blad']

?>

       
    </form>
    </div>
  

</body>
</html>