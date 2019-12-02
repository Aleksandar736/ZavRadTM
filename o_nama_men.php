<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>O aplikaciji (menadžer)</title>
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
                <div class="oAplikaciji">
                    <h3 class="dodavanjeNaslov">O menadžeru</h3>
                    <p>Korisnik u ulozi menadžera ima sledeće mogućnosti:
                        <ol>
                            <li>Prijava korisnika;</li>
                            <li>Registracija članova tima;</li>
                            <li>Pregled i izmena profila korisnika;</li>
                            <li>Promena svoje lozinke;</li>
                            <li>Promena zaboravljene lozinke članova tima;</li>
                            <li>Unos / izmena / pretraga / brisanje projekata;</li>
                            <li>Unos / izmena / pretraga / brisanje podataka o članovima tima;</li>
                            <li>Unos / izmena / pretraga / brisanje članova tima na projektu;</li>
                            <li>Dodeljivanje uloge tim lidera nekom od članova tima na projektu;</li>
                            <li>Dodeljivanje uloge menadžera;</li>
                            <li>Pregled timova po projektima;</li>
                            <li>Pregled učešća na projektima po članu;</li>
                            <li>Evidentiranje završetka projekta i oslobađanje timova.</li>
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

