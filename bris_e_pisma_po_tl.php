<?php
include("sesija_tim_lidera.php");

$id_por = $_REQUEST['key'];
include 'konekcija.php';
//Brisanje iz tabele slanje_poruka reda gde je imejl sa id-jem $id_por
$upit = "DELETE FROM `slanje_poruka` WHERE `idporuke` = '".$id_por."'";
mysqli_query($kon_sa_serv, $upit);
mysqli_close($kon_sa_serv);

echo "<script>location.href = 'primlj_e_pisma_tl.php'</script>";
?>




