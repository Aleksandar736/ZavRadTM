<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">    
    <title>Menadžer (dodavanje timova)</title>
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
                <div class="tabelaProPo">
                    <h2 class="dodavanjeNaslov">Dodaj novi tim:</h2>
                </div>
                <div class="tabelaProPo"><!-- Forma iz koje podaci idu na dodav_nov_tim.php -->
                    <fieldset class="fildset2">
                    <form name='add_form' method='post' action='dodav_nov_tim_dod.php'>
                        <table border = "0" >
                            <tr>
                                <td>
                                    <b>Naziv tima:</b>
                                </td>
                                <td colspan="3">
                                    <input name = 'ime_tima' type = 'text' size="24" value = ''>
                                </td>
                            </tr>	
                            <tr>
                                <td></td>
                                <td>
                                    <input type = 'reset' name = 'reset' class='dugmici' value = 'Resetuj'>
                                </td>
                                <td>
                                    <input type = 'submit' name = 'cancel' class='dugmici' value = 'Otkaži'>
                                </td>    
                                <td>    
                                    <input type = 'submit' name = 'add' class='dugmici' value = 'Dodaj'>
                                </td>
                            </tr>
                        </table>
                    </form>
                    </fieldset>
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

