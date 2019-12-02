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

                <div class="tekst-sadrzaja">
                    <b>Primljene poruke: </b><?php echo $primljene; ?><br>
                    <b>Poslate poruke: </b><?php echo $poslate; ?><br>
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

