<?php
include("sesija_tim_lidera.php");
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Odgovor na poslatu poruku (tim lider)</title>
</head>
<body>
    <?php
        include 'heder_tim_lidera.php';
    ?>     
    <div class="raspored-kolona">
        <div class="navigacija-sa-leve-strane">
            <table>
                <tr>
                    <td>
                        <a href ="tim_lider.php"><button>Glavna stranica tim lidera</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href ="projekat_tim_lidera.php"><button>Projekti</button></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href = "e_posta_tl.php"><button>Pošta</button></a>
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
                    echo "<script>location.href = 'primlj_e_pisma_tl.php'</script>";
                }
                else if (isset($_POST['send'])) {
                    $pri_kor = $_SESSION['korisnicko_ime'];
                    $skr_im = $_POST['skr_im'];
                    $nasl = $_POST['nasl'];
                    $poruka = $_POST['poruka'];

                    $upit = "INSERT INTO `slanje_poruka` (`prima`, `salje`, `naslov_poruke`, `tekst_prim_poruke`, `tekst_posl_poruke`) VALUES ('".$skr_im."', '".$pri_kor."', '".$nasl."', '".$poruka."', '".$poruka."')";
                    $result = mysqli_query($kon_sa_serv, $upit);

                    if(!$result){
                        die("<script>alert('Došlo je do nepoznate greške!')</script><script>location.href = 'e_posta_tl.php'</script>");
                    }
                    $msg = "Poruka je poslata.";
                    echo "<div  class='tekst-sadrzaja'>";
                    echo "<form name='ok_form' method='post' action='e_posta_tl.php'>";
                    echo "<input name = 'ok' type = 'submit' class='dugmici' value = 'OK'>";
                    echo "</div>";
                }
                else{
                    $prim_aoc = $_REQUEST['key'];
                    echo "<div class='tekst-sadrzaja'>";
                    echo "<form name = 'reply_form' method = 'post' action = 'odg_na_e_pismo_tl.php'>";    
                    echo "<table border = '0 width = '500' bgcolor = 'white'>";   
                    echo "<tr><td><h3 class='arial3'>Prima:</h3></td>";
                    echo "<td style='text-align:left'><input name = 'skr_im' type = 'hidden' value = $prim_aoc><h3 class='arial3'>".ucfirst($prim_aoc)."</h3></td></tr>";
                    echo "<tr><td><h3 class='arial3'>Naslov:</h3></td>";
                    echo "<td><input name = 'nasl' type = 'text' value = '' size = '48'></td></tr>";
                    echo "<tr><td colspan='2'><textarea name = 'poruka' rows = '15' cols = '59'></textarea></td></tr>";
                    echo "</td><td align='left'><input name = 'cancel' type = 'submit' class='dugmici' value = 'Otkaži'></td>";
                    echo "<td align='right'><input name = 'send' type = 'submit' class='dugmici float-right' value = 'Pošalji'></td></tr>";
                    echo "</table>";    
                    echo "</form>";
                    echo "</div>"; 
                }	
                ?>

                <div class="obavestenjeIzmene">
                    <?php echo $msg; ?>
                </div>
           </div>       
        </div>
        
        <div class="navigacija-sa-desne-strane">
            <table>
                <tr>
                    <td>            
                        <a href = "pis_e_pisma_tl.php"><button>Napiši <br/>e-pismo</button></a>
                    </td>
                </tr>                 
                <tr>
                    <td>            
                        <a href = "primlj_e_pisma_tl.php"><button>Primljena <br/>e-pisma</button></a>
                    </td>
                </tr> 
                <tr>
                    <td>            
                        <a href = "poslata_e_pisma_tl.php"><button>Poslata <br/>e-pismo</button></a>
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

