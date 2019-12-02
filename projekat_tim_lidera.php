<?php
include("sesija_tim_lidera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Tim_lider(projekat)</title>
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
                include 'konekcija.php';
                //Uzima imena tima i projekta na kom radi tim lider
                $upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$pri_kor."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $im_tim = $red['ime_tima'];
                    $im_pro = $red['ime_projekta'];
                }
                //Ako nema projekta ide obaveštenje o tome
                if($im_pro == ""){
                    $im_pro = "Nema projekata";
                }
                //Tabela
                echo "<div class='tabelaProPo opis'>";
                echo "<table>";
                echo "<tr><td style='text-align:right'><b>Projekat:</b></td>";
                echo "<td style='text-align:left'>".ucfirst($im_pro)."</td></tr>";
                //Tražimo opis projekta u tabeli projekti
                $upit = "SELECT * FROM `projekti` WHERE `ime_projekta` = '".$im_pro."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $opi_pro = $red['opis_projekta'];
                }
                //Ako nema opisa ide obaveštenje o tome
                if($opi_pro == ""){
                    $opi_pro = "nema opisa";
                }
                //Tabela
                echo "<tr><td style='text-align:right'><b>Opis:</b></td>";
                echo "<td style='text-align:left'>".ucfirst($opi_pro)."</td></tr>";
                echo "</table>";
                echo "</div>";

                echo "<div class='tabelaProPo'>";
                echo "<fieldset>";
                echo "<table border = '2' width='100%'>";
                echo "<tr>";
                echo "<th>Članovi tima</th>";
                echo "<th>Zadaci</th>";
                echo "<th>Status</th>";
                echo "<th>Dodeli zadatak /<br/> Pošalji obaveštenje</th>";
                echo "</tr>";
                //Tražimo članove tima koji nisu tim lider
                $upit = "SELECT * FROM `ucesce` WHERE `ime_tima` = '".$im_tim."' AND `uloga` != 'tim_lider' ORDER BY `korisnicko_ime` ASC";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $im_cla = $red['korisnicko_ime'];
                    $zad_cla = $red['zadatak_clana'];
                    $zav_zad = $red['zavrsenost_zadatka_(%)'];
                    //Ispisujemo ime člana
                    if($im_cla == $pri_kor){
                        echo "<tr><td><b>".ucfirst($im_cla)."<font color = 'red'> (tim_lider)</font></b></td>";
                    }
                    else{//ovde
                        echo "<tr><td><b>".ucfirst($im_cla)."</b></td>";
                    }//Ako nema zadatka, ide obaveštenje o tome
                    if($zad_cla ==""){
                        echo "<td><font color = 'red'>bez zadatka</font><br/><img src = 'images/garbage.png'></td>";
                    }
                    else{//U suprotnom ispisujemo ime zadatka i korpu (unutar linka ka oduz_zadatka_tl.php) na koju kad kliknemo briše zadatak
                        echo "<td>".$zad_cla."<br/><a href = 'oduz_zadatka_tl.php?key=".$im_cla."'><img src = 'images/garbage.png' border ='0'></a></td>";
                    }//Ako nema izveštaja o završenosti zadatka ide ---
                    if($zav_zad == ""){
                        echo "<td><b>"."---"."</b></td>";
                    }
                    else{//U suprotnom ide odgovarajuće obaveštenje
                        if($zav_zad == 0){
                            $zav_zad = "u pripremi";
                        }
                        else if($zav_zad == 10){
                            $zav_zad = "radovi u toku";
                        }
                        else if($zav_zad == 100){
                            $zav_zad = "završen";
                        }
                        else{
                            $zav_zad = $zav_zad."%";
                        }echo "<td><font color = 'red'><b>$zav_zad</b></font></td>";
                    }
                    echo "<td>";
                    if($zad_cla == ""){//Ako nema već dodelj. zadatka moguće mu ga je dodeliti
                        echo "<a href = 'dodelj_zad_clanu.php?key=".$im_cla."'><img src = 'images/task_list.png' border = '0'></a>";
                        echo "<img src = 'images/unopened-mail.png'>";
                    }
                    else{//Ako je zadatak dodeljen tim lider šalje članu obaveštenje o tome
                        echo "<img src = 'images/task_list.png' border = '0'>";
                        if($zav_zad == "u pripremi"){
                            echo "<a href = 'obave_clana_o_dod_zad.php?key=".$im_cla."'><img src = 'images/unopened-mail.png' border = '0'></a>";
                        }
                        else{
                            echo "<img src = 'images/unopened-mail.png' border = '0'>";
                        }
                    }
                }
                echo "</td></tr></table></fieldset></div>";
                mysqli_close($kon_sa_serv);
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

