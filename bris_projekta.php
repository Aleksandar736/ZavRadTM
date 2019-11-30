<?php
include("sesija_menadzera.php");

$pro_kljuc = $_REQUEST['key'];
include 'konekcija.php';
//Brisanje izabranog projekta iz tabele projekti
$upit = "DELETE FROM `projekti` WHERE `ime_projekta` = '".$pro_kljuc."'";
mysqli_query($kon_sa_serv, $upit);

//a) U tabeli učešće brisanje zadataka i zavr. zada. vezanih za izabrani projekat
$upit = "SELECT * FROM `ucesce` WHERE `ime_projekta` = '".$pro_kljuc."'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $ime_t = $red['ime_tima'];
    $upit = "UPDATE `ucesce` SET `zadatak_clana` = '' WHERE `ime_tima` = '".$ime_t."'";
    mysqli_query($kon_sa_serv, $upit);

    $upit = "UPDATE `ucesce` SET `zavrsenost_zadatka_(%)` = '' WHERE `ime_tima` = '".$ime_t."'";
    mysqli_query($kon_sa_serv, $upit);
}
//b) U tabeli učešće brisanje izabranog projekta kod svih korisnika koji su na njemu radili
$upit = "SELECT * FROM `ucesce` WHERE `ime_projekta` = '".$pro_kljuc."'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $ko_im = $red['korisnicko_ime'];
    $upit = "UPDATE `ucesce` SET `ime_projekta` = '' WHERE `korisnicko_ime` = '".$ko_im."'";
    mysqli_query($kon_sa_serv, $upit);
}

mysqli_close($kon_sa_serv);
echo "<script>location.href = 'vidi_projekte.php'</script>";
?>

