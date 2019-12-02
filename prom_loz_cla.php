<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">    
    <title>Glavna stranica (član tima)</title>
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

                <div class="tekst-sadrzaja">
                    <?php
                    echo "<h1>". ucfirst($pri_kor)."</h1>";
                    ?>
                </div>

                <div class="tekst-sadrzaja">
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
                echo "<form name='edit_form' method='post' action='prom_loz_cla.php'>";
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
                echo "<td colspan = '2' style='text-align:right'><font color = 'red'><b>$msg</b></font></td>";
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
        </div>
                   
        <div class="navigacija-sa-desne-strane">
            <table>           
                <tr>
                    <td>
                        <a href = "vidi_korisnike_clan.php"><button>Lista korisnika</button></a>
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

