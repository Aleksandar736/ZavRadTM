<?php
include("sesija_menadzera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Menadžer (dodavanje korisnika)</title>
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
        
            <div class="tabelaProPo">
                <div>
                    <h3 class="dodavanjeNaslov">Dodaj korisnika:</h3>
                </div>
                <div><!-- Forma iz koje podaci idu na dodav_nov_kor_dod.php -->
                    <fieldset class="fildset2">
                    <form name='add_form' method='post' action='dodav_nov_kor_dod.php'>
                        <table border = "0" >
                            <tr>
                                <td style="text-align: right"><b>Korisničko ime:</b></td>
                                <td colspan="3"><input name = 'subj_izm' type = 'text' size="25" value = ''></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Lozinka:</b></td>
                                <td colspan="3"><input name = 'un_loz_nk' type = 'password' size="25" value = ''></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Imejl:</b></td>
                                <td colspan="3"><input name = 'un_imejl_nk' type = 'email' size="25" value = ''></td>
                            </tr>
                            <tr>
                                <td style="text-align: right"><b>Tim:</b></td>
                                <td colspan="3">	
                                    <select name = 'izab_tim' class="selektovanje">

                                    <?php
                                        include 'konekcija.php';
                                        //Spisak timova
                                        $upit = "SELECT * FROM `timovi` ORDER BY `ime_tima` ASC";
                                        $result = mysqli_query($kon_sa_serv, $upit);
                                        while ($red = mysqli_fetch_assoc($result)){
                                            $list = $red['ime_tima'];
                                            if($list != "menadzeri"){
                                                echo "<option>$list</option>";
                                            }
                                        }
                                        mysqli_close($kon_sa_serv);
                                    ?>

                                    </select>
                                </td>
                            </tr>
                            <tr><!-- Spisak uloga -->
                                <td style="text-align: right"><b>Uloga:</b></td>
                                <td colspan="3">
                                    <select name = 'izab_ulog' class="selektovanje">
                                    <option>obicni_clan_tima
                                    <option>tim_lider
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input name = 'reset' type = 'reset' class='dugmici' value = 'Resetuj'></td>
                                <td><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>
                                <td><input name = 'add' type = 'submit' class='dugmici' value = 'Dodaj'></td>
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

