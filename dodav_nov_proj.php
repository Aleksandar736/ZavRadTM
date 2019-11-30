<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (dodavanje projekta)</title>
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
                <?php
                        echo "<div class='tabelaProPo'>";
                        echo "<h3 class='dodavanjeNaslov'>Dodaj projekat:</h3>";
                        echo "</div>";
                        echo "<div class='tekst-sadrzaja'>";
                        echo "<fieldset class='fildset2'>";
                        echo "<form name='add_form' method='post' action='dodav_nov_proj_dod.php'>";
                        echo "<table border = '0' >";
                        echo "<tr><td><b>Projekat:</b></td>";
                        echo "<td colspan='3'><input name = 'ime_proje' type = 'text' size='24' value = ''></td>";
                        echo "</tr>";
                        echo "<tr><td style='text-align: right'><b>Opis:</b></td>";
                        echo "<td colspan='3'><textarea name = 'opis_proje' cols='25' rows='7'></textarea>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td></td><td><input name = 'reset' type = 'reset' class='dugmici' value = 'Resetuj'></td>";
                        echo "<td><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                        echo "<td><input name = 'add' type = 'submit' class='dugmici' value = 'Dodaj'></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</form>";
                        echo "</fieldset>";
                        echo "</div>";
                ?>
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
