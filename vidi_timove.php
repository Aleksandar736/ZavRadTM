<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Glavna stranica menadžera</title>
    <script>
    function pretraga(str) {
      if (str.length == 0) {
        document.getElementById("trazeni").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("trazeni").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "pretraga_timova.php?q=" + str, true);
        xmlhttp.send();
      }
    }
    </script>
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
        
            <div class="tekst-sadrzaja oAplikaciji">
                <div class="tabelaProPo">
                    <h3 class="dodavanjeNaslov">Timovi:</h3>
                </div>
                
                <div class="tekst-sadrzaja">
                    <form>
                    Traženi timovi: <input type="text" onkeyup="pretraga(this.value)">
                    </form>
                    <p>Pronađeni timovi:<br/> <span id="trazeni"></span></p>
                </div>
                
                <div class="tabelaProPo">
                    <h2 class="dodavanjeNaslov">Svi timovi:</h2>
                </div>

                <div class="tabelaProPo">
                    <table border = "2" width = "90%">
                        <tr>
                            <th>Timovi</th>
                            <th>Tim lideri</th>
                            <th>Članovi tima</th>
                            <th>Napravi izmenu</th>
                        </tr>
                        <?php
                        include 'konekcija.php';

                        $upit = "SELECT * FROM `timovi`";
                        $result = mysqli_query($kon_sa_serv, $upit);

                        while ($red = mysqli_fetch_assoc($result)) {
                            $ime_tima = $red['ime_tima'];
                            $tim_lider = $red['tim_lider'];
                            
                            echo"<tr><td><b>".ucfirst($ime_tima)."</b></td>";
                            if($tim_lider == ""){
                                echo"<td><b><font color = 'red'>bez tim lidera</font></b></td>";	
                            }
                            else{
                                echo"<td>".ucfirst($tim_lider)."</td>";
                            }
                            echo"<td>";
                            if($ime_tima !='menadzeri'){
                                $upit1 = "SELECT `korisnicko_ime` FROM `ucesce` WHERE `ime_tima` = '".$ime_tima."' AND `uloga` = 'obicni_clan_tima'";
                                $result1 = mysqli_query($kon_sa_serv, $upit1);
                                while ($red = mysqli_fetch_assoc($result1)) {
                                    $kor_im = $red['korisnicko_ime'];
                                    echo ucfirst($kor_im).', ';
                                }                            
                            }else{
                                $upit1 = "SELECT `korisnicko_ime` FROM `ucesce` WHERE `ime_tima` = 'menadzeri'";
                                $result1 = mysqli_query($kon_sa_serv, $upit1);
                                    while ($red = mysqli_fetch_assoc($result1)) {
                                        $kor_im = $red['korisnicko_ime'];
                                        echo ucfirst($kor_im).', ';
                                    }
                                }
                            echo "</td>";
                            echo "<td><a href = 'bris_tim.php?key=".$ime_tima."'><img src = 'images/garbage.png' alt = 'delete' border = '0'></a>";
                            echo "<a href = 'prom_imena_tima.php?key=".$ime_tima."'><img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></a>";
                        }
                        mysqli_close($kon_sa_serv);
                            
                        ?>
                    </table>
                </div>            
            </div>       
        </div>
        
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "dodav_nov_kor.php"><button>Dodaj korisnika</button></a>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <a href = "dodav_nov_tim.php"><button>Dodaj novi tim</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "dodav_nov_proj.php"><button>Dodaj novi projekat</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "vidi_timove.php"><button>Vidi timove</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "vidi_projekte.php"><button>Vidi projekte</button></a>
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

