<?php
include("sesija_menadzera.php");

$tim_kljuc = $_REQUEST['key'];
include 'konekcija.php';
//Brisanje imena tima iz tabele ucesce kod korisnika koji su bili raspoređeni u njemu
$upit = "UPDATE `ucesce` SET `ime_tima` = '' WHERE `ime_tima` = '".$tim_kljuc."'";
mysqli_query($kon_sa_serv, $upit);
//Brisanje celog reda iz tabele timovi gde je ime tima $tim_kljuc
$upit = "DELETE FROM `timovi` WHERE `ime_tima` = '".$tim_kljuc."'";
mysqli_query($kon_sa_serv, $upit);

mysqli_close($kon_sa_serv);
echo "<script>location.href = 'vidi_timove.php'</script>";
?>



