<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Projekti po timovima (menadžer)</title>
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
        xmlhttp.open("GET", "pretraga_proje_po_tim.php?q=" + str, true);
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
                    <h2 class="dodavanjeNaslov">Projekti po timovima:</h2>
                </div>
                
                <div class="tekst-sadrzaja">
                    <form>
                    Traženi projekti : <input type="text" onkeyup="pretraga(this.value)">
                    </form>
                    <p>Pronađeni projekti:<br/> <span id="trazeni"></span></p>
                </div>

                <div class="tabelaProPo">
                    <h2 class="dodavanjeNaslov">Svi projekti po timovima:</h2>
                </div>
                
                <div class="tabelaProPo">
                    <table border = "2" width = "90%">
                        <tr>
                            <th>Tim</th>
                            <th>Tim lider</th>
                            <th>Članovi tima</th>
                            <th>Projekat</th>                            
                            <th>Zameni ili <br/>dodeli<br/>projekat</th>
                            <th>Obavesti <br/>tim lidera</th>
                        </tr>
                        <?php
                        include 'konekcija.php';

                        $upit = "SELECT * FROM `ucesce` WHERE `uloga` = 'tim_lider' ORDER BY `ime_tima` ASC";
                        $result = mysqli_query($kon_sa_serv, $upit);
                        while ($red = mysqli_fetch_assoc($result)) {
                            $imetima = $red['ime_tima'];
                            $imekori = $red['korisnicko_ime'];
                            $imeproj = $red['ime_projekta'];
                            echo "<tr><td align = 'center'>".ucfirst($imetima)."</td>";
                            echo "<td align = 'center'>".ucfirst($imekori)."</td>";
                            
                            echo"<td>";
                            if($imetima !='menadzeri'){
                                $upit1 = "SELECT `korisnicko_ime` FROM `ucesce` WHERE `ime_tima` = '".$imetima."' AND `uloga` = 'obicni_clan_tima'";
                                $result1 = mysqli_query($kon_sa_serv, $upit1);
                                while ($red = mysqli_fetch_assoc($result1)) {
                                    $kor_im = $red['korisnicko_ime'];
                                    echo ucfirst($kor_im).', ';
                                }                            
                            }
                            echo "</td>";
                            
                            if($imeproj == ""){
                                echo "<td align = 'center'><b><font color = 'red'>bez dodeljenog projekta</font><b></td>";
                                echo "<td align = 'center' width = '70px'><img src = 'images/005-pen_1.png' border = '0' alt = 'dodelj_proj_timu'></img>";
                                echo "<a href = 'dodelj_proj_timu.php?key=".$imekori."'><img src = 'images/task_list.png' border = '0' alt = 'dodelj_proj_timu'></img></a></td>";
                                echo "<td align = 'center' width = '40px'><img src = 'images/Mail.png' border = '0' alt = 'notify'></img></td>";
                            }
                            else{
                                echo "<td align = 'center'>".ucfirst($imeproj)."</td>";
                                echo "<td align = 'center' width = '70px'><a href = 'prom_dodelj_proj_timu.php?key=".$imekori."'><img src = 'images/005-pen_1.png' border = '0' alt = 'add group task'></img></a>";
                                echo "<img src = 'images/task_list.png' border = '0' alt = 'dodelj_proj_timu'></img></td>";
                                echo "<td align = 'center' width = '40px'><a href = 'obave_tl_o_post.php?key=".$imekori."'><img src = 'images/Mail.png' border = '0' alt = 'notify'></img></a></td>";
                            }
                        }echo "</td></tr>";

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
                        <a href = "zavrsenost.php"><button>Završenost</button></a>
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

