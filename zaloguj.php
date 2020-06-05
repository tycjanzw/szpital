<?php
session_start();
require_once "connect.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
if($polaczenie->connect_errno!=0)
{
    echo "Error.: ".$polaczenie->connect_errno;
}
else{
    $login= $_POST['login'];
    $haslo = $_POST['haslo'];
    $wybor = $_POST['wybor'];
   

    
   
    if($wybor == '1'){
    
        $sql = " SELECT * FROM klient WHERE login ='$login';";

    if ($rezultat = @$polaczenie->query($sql))
    {
        $ilu_user = $rezultat->num_rows;
        if($ilu_user>0) 
        
        {
            
            $wiersz = $rezultat->fetch_assoc();
            $_SESSION['login'] = $wiersz['login'];
            $_SESSION['pesel'] = $wiersz['pesel'];
            $_SESSION['id'] = $wiersz['id'];

            $rezultat->free_result();

           header('location: panel_klient.php');

        }else{
            $_SESSION['blad']='<span style="color:red">Nieprawidlowy login lub haslo!</span>';
            header('location: log.php
            ');

        }
    }
 }

 if($wybor == '2'){
    
    $sql = " SELECT * FROM asystent WHERE login ='$login'; ";

if ($rezultat = @$polaczenie->query($sql))
{
    $ilu_user = $rezultat->num_rows;
    if($ilu_user>0) 
    
    {
        
        $wiersz = $rezultat->fetch_assoc();
        $_SESSION['login'] = $wiersz['login'];
        $_SESSION['pesel'] = $wiersz['pesel'];

        $rezultat->free_result();

       header('location: panel_asystent.php');

    }else{
        $_SESSION['blad']='<span style="color:red">Nieprawidlowy login lub haslo!</span>';
        header('location: log.php
        ');

    }
}
}

if($wybor == '3'){
    
    $sql = " SELECT * FROM weterynarz WHERE login ='$login'; ";

if ($rezultat = @$polaczenie->query($sql))
{
    $ilu_user = $rezultat->num_rows;
    if($ilu_user>0) 
    
    {
        
        $wiersz = $rezultat->fetch_assoc();
        $_SESSION['login'] = $wiersz['login'];
        $_SESSION['pesel'] = $wiersz['pesel'];

        $rezultat->free_result();

       header('location: panel_weterynarz.php');

    }else{
        $_SESSION['blad']='<span style="color:red">Nieprawidlowy login lub haslo!</span>';
        header('location: log.php
        ');

    }
}
}
    
    $polaczenie->close();
}







?>