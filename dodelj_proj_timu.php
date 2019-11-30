<?php
include("sesija_menadzera.php");

$msg = "";
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (dodeljivanje projekata timovima)</title>
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
            if (!isset($_POST['set'])) {
                $sel_imekori = $_REQUEST['key'];
                include 'konekcija.php';
                //Tražimo ime tima čiji je selektovani korisnik tim lider
                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$sel_imekori."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)){
                    $tim = $red['ime_tima'];
                    $sel_imekori2 = $red['korisnicko_ime'];
                }

                echo "<div class='tabelaProPo'>";
                echo "<h3 class='dodavanjeNaslov'>Dodeli projekat timu:<h3>";
                echo "</div>";
                echo "<div class='tekst-sadrzaja'>";
                echo "<fieldset class='fildset2'>";
                echo "<form name='add_group_task_form' method='post' action='dodelj_proj_timu.php'>";
                echo "<table border = '0'>";
                echo "<tr><td style='text-align: right'><b>Tim:</b></td>";
                echo "<td colspan='2'><input name = 'im_tim' type = 'text' size='32' value = '".$tim."' readonly = 'true'></td>";
                echo "</tr>";
                echo "<tr><td style='text-align: right'><b>Tim lider:</b></td>";
                echo "<td colspan='2'><input name = 'sel_im' type = 'text' size='32' value = '".$sel_imekori2."' readonly = 'true'></td>";
                echo "</tr>";
                echo "<tr><td style='text-align: right'><b>Projekat:</b></td>";
                echo "<td colspan='2'><select name = 'sel_pro' class='selektovanje'>";
                //Tražimo postojeće projekte koji su na raspolaganju za dodelu timu koji vodi korisnik-ključ
                $upit1 = "SELECT * FROM `projekti` ORDER BY `ime_projekta` ASC";
                $result1 = mysqli_query($kon_sa_serv, $upit1);
                while ($red = mysqli_fetch_assoc($result1)){
                    $lista = $red['ime_projekta'];
                    echo "<option>$lista</option>";
                }
                mysqli_close($kon_sa_serv);

                echo "</select></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td></td><td><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                echo "<td><input name = 'set' type = 'submit' class='float-right dugmici' value = 'Postavi'></td>";
                echo "</tr>";
                echo "</table>";
                echo "</form>";
                echo "</fieldset>";
                echo "</div>";


                if (isset($_POST['cancel'])) {
                    echo "<script>location.href = 'projekti_po_timovima.php'</script>";
                }
            }
            else{
                $sel_imekori2 = $_POST['sel_im'];
                $tim = $_POST['im_tim'];
                $tim_pro = $_POST['sel_pro'];
                include 'konekcija.php';

                $upit = "UPDATE `ucesce` SET `ime_projekta` = '".$tim_pro."' WHERE `korisnicko_ime` = '".$sel_imekori2."'";
                $result = mysqli_query($kon_sa_serv, $upit);

                if($result){
                    mysqli_close($kon_sa_serv);
                    $msg = "Projekat je dodeljen timu <span class='obavestenjeZamena'>".$tim."</span>.";
                }
                else{
                    mysqli_close($kon_sa_serv);
                    $msg = "Greška prilikom dodeljivanja projekta timu!";
                }
                echo "<div class='obavestenjeIzmene oAplikaciji'>";
                echo "<form name='ok_form' method='post' action='projekti_po_timovima.php'>";
                echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                echo "</div>";
            }

            ?>                
                
                <div class="obavestenjeZamena">
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
