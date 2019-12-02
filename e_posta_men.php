<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">    
    <title>Pošta (menadžer)</title>
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
            </table>
        </div>
        <div class="glavni-sadrzaj">
            <div class="glavni-naslov">
                <h1>Tim Menadžment</h1>
            </div>
        
            <div class="tekst-sadrzaja">                      
                <div class="dodavanjeNaslov">
                    <h2>E-pošta:</h2>
                </div>

                <?php
                include 'konekcija.php';
                //Broji koliko ima primljenih poruka
                $upit = "SELECT count(*) as 'ukupno' FROM `slanje_poruka` WHERE `prima` = '".$pri_kor."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)) {
                    $primljene = $red['ukupno'];
                }
                //Broji koliko ima poslatih poruka
                $upit1 = "SELECT count(*) as 'ukupno'  FROM `slanje_poruka` WHERE `salje` = '".$pri_kor."'";
                $result1 = mysqli_query($kon_sa_serv, $upit1);
                while ($red = mysqli_fetch_assoc($result1)) {
                    $poslate = $red['ukupno'];
                }
                ?>

                <div class="ObavestNovePor">
                    <b>Primljena poruke</b> <?php echo $primljene; ?><br> 
                    <b>Poslata poruke</b> <?php echo $poslate; ?><br> 
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
                <tr>
                    <td>
                        <a href = "poslata_e_pisma_men.php"><button>Poslata <br/>e-pisma</button></a>
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
