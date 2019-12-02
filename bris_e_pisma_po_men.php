<?php
include("sesija_menadzera.php");

$id_por = $_REQUEST['key'];
include 'konekcija.php';
//Brisanje iz tabele slanje_poruka reda gde je imejl sa id-jem $id_por
$upit = "DELETE FROM `slanje_poruka` WHERE `idporuke` = '".$id_por."'";
mysqli_query($kon_sa_serv, $upit);
mysqli_close($kon_sa_serv);

echo "<script>location.href = 'poslata_e_pisma_men.php'</script>";
?>


