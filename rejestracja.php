<?php
session_start();
if (isset($_POST['email']))
{
    $wszystko_OK=true;
    $login = $_POST['login'];
    $haslo1 = $_POST['haslo1'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $email = $_POST['email'];
    $miasto = $_POST['miasto'];
    $adres = $_POST['adres'];
    $data = $_POST['data'];
   $_SESSION['login'] = $login;
    
    if ((strlen($login)<3) || (strlen($login)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_login']="login musi posiadac od 3 do 20 znaków!";
    }

    if (ctype_alnum($login)==false)
    {
        $wszystko_OK=false;
        $_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków)";
    }

    $email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail!";
		}
$haslo1 = $_POST['haslo1'];
if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
{
    $wszystko_OK=false;
			$_SESSION['e_haslo']="hasło musi posiadac od 8 do 20 znaków";
}



require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
        try {
            $polaczenie = new mysqli($host, $db_user, $db_password , $db_name);
            
            if($polaczenie->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                } 
                
                // polacz dziala
                else {


                //    email
                    $rezultat = $polaczenie->query("SELECT id FROM klient WHERE email = '$email'");

                    if(!$rezultat) throw new Exception($polaczenie->error);

                    $ile_takich_maili = $rezultat->num_rows;
                    
                    if($ile_takich_maili>0)
                    {
                        $wszystko_OK = false;
                        $_SESSION['e_email'] = "<span style='color:red;'> Email $email jest już zajęty!</span>";
                    }



                //   login
                    $rezultat = $polaczenie->query("SELECT id FROM klient WHERE login = '$login'");

                    if(!$rezultat) throw new Exception($polaczenie->error);

                    $ile_takich_loginow = $rezultat->num_rows;
                    
                    if($ile_takich_loginow>0)
                    {
                        $wszystko_OK = false;
                        $_SESSION['e_login'] = "<span style='color:red;'>Login $login jest już zajęty!</span>";
                    }

              
                     if($wszystko_OK == true)
                      {
                        if($polaczenie->query("INSERT INTO klient VALUES(NULL, '$imie', '$nazwisko', '$email','$data','$miasto','$adres','$login','$haslo1')")) 
                        {
                            $_SESSION['udane'] = true;
                            header('Location: log.php');
                        }
                        else {
                            throw new Exception($polaczenie->error);
                        }
                          
                          
                        }


                    $polaczenie->close();
                }



        }
       
			
		
        
        catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
		
      





    if($wszystko_OK==true)
    { 
        echo "udana walidacja!";
         exit();

    }
  


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylerej.css">
<style>

    
.error{
text-align: left;
color:red;
margin-top: 10px;
margin-bottom:10px;
font-size: 12px;
}


</style>


</head>



<body>
<div>
<a href="log.php">Zaloguj się</a>
</div>
    <div>



 <form method="post">

Login:<br/><input type="text" name="login" placeholder="Twój login" /><br/>
<?php

if(isset($_SESSION['e_login'])){
    echo '<div class="error">'.$_SESSION['e_login'].'</div>';
    unset($_SESSION['e_login']);
}

?>

Hasło:<br/><input type="password" name="haslo1" placeholder="Twoje hasło" /><br/>
<?php

if(isset($_SESSION['e_haslo'])){
    echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
    unset($_SESSION['e_haslo']);
}

?>

Imię: <br/><input type="text" name="imie" /><br/>
Nazwisko:<br/><input type="text" name="nazwisko" /><br/>
E-mail:<br/><input type="email" name="email" /><br/>
<?php

if(isset($_SESSION['e_email'])){
    echo '<div class="error">'.$_SESSION['e_email'].'</div>';
    unset($_SESSION['e_email']);
}

?>
Data urodzenia:<br/><input type="date" name="data" /><br/>
Miasto:<br/><input type="text" name="miasto" /><br/>
Adres:<br/><input type="text" name="adres" /><br/>

<input type="submit" value="Zarejestruj się" class="btn">


 </form>
</div>
</body>
</html>