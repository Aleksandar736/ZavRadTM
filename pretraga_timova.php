<?php

include 'konekcija.php';

if(isset($_REQUEST["q"])){
    $q = $_REQUEST["q"];

    echo "<div>";
    echo "<table border = '2' width = '90%'>";
    echo "<tr>";
    echo "<th>Timovi</th>";
    echo "<th>Tim lideri</th>";
    echo "<th>Članovi tima</th>";
    echo "<th>Napravi izmenu</th>";
    echo "</tr>";

    $tra_tim = array();
    $upit = "SELECT * FROM `timovi` WHERE `ime_tima` LIKE '%".$q."%'";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        $ime_tima = $red['ime_tima'];
        $tim_lider = $red['tim_lider'];

        $tra_tim = $ime_tima;

        echo"<tr><td><b>".ucfirst($tra_tim)."</b></td>";
        if($tim_lider == ""){
            echo"<td><b><font color = 'red'>bez tim lidera</font></b></td>";	
        }
        else{
            echo"<td>".ucfirst($tim_lider)."</td>";
        }
        echo"<td>";
    if($tra_tim!='menadzeri'){
        $upit1 = "SELECT `korisnicko_ime` FROM `ucesce` WHERE `ime_tima` = '".$tra_tim."' AND `uloga` = 'obicni_clan_tima'";
        $result1 = mysqli_query($kon_sa_serv, $upit1);
        while ($red = mysqli_fetch_assoc($result1)) {
            $kor_im = $red['korisnicko_ime'];
            echo ucfirst($kor_im).', ';
        }
    }else{
        $upit1 = "SELECT `korisnicko_ime` FROM `ucesce` WHERE `ime_tima` = 'menadzeri'";
        $result1 = mysqli_query($kon_sa_serv, $upit1);
        while ($red = mysqli_fetch_assoc($result1)) {
            $kor_im = $red['korisnicko_ime'];
            echo ucfirst($kor_im).', ';
        }
    }
        echo "</td>";
        echo "<td align = 'center'><a href = 'bris_tim.php?key=".$tra_tim."'><img src = 'images/garbage.png' alt = 'delete' border = '0'></a>";
        echo "<a href = 'prom_imena_tima.php?key=".$tra_tim."'><img src = 'images/005-pen_1.png' border = '0' alt = 'edit'></a>";
    }
    mysqli_close($kon_sa_serv);
}
echo "</table>";
echo "</div>";
?>
