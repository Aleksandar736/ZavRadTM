<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Poslate poruke (menadžer)</title>
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
        
            <div class="dodavanjeNaslov">
                <h3>Poslata e-pisma:</h3>

                <div class="tekst-sadrzaja">
                    <table border = "2" width = "90%">
                    <tr>
                        <th>Pročitaj</th>
                        <th>Prima</th>
                        <th>Naslov</th>
                        <th>Datum slanja</th>
                        <th>Brisanje</th>
                    </tr>
                    <?php
                    include 'konekcija.php';
                    //Tražimo poruke koje je poslao prijavljeni korisnik
                    $upit = "SELECT * FROM `slanje_poruka` WHERE `salje` = '".$pri_kor."' ORDER BY `datum_slanja` DESC";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $id_por = $red['idporuke'];
                        $preg = $red['pregledana_po'];
                        $prim = $red['prima'];
                        $nasl_por = $red['naslov_poruke'];
                        $dat_sl = $red['datum_slanja'];
                        //Ako poruka nije pregledana slika neotvorenog pisma
                        echo "<tr>";
                        if($preg == 0){
                            echo "<td width = '1'><a href = 'citanj_po_e_pisma_men.php?key=".$id_por."'><img src = 'images/unopened-mail.png' border = '0'></img></a></td>";
                        }
                        else{//Ako je poruka pregledana slika otvorenog pisma
                            echo "<tr><td width = '1'><a href = 'citanj_po_e_pisma_men.php?key=".$id_por."'><img src = 'images/openmail.png' border = '0'></img></a></td>";
                        }//Prima
                        echo "<td><b>".ucfirst($prim)."</b></td>";
                        if($nasl_por == ""){
                            echo "<td width = '150'>bez naslova</td>";
                        }
                        else{//Naslov
                            echo "<td width = '150'>".ucfirst($nasl_por)."</td>";
                        }//Datum
                        echo "<td>$dat_sl</td>";
                        echo "<td width ='60'>";
                        echo "<a href = 'bris_e_pisma_po_men.php?key=".$id_por."'><img src = 'images/mail_delete.png' border = '0'></img></a></td>";
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
                        <a href = "pis_e_pisma_men.php"><button>Napiši <br/>e-pismo</button></a>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <a href = "primlj_e_pisma_men.php"><button>Primljena <br/>e-pisma</button></a>
                    </td>
                </tr>              
            </table>
        </div>
    </div>
    <?php
        include 'footer.php';
    ?>
</div>
</body>
</html>

