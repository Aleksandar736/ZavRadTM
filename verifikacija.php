<?php
session_start();
session_destroy();
$msg = "";

include 'konekcija.php';

if (isset($_POST['verifikuj'])) {
    $im_ad = $_POST['im_ad'];
    $verif = $_POST['ver_kod'];

    $upit = "SELECT * FROM `korisnici`";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        $im_iz_ba = $red['imejl'];
        $v_iz_ba = $red['verifikacija'];
        if(($im_iz_ba == $im_ad) AND ($v_iz_ba == $verif)){
            $upit = "SELECT * FROM `korisnici` WHERE `imejl` = '".$im_ad."'";
            $result = mysqli_query($kon_sa_serv, $upit);
            while($red = mysqli_fetch_assoc($result)){
                $nov_kor = $red['korisnicko_ime'];
                $loz_nov = $red['lozinka'];
            }
            $upit = "INSERT INTO `ucesce` (`korisnicko_ime`, `uloga`) VALUES ('".$nov_kor."', 'obicni_clan_tima')";
            mysqli_query($kon_sa_serv, $upit);
            $msg = "Verifikacija naloga je uspela.";
            break;
        }
        else{
            $msg = "Verifikacija naloga nije uspela.";
        }
    }
}
?>
	
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Verifikacija</title>
</head>
<body>
    <?php
        include 'header.php';
    ?>      
    <div class="raspored-kolona">
        <div class="navigacija-sa-leve-strane">
            
        </div>
    
        <div class="glavni-sadrzaj">
            <div class="glavni-naslov">
                <h1>Tim Menadžment</h1>
            </div>
            
            <div class="oAplikaciji">
                <form name='signup_form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <table border = "0">
                        <tr>
                            <th style="text-align:right">Imejl adresa:</th>
                            <td><input name = 'im_ad' type = 'text' value = ''></td>
                        </tr>
                        <tr>
                            <th style="text-align:right">Verifikacioni kod:</th>
                            <td><input name = 'ver_kod' type = 'text' value = ''></td>
                        </tr>
                        <tr>
                            <td colspan = '2' style="text-align:right">
                            <font color = 'red' size = '2'><b>
                                <?php echo $msg; ?>
                            </b></font>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align:right">
                                <input name = 'verifikuj' type = 'submit' class="dugmici float-right" value = 'Verifikuj'>
                            </td>
                        </tr>
                    </table>
                </form>
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

