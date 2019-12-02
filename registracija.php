<?php
session_start();
session_destroy();
$msg = "";

include 'konekcija.php';
//Ako je kliknuto na Registracija, forma je na dnu stranice, vrednosti koje su postovane se dodeljuju
//ovim varijablama
if (isset($_POST['register'])) {
    $iadr = $_POST['iadr'];
    $kor_im_pr = $_POST['kor_im_pr'];
    $loz_pri = $_POST['loz_pri'];
    $po_loz_pri = $_POST['po_loz_pri'];
    $ime_pri = $_POST['ime_pri'];
    $pre_pri = $_POST['pre_pri'];

    //Validacija forme
    function test_input($unos) {
    $unos = trim($unos);
    $unos = stripslashes($unos);
    $unos = htmlspecialchars($unos);
    return $unos;
    }

    $iadr = test_input($iadr);
    $kor_im_pr = test_input($kor_im_pr);
    $loz_pri = test_input($loz_pri);
    $po_loz_pri = test_input($po_loz_pri);
    $ime_pri = test_input($ime_pri);
    $pre_pri = test_input($pre_pri);  
    //Provera da li su sva polja popunjena
    if(($iadr == "") || ($kor_im_pr == "") || ($loz_pri == "") || ($po_loz_pri == "") || ($ime_pri == "") || ($pre_pri == "")){
        $msg = "Popunite sva polja.";
    }
    else if($loz_pri != $po_loz_pri){
        $msg = "Lozinke se razlikuju.";
    }
    else{
        $upit = "SELECT * FROM `korisnici`";
        $result = mysqli_query($kon_sa_serv, $upit);
        while ($red = mysqli_fetch_assoc($result)) {
            $kor_iz_b = $red['korisnicko_ime'];
            $im_iz_b = $red['imejl'];
            if($kor_iz_b == $kor_im_pr){
                $msg = "Korisničko ime je zauzeto.";
            }
            else if($im_iz_b == $iadr){
                $msg = "Imejl adresa je zauzeta.";
            }
            else{
                $ver = rand();
                $upit = "INSERT INTO `korisnici` (`imejl`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `verifikacija`)"
                ." VALUES ('".$iadr."', '".$kor_im_pr."', '".$loz_pri."', '".$ime_pri."', '".$pre_pri."', '".$ver."')";
                mysqli_query($kon_sa_serv, $upit);
                //primalac imejla
                $to = "'".$iadr."'";
                //naslov imejla
                $subject = 'Kod za verifikaciju';
                //tekst imejla. Svaki red teksta imejla treba da bude odvojen sa \n
                $message = "<h1>Verifikacioni kod</h1><p>Vaš verifikacioni kod je "."'".$ver."'</p>";
                //headers. šalje \r\n odgovori na
                $headers = "From: Tim menadzment<timm@localhost.com>\r\n";
                $headers .= "Reply-To: noreply@localhost.com\r\n";
                $headers .= "Content-type: text/html\r\n";

                //slanje imejla
               mail($to, $subject, $message, $headers);               
                
                //Šalje na stranicu za verifikaciju 
                echo "<script>location.href = 'verifikacija.php'</script>";
            }
        }
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Registracija</title>
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
            
            <div class="tekst-sadrzaja">
                <div class="oAplikaciji">
                    <form name='signup_form' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <table border = "0">
                            <tr>
                                <th style="text-align:right">Imejl Adresa: *</th>
                                <td colspan="2"><input name = 'iadr' type = 'email' value = ''></td>
                            </tr>
                            <tr>
                                <th style="text-align:right">Korisničko ime: *</th>
                                <td colspan="2"><input name = 'kor_im_pr' type = 'text' value = ''></td>
                            </tr>
                            <tr>
                                <th style="text-align:right">Lozinka: *</th>
                                <td colspan="2"><input name = 'loz_pri' type = 'password' value = ''></td>
                            </tr>
                            <tr>
                                <th style="text-align:right">Lozinka ponovo: *</th>
                                <td colspan="2"><input name = 'po_loz_pri' type = 'password' value = ''></td>
                            </tr>
                            <tr>
                                <th style="text-align:right">Ime: *</th>
                                <td colspan="2"><input name = 'ime_pri' type = 'text' value = ''></td>
                            </tr>
                            <tr>
                                <th style="text-align:right">Prezime: *</th>
                                <td colspan="2"><input name = 'pre_pri' type = 'text' value = ''></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan = '2' style="text-align:right">
                                    <p id="reg_p"><?php echo $msg; ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align:right">
                                    <input name = 'cancel' type = 'reset' class="dugmici" value = 'Očisti'>                
                                </td>
                                <td style="text-align:right">
                                    <input name = 'register' type = 'submit' class="dugmici" value = 'Registracija'>
                                </td>
                            </tr>
                        </table>
                    </form>
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
