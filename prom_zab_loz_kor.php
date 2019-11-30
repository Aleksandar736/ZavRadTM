<?php
include("sesija_menadzera.php");

$kor_im = $_REQUEST['key'];
include 'konekcija.php';

$nova_loz = rand();

$upit = "UPDATE `korisnici` SET `lozinka` = '".$nova_loz."' WHERE `korisnicko_ime` = '".$kor_im."'";
mysqli_query($kon_sa_serv, $upit);
mysqli_close($kon_sa_serv);

echo "<script>location.href = 'promena_loz_zab.php'</script>";
?>
