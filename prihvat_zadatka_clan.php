<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Projekat (obični član tima)</title>
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
        
            <div class="tekst-sadrzaja">

            <?php
            include 'konekcija.php';
                $ime_vo = "";
                $im_pro = "";
                $op_pro = "";
                //Tražimo tim u koji je raspoređen ulogovani obični član tima
                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$pri_kor."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $ime_ti = $red['ime_tima'];
                }            
                if($ime_ti != NULL){
                //Tražimo njegovog vođu tima
                $upit = "SELECT * FROM `ucesce` WHERE `ime_tima` = '".$ime_ti."' AND `uloga` = 'tim_lider'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $ime_vo = $red['korisnicko_ime'];
                }
                //Ako nema određenog tim lidera ide obaveštenje o tome            
                if($ime_vo == ""){
                    $ime_vo = 'Nemate tim lidera';
                }
                //Tražimo projekat na kome rade
                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime`= '".$ime_vo."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $im_pro = $red['ime_projekta'];
                }        
                //Ako nema određenog projekta ide obaveštenje o tome
                if($im_pro == ""){
                    $im_pro = "još uvek ne radite na projektu";
                }
                //Provera da li je već prihvaćen zadatak, ako jeste ide se autom. na stranu za ocenj.
                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$pri_kor."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $zav_za = $red['zavrsenost_zadatka_(%)'];
                }

                if($zav_za != 0){
                    die("<script>location.href = 'ocenj_zavrs_zad_clana.php'</script>");
                }
                //Tabela
                echo "<div class='dodavanjeNaslov opis'>";
                echo "<fieldset>";
                echo "<table border = '0' width = '350' bgcolor = 'white'>";
                echo "<tr><td style='text-align:left'><h5>Projekat:</font></h5>";            
                echo "<td style='text-align:left'>".ucfirst($im_pro)."</td></tr>";

                $upit = "SELECT * FROM `projekti` WHERE `ime_projekta` = '".$im_pro."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $op_pro = $red['opis_projekta'];
                }

                if($op_pro == ""){
                    $op_pro = "bez opisa";
                }

                echo "<tr><td style='text-align:left'><h5>Opis:</h5></td>";
                echo "<td style='text-align:left'>".ucfirst($op_pro)."</td></tr>";
                echo "<tr><td style='text-align:left'><h5>Tim lider:</h5></td>";
                echo "<td style='text-align:left'>".ucfirst($ime_vo)."</td></tr>";

                if (isset($_POST['obaves'])) {
                    $val = $_POST['skr_zad'];
                    $grp_tsk = $_POST['skr_proj'];

                    $upit = "UPDATE `ucesce` SET `zavrsenost_zadatka_(%)` = '10' WHERE `korisnicko_ime` = '".$pri_kor."'";
                    mysqli_query($kon_sa_serv, $upit);
                    mysqli_close($kon_sa_serv);

                    echo "<script>location.href = 'ocenj_zavrs_zad_clana.php'</script>";
                }

                else{
                    echo "<tr><td style='text-align:left'><h5>Vaš zadatak:</h5></td>";
                    //Provera da li ulogovani kor. član tima ima dodeljeni zadatak
                    $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$pri_kor."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $zad_clana = $red['zadatak_clana'];
                    }
                    if($zad_clana == ""){
                        $nema_zad = "Nije vam dodeljen zadatak";
                    }
                    else{
                        $nema_zad = "";
                    }
                    echo "<form name='notify_form' method='post' action='prihvat_zadatka_clan.php'>";
                    echo "<td style='text-align:left'>$nema_zad $zad_clana</td></tr>";
                    if($zad_clana == ""){
                        echo "<tr><td></td><td><input name = 'obaves' type = 'submit' class='dugmici' value = 'Prihvatam' disabled>";
                    }
                    else{
                        echo "<tr><td></td><td style='text-align:right'><input name = 'obaves' type = 'submit' class='dugmici' value = 'Prihvatam'>";
                    }
                    echo "<input name = 'skr_zad' type = 'hidden' value = $zad_clana>";
                    echo "<input name = 'skr_proj' type = 'hidden' value = $im_pro>";
                    echo "</form></td></tr></table>";
                    echo "</fieldset>";
                    echo "</div>";


                    echo "<div>";
                    echo "<font size = '2'><b>Kliknite na prihvatam, da biste obavestili svog tim lidera, da ste prihvatili zadatak.</b></font>";
                    echo "</div>";
                }                    
            }else{                
                echo "<div class='dodavanjeNaslov opis'>";
                echo "<fieldset>";
                echo "<table border = '0' width = '350' bgcolor = 'white'>";
                echo "<tr><td style='text-align:left'><h5>Projekat:</font></h5>";            
                echo "<td style='text-align:left'>Još uvek ne radite na projektu</td></tr>";
                echo "<tr><td style='text-align:left'><h5>Opis:</h5></td>";
                echo "<td style='text-align:left'>Nema opisa projekta</td></tr>";
                echo "<tr><td style='text-align:left'><h5>Tim lider:</h5></td>";
                echo "<td style='text-align:left'>Nemate tim lidera</td></tr>";
                echo "<form name='notify_form' method='post' action='prihvat_zadatka_clan.php'>";
                echo "<td></td><td style='text-align:left'>Nije vam dodeljen zadatak</td></tr>";
                echo "<tr><td></td><td><input name = 'obaves' type = 'submit' class='dugmici' value = 'Prihvatam' disabled>";
                echo "<input name = 'skr_zad' type = 'hidden' value = ''>";
                echo "<input name = 'skr_proj' type = 'hidden' value = ''>";
                echo "</form></td></tr></table>";
                echo "</fieldset>";
                echo "</div>";
                echo "<div>";
                echo "<font size = '2'><b style='color:red'>Nema zadatka koji biste prihvatili.</b></font>";
                echo "</div>";
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
