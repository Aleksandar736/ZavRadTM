<?php
include("sesija_tim_lidera.php");

$ulogov_kor = $_SESSION['korisnicko_ime'];

$kljuc = $_REQUEST['key'];
include 'konekcija.php';

$poruka = "Dobili ste zadatak od svog tim lidera. Na stranici Projekti vidite sta je Vas zadatak.";
$naslov = "obavestenje";

$upit = "INSERT INTO `slanje_poruka` (`prima`, `salje`, `pregledana_po`, `naslov_poruke`, `tekst_prim_poruke`, `tekst_posl_poruke`)"
." VALUES ('".$kljuc."', '".$pri_kor."', 0, '".$naslov."', '".$poruka."', '".$poruka."')";
mysqli_query($kon_sa_serv, $upit);

mysqli_close($kon_sa_serv);
echo "<script>location.href = 'projekat_tim_lidera.php'</script>";
?>
