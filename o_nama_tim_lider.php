<?php
include("sesija_tim_lidera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>O aplikaciji (tim lider)</title>
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
                    <h3 class="dodavanjeNaslov">O tim lideru</h3>
                    <p>Korisnik u ulozi tim lidera ima sledeće mogućnosti:
                        <ol>
                            <li>Prijava korisnika;</li>
                            <li>Promena svoje lozinke;</li>
                            <li>Uvid u spisak članova tima;</li>
                            <li>Dodeljivanje zaduženja članovima tima;</li>
                            <li>Pregled učešća na projektima po članu (u kom % je član izvršio svoj zadatak).</li>
                        </ol>
                    </p>
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
