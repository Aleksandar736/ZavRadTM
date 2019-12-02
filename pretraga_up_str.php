<?php

include 'konekcija.php';
if(isset($_REQUEST["q"])){
$q = $_REQUEST["q"];    
echo "</div>";
echo "<table border = '2' width = '90%'>";
echo "<tr>";
echo "<th>Ime korisnika</th>";
echo "<th>Ime tima</th>";
echo "<th>Uloga u timu</th>";
echo "<th>Brisanje <br/>/ Izmene</th>";
echo "</tr>";
$tra_kor = array();
$upit = "SELECT * FROM `ucesce` WHERE `korisnicko_ime` LIKE '%".$q."%'";
$result = mysqli_query($kon_sa_serv, $upit);
while ($red = mysqli_fetch_assoc($result)) {
    $kor_ime = $red['korisnicko_ime'];
    $ime_tima = $red['ime_tima'];
    $poz = $red['uloga'];
    $ime_proje = $red['ime_projekta'];
    
    $tra_kor = $kor_ime;
    
    echo "<tr><td><b>".ucfirst($tra_kor)."</b></td>";
    if($ime_tima == ""){
        echo "<td><b><font color = 'red'>van tima</font></b></td>";
    }
    else{
        echo "<td>".ucfirst($ime_tima)."</td>";
    }
    if($poz == "tim_lider"){
        echo "<td><font color = 'red'><b>$poz</b></font></td>";
    }
    else{
        echo "<td>$poz</td>";
    }
    echo "<td width = '70px'><a href = 'brisanje_iz_tima.php?key=".$tra_kor."'><img src = 'images/list_remove_user.png' alt = 'delete' border = '0'></img></a>";
    echo "<a href = 'prerasporedje_kor.php?key=".$tra_kor."'><img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></img></a>";
}

echo "</table>";
echo "</div>";

}
mysqli_close($kon_sa_serv);

?>



