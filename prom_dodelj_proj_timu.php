<?php
include("sesija_menadzera.php");

$msg = "";
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (zamena projekta)</title>
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
                <div class="oAplikaciji">               
                <?php
                if (isset($_POST['cancel'])) {
                    echo "<script>location.href = 'projekti_po_timovima.php'</script>";
                }

                else if (isset($_POST['change'])) {
                    include 'konekcija.php';

                    $proje_ti = $_POST['pro_gru'];
                    $ime_li = $_POST['ime_vo'];

                    $upit = "UPDATE `ucesce` SET `ime_projekta` = '".$proje_ti."' WHERE `korisnicko_ime` = '".$ime_li."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    if($result){
                        mysqli_close($kon_sa_serv);
                        $msg = "Izmene su sačuvane.";
                        }
                        else{
                        mysqli_close($kon_sa_serv);
                        $msg = "Izmene nisu sačuvane.";
                        }
                    echo "<div class='zavrsenostNaslov'>";
                    echo "<form name='ok_form' method='post' action='projekti_po_timovima.php'>";
                    echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                    echo "</div>";
                }
                else{
                    $ime_li = $_REQUEST['key'];
                    include 'konekcija.php';

                    $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$ime_li."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                    $tim_im = $red['ime_tima'];
                    $proje_ti = $red['ime_projekta'];
                    }

                    echo "<div class='tabelaProPo'>";
                    echo "<h3 class='dodavanjeNaslov'>Zameni projekat:</h3>";
                    echo "</div>";
                    echo "<div class='tekst-sadrzaja'>";
                    echo "<fieldset class='fildset2'>";
                    echo "<form name='edit_form' method='post' action='prom_dodelj_proj_timu.php'>";
                    echo "<table border = '0' >";
                    echo "<tr><td style='text-align: right'><b>Tim:</b></td>";
                    echo "<td colspan='3'><input name = 'grup_im' type = 'text' size='32' value = '".$tim_im."' readonly = 'true'></td>";
                    echo "</tr>";
                    echo "<tr><td style='text-align: right'><b>Tim lider:</b></td>";
                    echo "<td colspan='3'><input name = 'ime_vo' type = 'text' size='32' value = '".$ime_li."' readonly = 'true'></td>";
                    echo "</tr>";
                    echo "<tr><td style='text-align: right'><b>Projekat:</b></td>";
                    echo "<td colspan='3'><select class='selektovanje' name = 'pro_gru'>";
                    echo "<option></option>";

                    $upit = "SELECT * FROM `projekti` ORDER BY `ime_projekta` ASC";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)){
                        $list = $red['ime_projekta'];
                        echo "<option>$list</option>";
                    }
                    mysqli_close($kon_sa_serv);

                    echo "</select></td>";
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
                </div>
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

