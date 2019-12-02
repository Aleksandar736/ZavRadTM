<?php
include("sesija_menadzera.php");
//Uzima vrednost iz internet adrese .php?key=...
$kljuc = $_REQUEST['key'];
include 'konekcija.php';
//Tekst obaveštenja
$poruka = "Menadzer Vas je odredio za tim lidera. Na stranici Projekti vidite šta je Vas zadatak.";
$naslov = "obavestenje";
//Upisivanje u bazu u tabelu slanje_poruka
$upit = "INSERT INTO `slanje_poruka` (`prima`, `salje`, `pregledana_po`, `naslov_poruke`, `tekst_prim_poruke`, `tekst_posl_poruke`)"
." VALUES ('".$kljuc."', '".$pri_kor."', 0, '".$naslov."', '".$poruka."', '".$poruka."')";
mysqli_query($kon_sa_serv, $upit);
//Zatvaranje konekcije
mysqli_close($kon_sa_serv);
//Preusmerenje na projekti_po_timovima.php
echo "<script>location.href = 'projekti_po_timovima.php'</script>";
?>
