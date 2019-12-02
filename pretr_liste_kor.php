<?php

include 'konekcija.php';

if(isset($_REQUEST["q"])){
$q = $_REQUEST["q"];    

echo "<div>";
echo "<table border = '2' width = '85%'>";
echo "<tr>";
echo "<th>Korisničko ime</th>";
echo "<th>Tim</th>";
echo "</tr>";

$upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` LIKE '%".$q."%'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $kor_im = $red['korisnicko_ime'];
    $im_ti = $red['ime_tima'];

    echo "<tr>";
    echo "<td>".ucfirst($kor_im)."</td>";
    echo "<td>".ucfirst($im_ti)."</td>";
    echo "</tr>";
    }
}
?>

