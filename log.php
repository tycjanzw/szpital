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
<div>
<a href="rejestracja.php">Rejestracja</a>
</div>

<div>

    <form action="zaloguj.php" method="post" >
   
    <select name="wybor">
    <option value = "1">Klient</option>
    <option value = "2">Asystent</option>
    <option value = "3">Weterynarz</option>
    </select>
    <br />

        login: <br/> <input type="text" name="login" /> <br />
        hasło: <br/> <input type="password" name="haslo" /> <br />

        <input type="submit" value="zaloguj się">
        <br/>
        <?php

if(isset($_SESSION['blad']))

echo $_SESSION['blad']

?>

       
    </form>
    </div>
  

</body>
</html>