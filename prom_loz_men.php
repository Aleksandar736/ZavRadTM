<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Glavna stranica (menadžer)</title>
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
        
            <div class="pretragaPromenaItd">                
                <?php
                include 'konekcija.php';
                if (isset($_POST['edit'])) {
                        $star_loz = $_POST['star_loz'];
                        $nov_loz1 = $_POST['nov_loz1'];
                        $nov_loz2 = $_POST['nov_loz2'];
                        
                        $upit = "SELECT * FROM `korisnici` WHERE `korisnicko_ime` = '".$pri_kor."'";
                        $result = mysqli_query($kon_sa_serv, $upit);
                        while ($red = mysqli_fetch_assoc($result)) {
                            $loz_iz_b = $red['lozinka'];
                            
                            if ($star_loz == $loz_iz_b){
                                if($nov_loz1 == $nov_loz2){
                                    $upit = "UPDATE `korisnici` SET `lozinka` = '".$nov_loz1."' WHERE `korisnicko_ime` = '".$pri_kor."'";
                                    mysqli_query($kon_sa_serv, $upit);
                                    mysqli_close($kon_sa_serv);
                                    $msg = "Lozinka je promenjena.";
                                }
                                else{
                                    $msg = "Lozinke se razlikuju.";
                                }
                            }
                            else{
                                $msg = "Pogrešna lozinka.";
                            }
                        }
                }else{
                    $msg = "";
                }

                echo "<div>";
                echo "<fieldset>";
                echo "<form name='edit_form' method='post' action='prom_loz_men.php'>";
                echo "<table>";
                echo "<tr>";
                echo "<td style='text-align:right'><b>Lozinka:</b></td>";
                echo "<td><input name = 'star_loz' type = 'password' value = ''></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align:right'><b>Nova lozinka:</b></td>";
                echo "<td><input name = 'nov_loz1' type = 'password' value = ''></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td style='text-align:right'><b>Ponovi novu lozinku:</b></td>";
                echo "<td><input name = 'nov_loz2' type = 'password' value = ''></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td colspan = '2' style='text-align:right'><font color = 'red' size = '3'><b>$msg</b></font></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td></td>";
                echo "<td><input name = 'edit' type = 'submit' class='dugmici' value = 'Promena lozinke'></td>";
                echo "</tr>";
                echo "</table>";
                echo "</form>";
                echo "</fieldset>";
                echo "</div>";
                ?>
            </div>
        
        </div>
        <div class="navigacija-sa-desne-strane">
            <table>        
                <tr>
                    <td>
                        <a href = "izm_profila_kor.php"><button>Izmeni profil korisnika</button></a>
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

