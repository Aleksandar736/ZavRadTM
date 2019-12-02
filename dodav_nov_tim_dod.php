<?php
include("sesija_menadzera.php");

$msg = "";
$exist = false;
//Sa stranice dodav_nov_tim.php kupi postovane vrednosti
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'konekcija.php';
    //Ako je kliknuto na Otkaži (name = cancel) onda ide preusmerenje na str. vidi_timove.php
    if (isset($_POST['cancel'])) {
        echo "<script>location.href = 'vidi_timove.php'</script>";
    }
    //Sa stranice dodav_nov_tim.php kupi postovane vrednosti
    $tim = $_POST['ime_tima'];
    //Ako nije uneto ime tima na stranici dodav_nov_tim.php idu obaveštenje i preusmerenje na dodav_tim_kor.php
    if($tim == ''){
        die("<script>alert('Unesite ime tima!')</script><script>location.href = 'dodav_nov_tim.php'</script>");
    }
    //Provera da li postoji tim sa tim imenom
    $upit = "SELECT * FROM `timovi`";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        if ($tim == $red['ime_tima']){
            $exist = true;
            break;
        }
    }
    //Ako postoji ide poruka o tome
    if ($exist){
        $msg = 'Tim već postoji!';
        mysqli_close($kon_sa_serv);
    }
    else{//U suprotnom ide verifikacija forme i unos podataka u tabelu timovi
        function test_input($unos) {
            $unos = trim($unos);
            $unos = stripslashes($unos);
            $unos = htmlspecialchars($unos);
            return $unos;
        }
        $tim = test_input($tim);
        //Unos imena novog tima u tabelu timovi i obaveštenje o tome
        $upit = "INSERT INTO `timovi` (`ime_tima`) VALUES ('".$tim."')";
        $result = mysqli_query($kon_sa_serv, $upit);
        if($result){
            mysqli_close($kon_sa_serv);
            $msg = 'Tim je uspešno dodat.';
        }
        else{
            mysqli_close($kon_sa_serv);
            $msg = "Greška prilikom dodavanja tima";
        }
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (dodavanje timova)</title>
</head>
<body>
    <?php
        include 'heder_menadzera.php';
    ?>    
    <div class="raspored-kolona">
        <div class="navigacija-sa-leve-strane">
            <table>
                <tr>
                    <td>
                        <a href ="menadzer.php"><button>Glavna stranica menadžera</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href ="upravljacka_stranica.php"><button>Upravljačka stranica</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href ="projekti_po_timovima.php"><button>Projekti po timovima</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href ="e_posta_men.php"><button>Pošta</button></a>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="glavni-sadrzaj">
            <div class="glavni-naslov">
                <h1>Tim Menadžment</h1>
            </div>
        
            <div class="tekst-sadrzaja">                      
                <div class="obavestenjeIzmene oAplikaciji">
                    <?php echo $msg; ?><!-- Štampa odgovarajuću poruku -->
                </div>
                <div class="obavestenjeIzmene"><!-- Taster Ok, koji nakon klika na njega preusmerava -->
                    <form name='ok_form' method='post' action='vidi_timove.php'>
                        <input type = 'submit' name = 'ok' class="dugmici" value = 'OK'>
                </div>                                    
            </div>       
        </div>
        
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "dodav_nov_tim.php"><button>Dodaj novi tim</button></a>
                    </td>
                </tr>             
            </table>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>      
</body>
</html>

