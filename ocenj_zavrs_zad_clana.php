<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Zadatak (obični član tima)</title>
</head>
<body>
    <?php
        include 'heder_obi_clana.php';
    ?> 
    <div class="raspored-kolona">
        <div class="navigacija-sa-leve-strane">
        <table>
                <tr>
                    <td>
                        <a href ="obicni_clan.php"><button>Glavna stranica člana tima</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href ="prihvat_zadatka_clan.php"><button>Projekti</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "e_posta_clan.php"><button>Pošta</button></a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="glavni-sadrzaj">
            <div class="glavni-naslov">
                <h1>Tim Menadžment</h1>
            </div>
        
            <div class="oAplikaciji">
            <?php
            include 'konekcija.php';

            $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$pri_kor."'";
            $result = mysqli_query($kon_sa_serv, $upit);
            while ($red = mysqli_fetch_assoc($result)) {
                $ime_ti = $red['ime_tima'];
                $zavr_zad = $red['zavrsenost_zadatka_(%)'];
                $dod_zad = $red['zadatak_clana'];

                if($zavr_zad == 0){
                    $zavr_zad = "u pripremi";
                }
                else if($zavr_zad == 10){
                    $zavr_zad = "10";
                }
                else if($zavr_zad == 100){
                    $zavr_zad = "zadatak izvršen";
                }
                else{
                    $zavr_zad = $zavr_zad."%";
                }
            }

            $upit = "SELECT * FROM `ucesce` WHERE `ime_tima` = '".$ime_ti."' AND `uloga` = 'tim_lider'";
            $result = mysqli_query($kon_sa_serv, $upit);
            while ($red = mysqli_fetch_assoc($result)) {
                $ime_vo = $red['korisnicko_ime'];
            }

            $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$ime_vo."'";
            $result = mysqli_query($kon_sa_serv, $upit);
            while ($red = mysqli_fetch_assoc($result)) {
                $im_pro = $red['ime_projekta'];
            }

            if($im_pro == ""){
                $im_pro = "još uvek niste dobili zadatak";
            }

            echo "<div class='dodavanjeNaslov opis'>";
            echo "<fieldset>";
            echo "<table border = '0' width = '350' bgcolor = 'white'>";
            echo "<tr><td style='text-align:left'><h5>Projekat:</h5></td>";            
            echo "<td style='text-align:left'>".ucfirst($im_pro)."</td></tr>";

            $upit = "SELECT * FROM `projekti` WHERE `ime_projekta` = '".$im_pro."'";
            $result4 = mysqli_query($kon_sa_serv, $upit);
            while ($red = mysqli_fetch_assoc($result4)) {
                $opis_pro = $red['opis_projekta'];
            }

            if($opis_pro == ""){
                $opis_pro = "bez opisa";
            }
        
            echo "<tr><td style='text-align:left'><h5>Opis:</h5></td>";
            echo "<td style='text-align:left'>".ucfirst($opis_pro)."</td></tr>";          
            echo "<tr><td style='text-align:left'><h5>Tim lider:</h5></td>";
            echo "<td style='text-align:left'>".ucfirst($ime_vo)."</td></tr>";       
            echo "<tr><td style='text-align:left'><h5>Vaš zadatak:</h5></td>";
            echo "<td style='text-align:left'>".ucfirst($dod_zad)."</td></tr>";          
            echo "<tr><td style='text-align:left'><h5>Poslednja ocena:</h5></td>";
            echo "<td style='text-align:left'><b>$zavr_zad</b></td></tr>";
            echo "</table>";
            echo "</fieldset>";
            echo "</div>";


            if (isset($_POST['pov_oba'])) {
                $unos_oce = $_POST['oc_zav_zad'];

                $upit = "UPDATE `ucesce` SET `zavrsenost_zadatka_(%)` = '".$unos_oce."' WHERE `korisnicko_ime` = '".$pri_kor."'";
                mysqli_query($kon_sa_serv, $upit);

                mysqli_close($kon_sa_serv);

                echo "<div>";
                echo "<h5>Vaša ocena je poslata.</h5>";
                echo "<form name='ok_form' method='post' action='ocenj_zavrs_zad_clana.php'>";
                echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                echo "</div>";
            }
            else{
                echo "<div>";
                echo "<table border = '0'>";
                echo "<tr><th colspan = '7'>";
                echo "<h5>Ocenite završenost svog zadatka.</h5><th></tr>";
                echo "<tr><form name='fback_form' method='post' action='ocenj_zavrs_zad_clana.php'>";
                echo "<td><input type='radio' name='oc_zav_zad' value='0' checked> u pripremi </td>";
                echo "<td><input type='radio' name='oc_zav_zad' value='20'> 20% </td>";
                echo "<td><input type='radio' name='oc_zav_zad' value='40'> 40% </td>";
                echo "<td><input type='radio' name='oc_zav_zad' value='60'> 60% </td>";
                echo "<td><input type='radio' name='oc_zav_zad' value='80'> 80% </td>";
                echo "<td><input type='radio' name='oc_zav_zad' value='100'> izvršen </td>";
                echo "<td><input type='submit' name='pov_oba' class='dugmici' value='Pošalji'></td>";
                echo "</form></tr></table></div>";
            }
            ?>
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

