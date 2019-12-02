<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Čitanje pošte (član tima)</title>
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
            <div id="glavni-naslov">
                <h1>Tim Menadžment</h1>
            </div>
        
            <div class="tekst-sadrzaja">

                <?php
                $id_por = $_REQUEST['key'];
                include 'konekcija.php';
                //Namesta u bazi na 1 (umesto 0) u koloni pregl. (pa se broj neproč. smanjuje za jedan (brojač ga ne broji))
                //u fajlovima menadzer, tim_lider i obicni_clan
                $upit = "UPDATE `slanje_poruka` SET `pregledana` = 1 WHERE `idporuke` = '".$id_por."'";
                mysqli_query($kon_sa_serv, $upit);

                //Čita iz baze poruku sa id-jem $id_por
                $upit = "SELECT * FROM `slanje_poruka` WHERE `idporuke` = '".$id_por."'";
                $result = mysqli_query($kon_sa_serv, $upit);
                while ($red = mysqli_fetch_assoc($result)){
                    $salje_p = $red['salje'];
                    $datum_s = $red['datum_slanja'];
                    $naslov_p = $red['naslov_poruke'];
                    $tekst_p = $red['tekst_prim_poruke'];
                }
                ?>
                
                <div class="tekst-sadrzaja">
                    <table class="oAplikaciji" width="90%">
                        <tr>
                            <td class="float-left">
                                <h3 class="arial3">Šalje:</h3>
                            </td>
                            <td>
                                <h5 class="arial3" style="text-align: left"><?php echo ucfirst($salje_p); ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td class="float-left">
                                <h3 class="arial3">Datum slanja:</h3>
                            </td>
                            <td>
                                <h5 class="arial3" style="text-align: left"><?php echo $datum_s; ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td class="float-left">
                                <h3 class="arial3">Naslov:</h3>
                            </td>
                            <td>
                                <h5 class="arial3" style="text-align: left"><?php echo ucfirst($naslov_p); ?></h5>
                            </td>
                        </tr>
                    </table>
                    <table width="90%" border="2">
                        <tr>
                            <td colspan="2" style="text-align: left"><?php echo $tekst_p; ?></td>
                        </tr>
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
                        <a href = "odg_na_e_pismo_clan.php?key=<?php echo $salje_p; ?>"><button>Odgovori na <br/>e-pismo</button></a>
                    </td>
                </tr> 
                <tr>
                    <td>            
                        <a href = "bris_e_pisma_clan.php?key=<?php echo $id_por; ?>"><button>Obriši <br/>e-pismo</button></a>
                    </td>
                </tr>            
                <tr>
                    <td>
                        <a href = "primlj_e_pisma_clan.php"><button>Poštansko sanduče</button></a>
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
