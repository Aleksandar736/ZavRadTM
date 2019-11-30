<?php
include("sesija_tim_lidera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Spisak korisnika (tim lider)</title>
    <script>
    function showHint(str) {
      if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "pretr_liste_kor.php?q=" + str, true);
        xmlhttp.send();
      }
    }
    </script>    
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
                <div class="pretragaPromenaItd">
                    <h3 class="dodavanjeNaslov">Korisnici:</h3>
                </div>                
                <div class="tekst-sadrzaja">
                    <div>
                        <form>
                        Traženi korisnici: <input type="text" onkeyup="showHint(this.value)">
                        </form>
                        <p>Pronađeni korisnici:<br/> <span id="txtHint"></span></p>
                    </div>                    
                    <table border = "2" width = "85%">
                        <tr>
                            <th>Korisničko ime</th>
                            <th>Tim</th>
                        </tr>

                        <?php
                        include 'konekcija.php';

                        $upit = "SELECT * FROM `ucesce` ORDER BY `ime_tima`, `korisnicko_ime` ASC";
                        $result = mysqli_query($kon_sa_serv, $upit);
                        while ($red = mysqli_fetch_assoc($result)) {
                            $kor_im = $red['korisnicko_ime'];
                            $im_ti = $red['ime_tima'];
                            echo "<tr>";
                            echo "<td>".ucfirst($kor_im)."</td>";
                            echo "<td>".ucfirst($im_ti)."</td>";
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
                        <a href = "prom_loz_tl.php"><button>Promeni lozinku</button></a>
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
