<?php
include("sesija_clana.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Član_tim (slanje_poruka)</title>
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
        
            <div class="oAplikaciji">
                <?php
                $msg = "";
                include 'konekcija.php';
                
                if (isset($_POST['cancel'])) {
                    echo "<script>location.href = 'e_posta_clan.php'</script>";
                }
                else if (isset($_POST['send'])) {
                    $pri_kor = $_SESSION['korisnicko_ime'];
                    $ime_prim = $_POST['ime_prim'];
                    $naslov = $_POST['naslov'];
                    $tek_pisma = $_POST['tek_pisma'];
                    $mejl_pos = $_POST['mejl_pos'];
                   //Upisivanje u tabelu slanje_poruka svih vrednosti 
                    $upit = "INSERT INTO `slanje_poruka` (`prima`, `salje`, `naslov_poruke`, `tekst_prim_poruke`, `tekst_posl_poruke`, `imejl_posiljaoca`)"
                    ." VALUES ('".$ime_prim."', '".$pri_kor."', '".$naslov."', '".$tek_pisma."', '".$tek_pisma."', '".$mejl_pos."')";
                    $result = mysqli_query($kon_sa_serv, $upit);
                    if(!$result){
                        die("<script>alert('Došlo je do nepoznate greške!')</script><script>location.href = 'e_posta_clan.php'</script>");
                    }

                    $msg = "Poruka je poslata.";
                    echo "<div class='tekst-sadrzaja'>";
                    echo "<form name='ok_form' method='post' action='e_posta_clan.php'>";
                    echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                    echo "</div>";
                }
                else{
                    echo "<div class='tekst-sadrzaja'>";
                    echo "<form name = 'reply_form' method = 'post' action = 'pis_e_pisma_cla.php'>";
                    echo "<table>";
                    echo "<tr><td><label for='ime_prim'>Prima (korisničko ime):</label></td>";
                    echo "<td><input name = 'ime_prim' type = 'text' value = '' size = '46'></td></tr>";
                    echo "<tr><td><label for='mejl_pos'>Šalje (imejl):</label></td>";
                    echo "<td><input name = 'mejl_pos' type = 'email' value = '' size = '46'></td></tr>";
                    echo "<tr><td><label for='naslov'>Naslov poruke:</label></td>";
                    echo "<td><input name = 'naslov' type = 'text' value = '' size = '46'></td></tr>";
                    echo "<tr><td colspan='2'><textarea name = 'tek_pisma' rows = '15' cols = '70'></textarea></td></tr>";
                    echo "<tr><td align='left'><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                    echo "<td align='right'><input name = 'send' type = 'submit' class='dugmici float-right' value = 'Pošalji'></td></tr>";
                    echo "</table>";
                    echo "</form>";
                    echo "</div>";   
                }	
                ?>
                <div class="tekst-sadrzaja obavestenjeIzmene">
                    <?php echo $msg; ?>
                </div>                
            </div>                                   
        </div>
                    
        <div class="navigacija-sa-desne-strane">
            <table>          
                <tr>
                    <td>
                        <a href = "primlj_e_pisma_clan.php"><button>Primljena <br/>e-pisma</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "poslata_e_pisma_clan.php"><button>Poslata <br/>e-pisma</button></a>
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
