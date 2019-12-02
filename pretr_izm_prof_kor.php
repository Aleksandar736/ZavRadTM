<?php

include 'konekcija.php';

if(isset($_REQUEST["q"])){
$q = $_REQUEST["q"];    

echo "<div>";
echo "<table border = '2' width = '85%'>";
echo "<tr>";
echo "<th>Korisničko ime</th>";
echo "<th>Lozinka</th>";
echo "<th>Izm.<br/> loz.</th>";
echo "<th>Ime</th>";
echo "<th>Izm.<br/> ime</th>";
echo "<th>Prezime</th>";
echo "<th>Izm.<br/> prez.</th>";
echo "<th>Radno mesto</th>";
echo "<th>Izm.<br/> r.m.</th>";
echo "<th>Imejl</th>";
echo "<th>Izm.<br/> me.</th>";
echo "<th>Verifikacioni kod</th>";
echo "<th>Izmeni<br/> v.k.</th>";
echo "</tr>";

$upit = "SELECT * FROM `korisnici` WHERE `korisnicko_ime` LIKE '%".$q."%'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
        $kor_im = $red['korisnicko_ime'];
        $loz_cl = $red['lozinka'];
        $ime_cl = $red['ime'];
        $prez_cl = $red['prezime'];
        $rad_me_cl = $red['radno_mesto'];
        $imejl_cl = $red['imejl'];
        $ver_kod = $red['verifikacija'];
        
        echo "<tr>";
        echo "<td>$kor_im</td>";
        echo "<td>$loz_cl</td>";
        echo "<td width = '70px'><a href = 'izm_loz_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a>";                            
        echo "<td>$ime_cl</td>";
        echo "<td width = '70px'><a href = 'izmena_ime_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                            
        echo "<td>$prez_cl</td>";
        echo "<td width = '70px'><a href = 'izmena_pre_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                            
        echo "<td>$rad_me_cl</td>";
        echo "<td width = '70px'><a href = 'izm_rad_mes_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                             
        echo "<td>$imejl_cl</td>";
        echo "<td width = '70px'><a href = 'izm_imejl_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a></td>";                             
        echo "<td>$ver_kod</td>";
        echo "<td width = '70px'><a href = 'izm_v_k_kor.php?key=".$kor_im."'>"
        . "<img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a>";
        echo "</tr>";
    }
}
?>




