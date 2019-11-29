<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Upravljačka stranica menadžera</title>
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
        xmlhttp.open("GET", "pretraga_up_str.php?q=" + str, true);
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
                        <a href ="projekti_po_timovima.php"><button>Projekti</button></a>
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
                <div class="tabelaProPo">
                    <h3 class="dodavanjeNaslov">Korisnici:</h3>
                </div>

                <div class="tekst-sadrzaja">
                    <div>
                        <form>
                        Traženi korisnici: <input type="text" onkeyup="pretraga(this.value)">
                        </form>
                        <p>Pronađeni korisnici:<br/> <span id="trazeni"></span></p>
                    </div>
                <div class="tekst-sadrzaja">
                    <div class="tabelaProPo">
                        <h3 class="dodavanjeNaslov">Svi korisnici:</h3>
                    </div>
                    <table border = "2" width = "90%">
                    <tr>
                        <th>Ime korisnika</th>
                        <th>Ime tima</th>
                        <th>Ime projekta</th>
                        <th>Uloga u timu</th>
                        <th>Brisanje <br/>/ Izmene</th>
                    </tr>
                    <?php
                    include 'konekcija.php';

                    $upit = "SELECT * FROM `ucesce` ORDER BY `ime_tima`, `uloga`, `korisnicko_ime`, `ime_projekta` ASC";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $kor_iz_baz = $red['korisnicko_ime'];
                        $ime_tima = $red['ime_tima'];
                        $poz = $red['uloga'];
                        $ime_proje = $red['ime_projekta'];
                        echo "<tr><td><b>".ucfirst($kor_iz_baz)."</b></td>";
                        if($ime_tima == ""){
                            echo "<td><b><font color = 'red'>van tima</font></b></td>";
                        }
                        else{
                            echo "<td>".ucfirst($ime_tima)."</td>";
                        }
                        if($ime_proje == ""){
                            echo "<td><b><font color = 'red'>bez projekta</font></b></td>";
                        }
                        else{
                            echo "<td>".ucfirst($ime_proje)."</td>";
                        }
                        if($poz == "tim_lider"){
                            echo "<td><font color = 'red'><b>$poz</b></font></td>";
                        }
                        else{
                            echo "<td>$poz</td>";
                        }
                        echo "<td width = '70px'><a href = 'oduz_ul_timl_men.php?key=".$kor_iz_baz."'><img src = 'images/list_remove_user.png' alt = 'delete' border = '0'></img></a>";
                        echo "<a href = 'prerasporedje_kor.php?key=".$kor_iz_baz."'><img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a>";
                    }
                    mysqli_close($kon_sa_serv);

                    ?>
                    </table>
                </div>
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
