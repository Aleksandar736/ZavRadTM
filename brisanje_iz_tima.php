<?php
include("sesija_menadzera.php");

$kljuc_del = $_REQUEST['key'];
include 'konekcija.php';

$upit = "DELETE FROM `ucesce` WHERE `korisnicko_ime` = '".$kljuc_del."'";
mysqli_query($kon_sa_serv, $upit);

$upit = "SELECT * FROM `timovi` WHERE `tim_lider` = '".$kljuc_del."'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $ime_tima = $red['ime_tima'];
}

$upit = "UPDATE `timovi` SET `tim_lider` = '' WHERE `ime_tima` = '".$ime_tima."'";
$result = mysqli_query($upit);

mysqli_close($kon_sa_serv);
echo "<script>location.href = 'upravljacka_stranica.php'</script>";
?>
