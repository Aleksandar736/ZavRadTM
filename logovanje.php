<?php
session_start();
session_destroy();
$pri_kor = "";
$pri_loz = "";
$msg = "";
//Podatke dobija sa stranice index.php iz forme sa metodom post, koja upucuje ovde (action='logovanje.php')
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    include 'konekcija.php';
    //Ove dve varijable preuzimaju vrednosti iz forme sa stranice index.php
    $pri_kor = $_POST['kor_ime'];
    $pri_loz = $_POST['loz'];
    //Validacija forme
    function test_input($unos) {
    $unos = trim($unos);
    $unos = stripslashes($unos);
    $unos = htmlspecialchars($unos);
    return $unos;
    }

    $pri_kor = test_input($pri_kor);
    $pri_loz = test_input($pri_loz);
    //Uzimamo podatke (korisničko ime, lozinka i uloga) iz baze 
    $upit = "SELECT korisnici.korisnicko_ime, korisnici.lozinka, ucesce.uloga"
    ." FROM korisnici INNER JOIN ucesce ON korisnici.korisnicko_ime = ucesce.korisnicko_ime";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        $kor_iz_baz = $red['korisnicko_ime'];
        $loz_iz_baz = $red['lozinka'];
        $poz = $red['uloga'];
        //Proveravamo da li se poklapaju uneti podaci za koris. ime i lozinku sa onim iz baze
        if(($pri_kor === $kor_iz_baz) AND ($pri_loz === $loz_iz_baz)){
            if($poz === "menadzer"){
                session_start();
                $_SESSION['korisnicko_ime'] = $pri_kor;
                $_SESSION['menadzer'] = "log";
                mysqli_close($kon_sa_serv);
                header("Location: menadzer.php");
                break;
            }
            else if($poz === "tim_lider"){
                session_start();
                $_SESSION['korisnicko_ime'] = $pri_kor;
                $_SESSION['tim_lider'] = "log";
                mysqli_close($kon_sa_serv);
                header("Location: tim_lider.php");
                break;
            }
            else if($poz === "obicni_clan_tima"){
                session_start();
                $_SESSION['korisnicko_ime'] = $pri_kor;
                $_SESSION['obicni_clan'] = "log";
                mysqli_close($kon_sa_serv);
                header("Location: obicni_clan.php");
                break;
            }
        }
    }
    $msg = "Pogrešno korisničko ime i/ili lozinka.";
    mysqli_close($kon_sa_serv);
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Glavna stranica</title>
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
                      
                <div>
                    <form name='login_form' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                        <div>
                            <label>Korisničko ime: </label>
                            <input type = 'text' name = 'kor_ime' value = ''>
                        </div>
                        <div>
                            <label>Lozinka: </label>
                            <input type = 'password' name = 'loz' value = ''>
                        </div>
                        <div>
                            <input type = 'submit' name = 'login' class="dugmici" value = 'Uloguj se'>
                        </div>
                    </form>
                </div>

                <div id="reg_p">
                <?php
                    echo $msg;
                ?>
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
