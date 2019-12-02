<?php
include("sesija_menadzera.php");

$msg = "";
$provera1 = false;
$provera2 = false;
//Sa stranice dodav_nov_kor.php kupi postovane vrednosti
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'konekcija.php';
    //Ako je kliknuto na Otkaži (name = cancel) onda ide preusmerenje na str. upravljacka_stranica.php
    if (isset($_POST['cancel'])) {
        print("<script>location.href = 'upravljacka_stranica.php'</script>");
    }
    //Sa stranice dodav_nov_kor.php kupi postovane vrednosti
    $subj_izm = $_POST['subj_izm'];
    $un_loz_nk = $_POST['un_loz_nk'];
    $un_imejl_nk = $_POST['un_imejl_nk'];    
    $izab_tim = $_POST['izab_tim'];
    $izab_ulog = $_POST['izab_ulog'];
    //Ako nije uneto korisničko ime na stranici dodav_nov_kor.php idu obaveštenje i preusmerenje na dodav_nov_kor.php
    if($subj_izm == ''){
        die("<script>alert('Unesite korisničko ime!')</script><script>location.href = 'dodav_nov_kor.php'</script>");
    }
    //Provera da li postoji korisnik sa tim kor_imenom
    $upit = "SELECT * FROM `ucesce`";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        if ($subj_izm == $red['korisnicko_ime']){
            $provera1 = true;
            break;
        }
    }
    //Ako postoji ide poruka o tome
    if ($provera1){
        $msg = 'Korisnik već postoji!';
        mysqli_close($kon_sa_serv);
    }
    else{//Provera da li izabrani tim ima tim lidera (kada je novi korisnik određen za tu ulogu)
        $upit2 = "SELECT * FROM `ucesce` WHERE `ime_tima` = '".$izab_tim."' AND `uloga` = 'tim_lider'";
        $result = mysqli_query($kon_sa_serv, $upit2);
        while($red = mysqli_fetch_assoc($result)){
            $led = $red['korisnicko_ime'];
            if($led != ""){
                $provera2 = true;
                break;
            }
        }
        //Ako postoji ide poruka o tome                
        if($izab_ulog == "tim_lider"){
            if($provera2){
                die("<script>alert('Tim već ima tim_lidera.')</script><script>location.href = 'dodav_nov_kor.php'</script>");
            }
        }
        //Verifikacija forme
        function test_input($unos) {
            $unos = trim($unos);
            $unos = stripslashes($unos);
            $unos = htmlspecialchars($unos);
            return $unos;
        }
        $subj_izm2 = test_input($subj_izm);
        $un_loz_nk2 = test_input($un_loz_nk);
        $un_imejl_nk2 = test_input($un_imejl_nk);        
        $izab_tim2 = test_input($izab_tim);
        $izab_ulog2 = test_input($izab_ulog);
        //Unos u tabelu korisnici unetih podataka (red sa podacima novog korisnika)
        $upit3 = "INSERT INTO `korisnici` (`korisnicko_ime`, `lozinka`, `imejl`) VALUES ('".$subj_izm2."', '".$un_loz_nk2."', '".$un_imejl_nk2."')";
        mysqli_query($kon_sa_serv, $upit3);
        //Unos u tabelu ucesce unetih podataka (red sa podacima novog korisnika)
        $upit4 = "INSERT INTO `ucesce` (`korisnicko_ime`, `ime_tima`, `uloga`) VALUES ('".$subj_izm2."', '".$izab_tim2."', '".$izab_ulog2."')";
        mysqli_query($kon_sa_serv, $upit4);
        //Ako je korisnik postavljen za tim lidera to se evidentira u tabeli timovi
        if($izab_ulog2 == "tim_lider"){
            $upit5 = "UPDATE `timovi` SET `tim_lider` = '".$subj_izm2."' WHERE `ime_tima` = '".$izab_tim2."'";
            mysqli_query($kon_sa_serv, $upit5);
        }

        mysqli_close($kon_sa_serv);
        $msg = 'Korisnik je uspešno dodat.';
    }
}

?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (dodavanje korisnika)</title>
</title>
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
                    <form name='ok_form' method='post' action='upravljacka_stranica.php'>
                        <input type = 'submit' name = 'ok' class="dugmici" value = 'OK'>
                    </form>
                </div>    
    
            </div>
        
        </div>
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "dodav_nov_kor.php"><button>Dodaj korisnika</button></a>
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

