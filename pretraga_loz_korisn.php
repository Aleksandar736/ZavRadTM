<?php

include 'konekcija.php';

if(isset($_REQUEST["q"])){
$q = $_REQUEST["q"];    

echo "<div>";
echo "<table border = '2' width = '85%'>";
echo "<tr>";
echo "<th>Korisničko ime</th>";
echo "<th>Lozinka</th>";
echo "<th>Izmeni<br/> lozinku</th>";
echo "</tr>";

$upit = "SELECT * FROM `korisnici` WHERE `korisnicko_ime` LIKE '%".$q."%'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
        $kor_im = $red['korisnicko_ime'];
        $loz_cl = $red['lozinka'];
        
        echo "<tr>";
        echo "<td>$kor_im</td>";
        echo "<td>$loz_cl</td>";
        echo "<td width = '70px'><a href = 'prom_zab_loz_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";        
        echo "</tr>";
    }
}
?>


