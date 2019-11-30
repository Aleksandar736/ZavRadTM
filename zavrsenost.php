<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Projekti (menadžer)</title>
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

                <div class="tekst-sadrzaja">
                    <h2 class="dodavanjeNaslov">Završenost u %:</h2>
                </div>

                <div class="tabelaProPo">
                    <table border = "2" width = "90%">
                    <tr>
                        <th>Tim</th>
                        <th>Tim_lider</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    include 'konekcija.php';

                    $upit = "SELECT * FROM `ucesce` WHERE `uloga` = 'tim_lider' ORDER BY `ime_tima` ASC";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $im_tim = $red['ime_tima'];
                        $kor_ime = $red['korisnicko_ime'];
                        echo "<tr><td><b>".ucfirst($im_tim)."</b></td>";
                        echo "<td>".ucfirst($kor_ime)."</td>";

                        $ukup = 0;
                        $brojac = 0;
                        $upit1 = "SELECT * FROM `ucesce` WHERE `ime_tima` = '".$im_tim."'";
                        $result1 = mysqli_query($kon_sa_serv, $upit1);
                        while ($red = mysqli_fetch_assoc($result1)) {
                            $zav_zad = $red['zavrsenost_zadatka_(%)'];
                            
                            if(is_numeric($zav_zad)){
                                $ukup = $ukup + $zav_zad;
                                $brojac = $brojac + 1;
                            }else{
                                $zav_zad = 0;
                                $ukup = 0;
                                $brojac = 0;
                            }
                        }//U sluč. većeg broja čla. izrač. aritmet. sredinu (/broj čla. - tim lider)
                        if($brojac > 1){
                            $ukup = $ukup / ($brojac - 1);
                        }
                        echo "<td>".round($ukup,2)." %</td>";
                    }

                    mysqli_close($kon_sa_serv);

                    ?>
                    </table>
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

