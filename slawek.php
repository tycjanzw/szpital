
<?php 


//Jeżeli ktoś nie zakupił jeszcze biletu. TO miejsce na historie
        if ((!isset($_POST['kupiony']))) {

            $historia = mysqli_query($con, 'SELECT bilety_id, cena, klasa, panstwo, miasto, lotnisko, IATA, czas_wylotu, czas_dotarcia, miasto FROM pasazerowie_has_bilety INNER JOIN bilety ON bilety.id = pasazerowie_has_bilety.bilety_id INNER JOIN miejsce ON miejsce.id = bilety.miejsce_przylotu INNER JOIN loty ON loty.id = bilety.loty_id  WHERE pasazerowie_has_bilety.pasazerowie_id = '.$_SESSION['id'].'' );

            if($historia->num_rows > 0)
            {
                echo '<h2 class= "bilet-info">Posiadasz już:</h2>'; 
                while($row4 = $historia->fetch_assoc())
                {
                    echo '<div class = "kontener2">'."<b class = 'colour'>Id biletu: </b>"."<i>".$row4['bilety_id']."</i>"."<b class = 'colour'> Cena: </b>".$row4['cena']."zł"."<b class = 'colour'> Klasa: </b>".$row4['klasa']."<b class = 'colour'>Czas wylotu: </b>".$row4['czas_wylotu']."<b class = 'colour'> Miasto docelowe: </b>".$row4['miasto']."<br></br>".'</div>';
                    
                }
               
            }else {
                echo "<h4 id = bilet-info>Jeszcze nie posiadasz żadnego biletu. Zapraszamy do zakupu<h4>";
            }   


           //OBSŁUGA ZAKUPU BILETU
        } else {
            $id_pasazera = $_SESSION['id'];
            $kupiony_bilet = $_POST['kupiony'];

            // Posiadasz już ten bilet? 
            $masz = mysqli_query($con,'SELECT * FROM `pasazerowie_has_bilety` WHERE bilety_id = '.$kupiony_bilet.' AND pasazerowie_id = '.$id_pasazera.'');
            
            if($masz->num_rows > 0)
            {
                while($sprawdzam = $masz->fetch_assoc()) {
                    if (($sprawdzam['bilety_id'] == $kupiony_bilet) && $id_pasazera == $sprawdzam['pasazerowie_id'])
                    {
                      echo "<h4 id = bilet-info>Posiadasz już ten bilet!<h4>";
                      exit();
                    }
                }
            }
          
            
            echo '<h4 id = bilet-info>Posiadasz bilet o id równym: '.$kupiony_bilet.'<h4>';
            echo '<h4 id = bilet-info>Twoje id: '.$id_pasazera.'<h4>';

            if (!$con) {
                die("Oops! Houston jest problem!: " . mysqli_connect_error());
              } 
               else {

                $sql = 'INSERT INTO `pasazerowie_has_bilety`(`pasazerowie_id`, `bilety_id`) VALUES ('.$id_pasazera.','.$kupiony_bilet.')';
                
                  if (mysqli_query($con, $sql)) {
               
                  echo "<script>alert('Dziękujemy za zakup biletu!')</script>";
                  } else {
                  echo "Błąd połączenia: " . $sql . "<br>" . mysqli_error($con);
                  }
  
              }
           


                mysqli_close($con);
        }
     
        ?>