<?php
session_start();
if (isset($_POST['imie']))
{
    $wszystko_OK=true;
    $imie= $_POST['imie'];
    $rodzaj = $_POST['rodzaj'];
    $rasa = $_POST['rasa'];
    $waga = $_POST['waga'];
    $data = $_POST['data'];
    $login = $_SESSION['login'];
    $id_klient = $_SESSION['id'];
    $id_zwierze = 

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


             

              
                     if($wszystko_OK == true)
                      {
                     
                        if($polaczenie->query("INSERT INTO `zwierze`(`id`, `imie`, `typ`, `rasa`, `waga`, `data`, `klient_id`) VALUES (NULL,'$imie','$rodzaj','$rasa','$waga','$data','$id_klient')")) 
                        {
                            $_SESSION['udane'] = true;
                            header('Location: panel_klient.php');
                        }
                        else 
                        {
                            throw new Exception($polaczenie->error);
                        }
                          
                          
                        }


                    // $polaczenie->close();
                }



        }

        
        catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		

    if($wszystko_OK==true)
    { 
        // echo "udana walidacja!";
        //  exit();

    }
  


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylepanel-k.css">
</head>
<body>
<?php
echo"<div class='witaj-d'><p class='witaj'>Witaj ".$_SESSION['login']."! </p>"."<a href='wyloguj.php'>Wyloguj się</a></div>";

// echo"<p>id = ".$_SESSION['id']."! </p>";
?>

<p class="dodz">Dodaj swojego zwierzaka!</p>
<div class="dodajz">
 <form method="post">

Imie: <br/><input type="text" name="imie" placeholder="Imię twojego pupila" /><br/>
Rodzaj: <br/><input type="text" name="rodzaj" placeholder="Pies? Kot? Chomik?" /><br/>
Rasa:<br/><input type="text" name="rasa" /><br/>
Waga:<br/><input type="number" name="waga" placeholder="Kg"/><br/>
Data urodzenia:<br/><input type="date" name="data" /><br/>
<input type="submit" value="Dodaj zwierzaka" class="btn1">


 </form>
 </div>
 
 <p class="twzw">Twoje zwierzaki:</p>
<div>


<!-- twoje zwierzaki -->
<?php
 if ((!isset($_POST['imie']))) {
     
    require_once "connect.php";
    $polaczenie = new mysqli($host, $db_user, $db_password , $db_name);
    $historia = mysqli_query($polaczenie, 'SELECT * FROM zwierze WHERE zwierze.klient_id = '.$_SESSION['id'].'');

    if($historia->num_rows > 0)
    {
        
        while($row = $historia->fetch_assoc())
        {
            echo '<div class = "zwierzaki">'.'<p class ="zwierzaki">Imię: '.$row['imie'].'</p>'.'<p class ="zwierzaki">Rodzaj zwierzaka: '.$row['typ'].'</p>'.'<p class ="zwierzaki">Rasa: '.$row['rasa'].'</p>'.'<p class ="zwierzaki">Waga: '.$row['waga'].' kg'.'</p>'.'<p class ="zwierzaki">Data urodzenia: '.$row['data'].'</p>'.'</div>'.'
            <form method="post">
         <select class="select" name="usluga">
            <option value = "1">Szczepienie okresowe psa</option>
            <option value = "2">Podstawowe badanie</option>
            <option value = "3">Odrobaczanie</option>
            <option value = "4">Sterylizacja/kastracja</option>
            <option value = "5">Zwalczanie pcheł</option>
            <option value = "6">Konsultacja weterynaryjna</option>
            <option value = "7">Chipowanie</option>
            <option value = "8">Stomatolog</option>
        </select>
        <button type="submit" value="'.$row["id"].'" class="btn" name="wybor_uslugi">Zamów usługę</button>
        </form>';
            
                    
        }
    }else 
    {
        echo "<div><p class='brakzwierzaka'> Jeszcze nie posiadasz żadnych zwierzaków, dodaj swojego pupila za pomocą formularza</p></div>";
    }   

 }
?>


</div>

<div class="przycisk">
    <p class="przycisk-p">Wybierz usługę </p>



<div class="cennik1">
    <p class="cennik-p">szczepienie</p>
    <p class="cennik-p">kastracja</p>
    <p class="cennik-p">czipowanie</p>
    <p class="cennik-p">odrobaczanie</p>
    <p class="cennik-p">Sterylizacja</p>
    <p class="cennik-p">asdd</p>
    <p class="cennik-p">zxca</p>
    <p class="cennik-p">zxcasd</p>
    </div>
    <div class="cennik1">
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    <p class="cennik-c">60 zł</p>
    </div>

<div class="forma">
<?php
// DODANIE USŁUGI

$klient_id= $_SESSION['id'];
require_once "connect.php";

if(isset($_POST['wybor_uslugi']))
{
    $wybor_uslugi = $_POST['usluga'];
    $zwierzeId = $_POST['wybor_uslugi'];
//     echo "Dziala";
//    echo "$zwierzeId ";
//   echo "$wybor_uslugi";
     $sql = mysqli_query($polaczenie, 'INSERT INTO usluga_has_zwierze VALUES ('.$wybor_uslugi.','.$zwierzeId.')');
} 

//  HISTORIA USŁUG
// if(isset($_POST[''])){
$sql3 = mysqli_query($polaczenie, 'SELECT zwierze.imie, typ_uslugi, cena FROM usluga INNER JOIN usluga_has_zwierze ON usluga_has_zwierze.usluga_id = usluga.id INNER JOIN zwierze ON usluga_has_zwierze.zwierze_id = zwierze.id INNER JOIN klient ON klient.id = zwierze.klient_id WHERE klient.id = '.$klient_id.'');
// AND klient.id = '.$klient_id.'
if($sql3->num_rows > 0)
    {
          echo '<p class ="zwierzaki">Historia usług:';
        while($row = $sql3->fetch_assoc())
        {
            echo '<div class = "zwierzaki">'.'<p class ="zwierzaki">Imie zwierzaka: '.$row['imie'].'</p>'.'<p class ="zwierzaki">Typ uslugi: '.$row['typ_uslugi'].'</p>'.'<p class ="zwierzaki">cena: '.$row['cena'].'</div>';
            
                    
        }

    } 
    else {
        echo "To nie działa!";
    }
// }else{
    
//     echo "Nie masz żadnej usługi";

// }

?>
</div>
</div>








</body>

</html>