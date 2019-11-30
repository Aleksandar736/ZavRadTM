<?php
include("sesija_tim_lidera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Tim lider (dodavanje projekata)</title>
</head>
<body>
    <?php
        include 'heder_tim_lidera.php';
    ?>    
    <div class="raspored-kolona">
        <div class="navigacija-sa-leve-strane">
            <table>
                <tr>
                    <td>
                        <a href ="tim_lider.php"><button>Glavna stranica tim lidera</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href ="projekat_tim_lidera.php"><button>Projekti</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "e_posta_tl.php"><button>Pošta</button></a>
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
                //Ako je kliknuto na taster otkaži (name=otkazi) vrati na prethodnu stranicu 
                if (isset($_POST['otkazi'])) {
                    echo "<script>location.href = 'projekat_tim_lidera.php'</script>";
                }//U suprotnom, ako je kliknuto na dodeli, dve varijable preuzimaju vrednosti iz forme
                else if (isset($_POST['dodeli'])) {
                    $un_zad = $_POST['un_zad'];
                    $un_ime = $_POST['un_ime'];
                    include 'konekcija.php';

                    $upit = "UPDATE `ucesce` SET `zadatak_clana` = '".$un_zad."' WHERE `korisnicko_ime` = '".$un_ime."'";
                    mysqli_query($kon_sa_serv, $upit);

                    $upit = "UPDATE `ucesce` SET `zavrsenost_zadatka_(%)` = 'na cekanju' WHERE `korisnicko_ime` = '".$un_ime."'";
                    mysqli_query($kon_sa_serv, $upit);

                    mysqli_close($kon_sa_serv);
                    print("<script>location.href = 'projekat_tim_lidera.php'</script>");
                }
                else{
                    $un_ime = $_REQUEST['key'];
                    $pri_kor = $_SESSION['korisnicko_ime'];
                    $opis ="";
                    include 'konekcija.php';

                    $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$pri_kor."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $im_tim = $red['ime_tima'];
                        $ime_proj = $red['ime_projekta'];
                    }

                    echo "<div class='tabelaProPo opis'>";
                    echo "<table>";                    
                    echo "<tr><td style='text-align: right'><b>Projekat:</b></td>";
                    echo "<td style='text-align: left'>".ucfirst($ime_proj)."</td></tr>";                    

                    $upit = "SELECT * FROM `projekti` WHERE `ime_projekta` = '".$ime_proj."'";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $opis = $red['opis_projekta'];
                    }
                  
                    echo "<tr><td style='text-align: right';><b>Opis:</b></td>";
                    echo "<td style='text-align: left'>".ucfirst($opis)."</td></tr>";
                    echo "</table>";
                    echo "</div>";

                    echo "<div class='tabelaProPo'>";
                    echo "<fieldset>";
                    echo "<form name='add_form' method='post' action='dodelj_zad_clanu.php'>";
                    echo "<table border = '0' width='70%'>";
                    echo "<tr><td style='text-align: right'><b>Član:</b></td>";
                    echo "<td colspan='3'><input name = 'un_ime' type = 'text' size='40' readonly = 'true' value = $un_ime></td>";
                    echo "</tr>";
                    echo "<tr><td style='text-align: right'><b>Zadatak:</b></td>";
                    echo "<td colspan='3'><input name = 'un_zad' type = 'text' size='40' value = ''></td>";
                    echo "<td colspan='3'><input name = 'skr_pro' type = 'hidden' value = $ime_proj></td>";
                    echo "</tr>";	
                    echo "<tr>";
                    echo "<td></td><td><input name = 'reset' type = 'reset' class='dugmici' value = 'Resetuj'></td>";
                    echo "<td><input name = 'otkazi' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                    echo "<td><input name = 'dodeli' type = 'submit' class='dugmici' value = 'Dodeli'></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</form>";
                    echo "</fieldset>";
                    echo "</div>";
                    mysqli_close($kon_sa_serv);
                }
                ?>
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

