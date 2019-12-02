<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (izmena naziva tima)</title>
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
                <?php
                //Validacija forme
                function test_input($unos) {
                    $unos = trim($unos);
                    $unos = stripslashes($unos);
                    $unos = htmlspecialchars($unos);
                    return $unos;
                }

                $msg = "";
                //Ako je kliknuto na Otkaži
                if (isset($_POST['cancel'])) {
                    print("<script>location.href = 'vidi_timove.php'</script>");
                }
                //Ako je kliknuto na promeni 
                if (isset($_POST['change'])) {
                    include 'konekcija.php';
                    //Preuzima vrednosti iz forme na dnu stranice
                    $im_tima = $_POST['n_ime_tima'];
                    $skrv_v = $_POST['skr_vred'];
                    
                    //verifikacija forme
                    $im_tima = test_input($im_tima);
                    $skrv_v = test_input($skrv_v);	
                    //Menja ime tima u tabeli timovi
                    $upit = "UPDATE `timovi` SET `ime_tima` = '".$im_tima."' WHERE `ime_tima` = '".$skrv_v."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    if($result){
                        $upit = "UPDATE `ucesce` SET `ime_tima` = '".$im_tima."' WHERE `ime_tima` = '".$skrv_v."'";
                        $result = mysqli_query($kon_sa_serv, $upit);         
                        $msg = "Izmene su sačuvane.";
                    }
                    else{
                        $msg = "Došlo je do greške!";
                    }
                    mysqli_close($kon_sa_serv);
                    echo "<div class='tekst-sadrzaja oAplikaciji'>";
                    echo "<form name='ok_form' method='post' action='vidi_timove.php'>";
                    echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                    echo "</div>";
                }
                else{
                    $kljuc_ime = $_REQUEST['key'];
                    include 'konekcija.php';

                    echo "<div class='dodavanjeNaslov'>";
                    echo "Izmenite naziv tima:";
                    echo "</div>";
                    echo "<div class='tekst-sadrzaja'>";
                    echo "<fieldset class='fildset2'>";
                    echo "<form name='edit_form' method='post' action='prom_imena_tima.php'>";
                    echo "<table border = '0' >";
                    echo "<tr><td><b>Tim:</b></td>";
                    echo "<td colspan='3'><input name = 'n_ime_tima' type = 'text' size='25' value = $kljuc_ime></td>";
                    echo "<td><input name = 'skr_vred' type = 'hidden' value = $kljuc_ime></td></tr>";
                    echo "<tr>";
                    echo "<td></td><td><input name = 'reset' type = 'reset' class='dugmici' value = 'Resetuj'></td>";
                    echo "<td><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                    echo "<td><input name = 'change' type = 'submit' class='dugmici' value = 'Izmeni'></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</form>";
                    echo "</fieldset>";
                    echo "</div>";
                }

                ?>
               
                <div class="obavestenjeIzmene">
                    <?php print $msg; ?>
                </div>
            </div>
        </div>
        
        <div class="navigacija-sa-desne-strane">
            
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>   
</body>
</html>
