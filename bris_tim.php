<?php
include("sesija_menadzera.php");

$tim_kljuc = $_REQUEST['key'];
include 'konekcija.php';

$upit = "UPDATE `ucesce` SET `ime_tima` = '' WHERE `ime_tima` = '".$tim_kljuc."'";
mysqli_query($kon_sa_serv, $upit);
	
$upit = "DELETE FROM `timovi` WHERE `ime_tima` = '".$tim_kljuc."'";
mysqli_query($kon_sa_serv, $upit);

mysqli_close($kon_sa_serv);
echo "<script>location.href = 'vidi_timove.php'</script>";
?>

