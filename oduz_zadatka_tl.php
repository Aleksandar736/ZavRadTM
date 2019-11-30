<?php
include("sesija_tim_lidera.php");

$tren_kor = $_SESSION['korisnicko_ime'];
$im_cla = $_REQUEST['key'];

include 'konekcija.php';

$upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` = '".$tren_kor."'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $ime_pro = $red['ime_projekta'];
}

$upit = "UPDATE `ucesce` SET `zadatak_clana` = '', `zavrsenost_zadatka_(%)` = '' WHERE `korisnicko_ime` = '".$im_cla."'";
mysqli_query($kon_sa_serv, $upit);

mysqli_close($kon_sa_serv);
echo "<script>location.href = 'projekat_tim_lidera.php'</script>";
?>
