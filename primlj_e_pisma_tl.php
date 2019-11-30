<?php
include("sesija_tim_lidera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Poruke (tim lider)</title>
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
        
            <div class="dodavanjeNaslov">
                <h3>Poštansko sanduče:</h3>
                
                <div class="tekst-sadrzaja">
                <table border = "2" width = "90%">
                    <tr>
                        <th>Pregled poruka</th>
                        <th>Šalje</th>
                        <th>Naslov</th>
                        <th>Datum slanja</th>
                        <th>Odgovor / Brisanje</th>
                    </tr>

                    <?php
                    include 'konekcija.php';

                    $upit = "SELECT * FROM `slanje_poruka` WHERE `prima` = '".$pri_kor."' ORDER BY `datum_slanja` DESC";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $id_por = $red['idporuke'];
                        $preg = $red['pregledana'];
                        $salje = $red['salje'];
                        $nasl_por = $red['naslov_poruke'];
                        $dat_sl = $red['datum_slanja'];
                        echo "<tr>";
                        if($preg == 0){
                            echo "<td width = '1'><a href = 'citanj_e_pisma_tl.php?key=".$id_por."'><img src = 'images/unopened-mail.png' border = '0'></img></a></td>";
                        }
                        else{
                            echo "<tr><td width = '1'><a href = 'citanj_e_pisma_tl.php?key=".$id_por."'><img src = 'images/openmail.png' border = '0'></img></a></td>";
                        }
                        echo "<td><b>".ucfirst($salje)."</b></td>";
                        if($nasl_por == ""){
                            echo "<td width = '150'>bez naslova</td>";
                        }
                        else{
                            echo "<td width = '150'>".ucfirst($nasl_por)."</td>";
                        }
                        echo "<td>$dat_sl</td>";
                        echo "<td width ='75'><a href = 'odg_na_e_pismo_tl.php?key=".$salje."'><img src = 'images/mail_reply.png' border = '0'></img></a>";
                        echo " "."<a href = 'bris_e_pisma_tl.php?key=".$id_por."'><img src = 'images/mail_delete.png' border = '0'></img></a></td>";
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
                        <a href = "pis_e_pisma_tl.php"><button>Napiši <br/>e-pismo</button></a>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <a href = "primlj_e_pisma_tl.php"><button>Primljena <br/>e-pisma</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "poslata_e_pisma_tl.php"><button>Poslata <br/>e-pisma</button></a>
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

