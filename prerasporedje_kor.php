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
                echo "<script>location.href = 'upravljacka_stranica.php'</script>";
            }

            if (isset($_POST['change'])) {
                include 'konekcija.php';

                $subj_iz = $_POST['kljuc'];
                $ime_tima = $_POST['ime_tima'];
                $poz = $_POST['uloga'];

                //Validacija forme
                $subj_iz = test_input($subj_iz);
                $ime_tima = test_input($ime_tima);
                $poz = test_input($poz);    

                //Provera da li izabrani tim već ima tim lidera
                $upit = "SELECT * FROM `ucesce` WHERE `ime_tima` = '".$ime_tima."' AND `uloga` = 'tim_lider'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while($red = mysqli_fetch_assoc($result)){
                    $lid = $red['korisnicko_ime'];
                    if($lid != ""){
                        $provera = true;
                    }
                }
                //ako ima onda...
                if($poz == "tim_lider"){
                    if($provera){
                        die("<script>alert('Tim već ima tim lidera.')</script><script>location.href = 'prerasporedje_kor.php?key=".$subj_iz."'</script>");
                        
                    }
                }
                //Ako je korisnik do sada bio na poziciji tim lidera u drugom timu uklanja ga sa te pozicije
                $upit = "UPDATE `timovi` SET `tim_lider` = '' WHERE `tim_lider` = '".$subj_iz."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                //Korisnik je raspoređen u tim i data mu je uloga
                $upit = "UPDATE `ucesce` SET `ime_tima` = '".$ime_tima."', `uloga` = '".$poz."' WHERE `korisnicko_ime` = '".$subj_iz."'";
                $result = mysqli_query($kon_sa_serv, $upit);

                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$subj_iz."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $poz = $red['uloga'];
                }
                if($poz == "tim_lider"){
                    $upit = "UPDATE `timovi` SET `tim_lider` = '".$subj_iz."' WHERE `ime_tima` = '".$ime_tima."'";
                    mysqli_query($kon_sa_serv, $upit);
                }
                else{
                    $upit = "UPDATE `ucesce` SET `ime_projekta` = '' WHERE `korisnicko_ime` = '".$subj_iz."'";
                    mysqli_query($kon_sa_serv, $upit);
                    $upit = "UPDATE `group_title` SET `tim_lider` = '' WHERE `tim_lider` = '".$subj_iz."'";
                    mysqli_query($kon_sa_serv, $upit);
                }
                //Polja namenjena izveštavanju o završenosti projekta se oslobađaju za nove podatke
                $upit = "UPDATE `ucesce` SET `zavrsenost_zadatka_(%)` = '', `zadatak_clana` = '' WHERE `korisnicko_ime` = '".$subj_iz."'";
                mysqli_query($kon_sa_serv, $upit);
                mysqli_close($kon_sa_serv);
                $msg = "Izmene su sačuvane.";
                echo "<div class='tekst-sadrzaja'>";
                echo "<form name='ok_form' method='post' action='upravljacka_stranica.php'>";
                echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                echo "</div>";
            }//Ako nije kliknuto na izmeni nego...
            else{
                $ime_kor_kljuc = $_REQUEST['key'];
                include 'konekcija.php';

                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$ime_kor_kljuc."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $subj_iz = $red['korisnicko_ime'];
                    $ime_tima = $red['ime_tima'];
                    $poz = $red['uloga'];
                }

                echo "<div class='tekst-sadrzaja'>";
                echo "<h3 class='dodavanjeNaslov'>Rasporedi korisnika:</h3>";
                echo "</div>";
                echo "<div class='tabelaProPo'>";
                echo "<fieldset class='fildset2'>";
                echo "<form name='edit_form' method='post' action='prerasporedje_kor.php'>";
                echo "<table border = '0' >";
                echo "<tr><td style='text-align: right'><b>Korisnik:</b></td>";
                echo "<td colspan ='3'><input name = 'kljuc' type = 'text' value = '".$subj_iz."' size='27' readonly = 'true'></td>";
                echo "</tr>";
                echo "<tr><td style='text-align: right'><b>Tim:</b></td>";
                echo "<td colspan ='3'><select name = 'ime_tima' class='selektovanje'>";
                echo "<option></option>"; 

                $upit = "SELECT * FROM `timovi` ORDER BY `ime_tima` ASC";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)){
                    $list = $red['ime_tima'];
                        echo "<option>$list</option>";
                }
                mysqli_close($kon_sa_serv);	

                echo "</td>";
                echo "</tr>";
                echo "<tr><td style='text-align: right'><b>Uloga:</b></td>";
                echo "<td colspan ='3'><select class='selektovanje' name = 'uloga'>";
                echo "<option></option>";    
                echo "<option>obicni_clan_tima</option>";
                echo "<option>tim_lider</option>";
                echo "<option>menadzer</option>";                
                echo "</select></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td></td><td><input name = 'reset' type = 'reset' class='dugmici' value = 'Resetuj'></td>";
                echo "<td><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                echo "<td><input name = 'change' type = 'submit' class='dugmici' value = 'Izmeni''></td><td></td>";
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
