<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Poslate poruke (obični član tima)</title>
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
        
            <div class="dodavanjeNaslov">
                <h3>Poslate poruke:</h3>

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
                    $upit = "SELECT * FROM `slanje_poruka` WHERE `salje` = '".$pri_kor."' ORDER BY `datum_slanja` DESC";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $id_por = $red['idporuke'];
                        $preg = $red['pregledana_po'];
                        $prim = $red['prima'];
                        $nasl_por = $red['naslov_poruke'];
                        $dat_sl = $red['datum_slanja'];

                        echo "<tr>";
                        if($preg == 0){
                            echo "<td align = 'center' width = '1'><a href = 'citanj_po_e_pisma_clan.php?key=".$id_por."'><img src = 'images/unopened-mail.png' border = '0'></img></a></td>";
                        }
                        else{
                            echo "<tr><td align = 'center' width = '1'><a href = 'citanj_po_e_pisma_clan.php?key=".$id_por."'><img src = 'images/openmail.png' border = '0'></img></a></td>";
                        }
                        echo "<td align = 'center'><b>".ucfirst($prim)."</b></td>";
                        if($nasl_por == ""){
                            echo "<td align = 'center' width = '150'>bez naslova</td>";
                        }
                        else{
                            echo "<td align = 'center' width = '150'>".ucfirst($nasl_por)."</td>";
                        }
                        echo "<td align = 'center'>$dat_sl</td>";
                        echo "<td align = 'center' width ='60'>";
                        echo "<a href = 'bris_e_pisma_po_clan.php?key=".$id_por."'><img src = 'images/mail_delete.png' border = '0'></img></a></td>";
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
                        <a href = "pis_e_pisma_cla.php"><button>Napiši <br/>e-pismo</button></a>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <a href = "primlj_e_pisma_clan.php"><button>Primljena <br/>e-pisma</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "poslata_e_pisma_clan.php"><button>Poslata <br/>e-pisma</button></a>
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
