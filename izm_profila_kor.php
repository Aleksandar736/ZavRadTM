<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Spisak korisnika (menadžer)</title>
    <script>
    function prikazMogu(str) {
      if (str.length == 0) {
        document.getElementById("ispMog").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ispMog").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "pretr_izm_prof_kor.php?q=" + str, true);
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
        
            <div class="tekst-sadrzaja">
                <div class="pretragaPromenaItd">
                    <h3 class="dodavanjeNaslov">Korisnici:</h3>
                </div>
                <div class="tekst-sadrzaja">
                    <div>
                        <form>
                        Traženi korisnici: <input type="text" onkeyup="prikazMogu(this.value)">
                        </form>
                        <p>Pronađeni korisnici:<br/> <span id="ispMog"></span></p>
                    </div>
                    
                    <div class="tabelaProPo">
                        <h2 class="dodavanjeNaslov">Svi korisnici:</h2>
                    </div>
                    <!-- Početak tabele -->
                    <table border = "2" width = "85%">
                        <tr>
                            <th>Korisničko ime</th>
                            <th>Lozinka</th>
                            <th>Izm.<br/> loz.</th>                            
                            <th>Ime</th>
                            <th>Izm.<br/> ime</th>                            
                            <th>Prezime</th>
                            <th>Izm.<br/> prez.</th>                            
                            <th>Radno mesto</th>
                            <th>Izm.<br/> r.m.</th>                            
                            <th>Imejl</th>
                            <th>Izm.<br/> me.</th>                            
                            <th>Verifikacioni kod</th>
                            <th>Izmeni<br/> v.k.</th>
                        </tr>

                        <?php
                        include 'konekcija.php';
                        //Iz tabele korisnici uzimamo sve podatke i štampamo ih u tabeli
                        $upit = "SELECT * FROM `korisnici` ORDER BY `korisnicko_ime` ASC";
                        $result = mysqli_query($kon_sa_serv, $upit);
                        while ($red = mysqli_fetch_assoc($result)) {
                            $kor_im = $red['korisnicko_ime'];
                            $loz_cl = $red['lozinka'];
                            $ime_cl = $red['ime'];
                            $prez_cl = $red['prezime'];
                            $rad_me_cl = $red['radno_mesto'];
                            $imejl_cl = $red['imejl'];
                            $ver_kod = $red['verifikacija'];
                            //Telo tabele
                            echo "<tr>";
                            echo "<td>$kor_im</td>";
                            echo "<td>$loz_cl</td>";
                            echo "<td width = '70px'><a href = 'izm_loz_kor.php?key=".$kor_im."'>"
                            . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a>";                            
                            echo "<td>$ime_cl</td>";
                            echo "<td width = '70px'><a href = 'izmena_ime_kor.php?key=".$kor_im."'>"
                            . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                            
                            echo "<td>$prez_cl</td>";
                            echo "<td width = '70px'><a href = 'izmena_pre_kor.php?key=".$kor_im."'>"
                            . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                            
                            echo "<td>$rad_me_cl</td>";
                            echo "<td width = '70px'><a href = 'izm_rad_mes_kor.php?key=".$kor_im."'>"
                            . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                             
                            echo "<td>$imejl_cl</td>";
                            echo "<td width = '70px'><a href = 'izm_imejl_kor.php?key=".$kor_im."'>"
                            . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                             
                            echo "<td>$ver_kod</td>";
                            echo "<td width = '70px'><a href = 'izm_v_k_kor.php?key=".$kor_im."'>"
                            . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "prom_loz_men.php"><button>Promeni svoju lozinku</button></a>
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




