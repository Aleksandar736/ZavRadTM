<?php
include("sesija_menadzera.php");

$msg = "";
$exist = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'konekcija.php';

    if (isset($_POST['cancel'])) {
        echo "<script>location.href = 'vidi_projekte.php'</script>";
    }

    $ime_proje = $_POST['ime_proje'];
    $opis_proje = $_POST['opis_proje'];

    if($ime_proje == ''){
        die("<script>alert('Unesite ime projekta!')</script><script>location.href = 'dodav_nov_proj.php'</script>");
    }

    $upit = "SELECT * FROM `projekti`";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        if ($ime_proje == $red['ime_projekta']){
            $exist = true;
            break;
        }
    }

    if ($exist){
        $msg = 'Projekat pod tim imenom već postoji!';
        mysqli_close($kon_sa_serv);
    }
    else{
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $ime_proje=test_input($ime_proje);
        $upit = "INSERT INTO `projekti` (`ime_projekta`, `opis_projekta`) VALUES ('".$ime_proje."', '".$opis_proje."')";
        $result = mysqli_query($kon_sa_serv, $upit);
        if($result){
            $msg = 'Projekat uspešno dodat.';
            mysqli_close($kon_sa_serv);		
        }
        else{
            mysqli_close($kon_sa_serv);
            $msg = "Greška prilikom dodavanja projekta";
        }
    }
}

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

                <div class="obavestenjeIzmene">
                    <?php echo $msg; ?>
                </div>

                <div class="obavestenjeIzmene">
                    <form name='ok_form' method='post' action='vidi_projekte.php'>
                    <input name = 'ok' type = 'submit' value = 'OK'>
                </div>

            </div>
        
        </div>
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "dodav_nov_proj.php"><button>Dodaj novi projekat</button></a>
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
