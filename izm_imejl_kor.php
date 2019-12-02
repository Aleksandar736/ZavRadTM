<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (zamena korisnika)</title>
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

            <?php           
            //Validacija forme
            function test_input($unos) {
                $unos = trim($unos);
                $unos = stripslashes($unos);
                $unos = htmlspecialchars($unos);
                return $unos;
            }

            $msg = "";
            $provera = false;

            if (isset($_POST['cancel'])) {
                echo "<script>location.href = 'izm_profila_kor.php'</script>";
            }
            
            if (isset($_POST['change'])) {
                include 'konekcija.php';

                $novi_imejl_kor = $_POST['novi_imejl_kor'];
                $skrv_v = $_POST['skr_vred'];//Korisničko ime korisnika čije podatke menjamo

                //verifikacija forme
                $novi_imejl_kor = test_input($novi_imejl_kor);
                $skrv_v = test_input($skrv_v);	

                $upit = "UPDATE `korisnici` SET `imejl` = '".$novi_imejl_kor."' WHERE `korisnicko_ime` = '".$skrv_v."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                if($result){        
                    $msg = "Izmene su sačuvane.";
                }
                else{
                    $msg = "Došlo je do greške!";
                }
                mysqli_close($kon_sa_serv);
                
                echo "<div class='tekst-sadrzaja oAplikaciji'>";
                echo "<form name='ok_form' method='post' action='izm_profila_kor.php'>";
                echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                echo "</div>";
            }
            else{
                $kljuc_ime = $_REQUEST['key'];
                include 'konekcija.php';

                echo "<div class='dodavanjeNaslov'>";
                echo "Izmenite imejl korisnika:";
                echo "</div>";
                echo "<div class='tekst-sadrzaja'>";
                echo "<fieldset class='fildset2'>";
                echo "<form name='edit_form' method='post' action='izm_imejl_kor.php'>";
                echo "<table border = '0' >";
                echo "<tr><td><b>Izmeni imejl korisnika:</b></td>";
                echo "<td colspan='3'><input name = 'novi_imejl_kor' type = 'text' size='25' value = ''></td>";
                echo "<td><input name = 'skr_vred' type = 'hidden' value = $kljuc_ime></td>";
                echo "</tr>";
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

            <div class="tekst-sadrzaja">
                <div class="obavestenjeIzmene">
                    <?php echo $msg; ?>
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








