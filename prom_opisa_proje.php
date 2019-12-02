<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (izmena opisa projekta)</title>
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
                //Ako je kliknuto na dugme Otkaži čije ime (name) inputa je cancel
                if (isset($_POST['cancel'])) {
                    echo "<script>location.href = 'vidi_projekte.php'</script>";
                }//U suprotnom ako je kliknuto na na dugme izmeni čije ime (name) inputa je change
                else if (isset($_POST['change'])) {
                    include 'konekcija.php';

                    $izm_proj = $_POST['izm_proj'];
                    $izm_opis = $_POST['izm_opis'];

                    //Validacija forme
                    $izm_proj = test_input($izm_proj);
                    $izm_opis = test_input($izm_opis);

                    $upit = "UPDATE `projekti` SET `opis_projekta` = '".$izm_opis."' WHERE `ime_projekta` = '".$izm_proj."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    if($result){
                        mysqli_close($kon_sa_serv);
                        $msg = "Izmene su sačuvane.";
                    }
                    else{
                        mysqli_close($kon_sa_serv);
                        $msg = "Izmene nisu sačuvane.";
                    }
                    echo "<div class='obavestenjeIzmene oAplikaciji'>";
                    echo "<form name='ok_form' method='post' action='vidi_projekte.php'>";
                    echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                    echo "</div>";
                }//U trenutku učitavanja stranica
                else{//$_REQUEST['key'] svoju vrednost uzima iz adrese na primer prom_opisa_proje.php?key=Administracija
                    $kljuc_pro = $_REQUEST['key'];
                    include 'konekcija.php';
                //Uzima vrednosti ime projekta i opis projekta iz tabele projekti 
                    $upit = "SELECT * FROM `projekti` WHERE `ime_projekta` = '".$kljuc_pro."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $izm_proj = $red['ime_projekta'];
                        $izm_opis = $red['opis_projekta'];
                    }
                    mysqli_close($kon_sa_serv);
                    //Tabela
                    echo "<div class='tabelaProPo'>";
                    echo "<h3 class='dodavanjeNaslov'>Izmeni opis projekta: </h3>";
                    echo "</div>";
                    echo "<div class='tabelaProPo'>";
                    echo "<fieldset class='fildset2'>";
                    echo "<form name='edit_form' method='post' action='prom_opisa_proje.php'>";
                    echo "<table border = '0' >";
                    echo "<tr><td><b>Projekat: </b></td>";
                    echo "<td colspan='3'><input name = 'izm_proj' type = 'text' size='29' value = '".$izm_proj."' readonly = 'true'></td>";
                    echo "</tr>";
                    echo "<tr><td style='text-align:right'><b>Opis: </b></td>";
                    echo "<td colspan='3'><textarea name = 'izm_opis' cols='30' rows='10'>$izm_opis</textarea>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td><input name = 'reset' type = 'reset' class='dugmici' value = 'Resetuj'></td>";
                    echo "<td><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                    echo "<td><input name = 'change' type = 'submit' class='dugmici' value = 'Izmeni'></td>";
                    echo "<td></td>";                    
                    echo "</tr>";
                    echo "</table>";
                    echo "</form>";
                    echo "</fieldset>";
                    echo "</div>";
                }

                ?>                
             
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

