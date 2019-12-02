<?php

include 'konekcija.php';
if(isset($_REQUEST["q"])){
$q = $_REQUEST["q"];

echo "<div>";
echo "<table border = '2' width = '90%'>";
echo "<tr>";
echo "<th>Projekti</th>";
echo "<th>Opis</th>";
echo "<th>Brisanje / Izmene</th>";
echo "</tr>";

$tra_proj = array();
$upit = "SELECT * FROM `projekti` WHERE `ime_projekta` LIKE '%".$q."%'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $im_pro = $red['ime_projekta'];
    $op_pro = $red['opis_projekta'];
    
    $tra_proj = $im_pro;
    
    echo "<tr><td><b>".ucfirst($tra_proj)."</b></td>";
    if($op_pro ==""){
        echo "<td><b><font color = 'red'>bez opisa</font></b></td>";
    }
    else{
        echo "<td>$op_pro</td>";
    }
    echo "<td width = '70px'><a href = 'bris_projekta.php?key=".$tra_proj."'><img src = 'images/garbage.png' border = '0' alt = 'izbriši projekat'></img></a>";
    echo "<a href = 'prom_opisa_proje.php?key=".$tra_proj."'><img src = 'images/005-pen_1.png' border = '0' alt = 'izmene'></img></a></td></tr>";
}
mysqli_close($kon_sa_serv);
}
echo "</table>";
echo "</div>";
?>
