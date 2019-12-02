<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Glavna stranica (član_tima)</title>
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
            
            <div class="tekst-sadrzaja">        
                <div class="dodavanjeNaslov">
                    <?php
                        echo "<h2>".ucfirst($pri_kor)."</h2>";
                    ?>
                </div>

                <div class="ObavestNovePor">            
                    <?php
                    $mess = "";
                    include 'konekcija.php';
                    //Broji koliko je ne pregledanih poruka
                    $brojac = 0;
                    $upit = "SELECT * FROM `slanje_poruka` WHERE `prima` = '".$pri_kor."' AND `pregledana` = 0";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    while ($red = mysqli_fetch_assoc($result)) {
                        $brojac = $brojac + 1;
                    }
                    mysqli_close($kon_sa_serv);
                    if($brojac > 0){
                        echo "Imate ".$brojac." novih poruka!";
                    }
                    else{
                        echo "Nemate novih poruka!";
                    }

                    ?>
                </div>
            </div>
        </div>
                 
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "prom_loz_cla.php"><button>Promeni lozinku</button></a>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <a href = "vidi_korisnike_clan.php"><button>Lista korisnika</button></a>
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
