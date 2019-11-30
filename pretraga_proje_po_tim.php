<?php

include 'konekcija.php';

if(isset($_REQUEST["q"])){
    $q = $_REQUEST["q"];

    echo "<div>";
    echo "<table border = '2' width = '90%'>";
    echo "<tr>";
    echo "<th>Tim</th>";
    echo "<th>Tim lider</th>";
    echo "<th>Članovi tima</th>";    
    echo "<th>Projekat</th>";
    echo "<th>Zameni ili <br/>dodeli<br/>projekat</th>";
    echo "<th>Obavesti <br/>tim lidera</th>";    
    echo "</tr>";

    $pro_po_tim = array();
    $upit = "SELECT * FROM `ucesce` WHERE `uloga` = 'tim_lider' AND `ime_projekta` LIKE '%".$q."%'";
    $result = mysqli_query($kon_sa_serv, $upit);
    while ($red = mysqli_fetch_assoc($result)) {
        $imetima = $red['ime_tima'];
        $imekori = $red['korisnicko_ime'];
        $imeproj = $red['ime_projekta'];
        
        $pro_po_tim = $imeproj;
        
        echo "<tr><td align = 'center'>".ucfirst($imetima)."</td>";
        echo "<td align = 'center'>".ucfirst($imekori)."</td>";
        
        echo"<td>";
        if($imetima !='menadzeri'){
            $upit1 = "SELECT `korisnicko_ime` FROM `ucesce` WHERE `ime_tima` = '".$imetima."' AND `uloga` = 'obicni_clan_tima'";
            $result1 = mysqli_query($kon_sa_serv, $upit1);
            while ($red = mysqli_fetch_assoc($result1)) {
                $kor_im = $red['korisnicko_ime'];
                echo ucfirst($kor_im).', ';
            }                            
        }
        echo "</td>";        
        
        if($pro_po_tim == ""){
            echo "<td align = 'center'><b><font color = 'red'>bez dodeljenog projekta</font><b></td>";
            echo "<td align = 'center' width = '70px'><img src = 'images/005-pen_1.png' border = '0' alt = 'dodelj_proj_timu'></img>";
            echo "<a href = 'dodelj_proj_timu.php?key=".$imekori."'><img src = 'images/task_list.png' border = '0' alt = 'dodelj_proj_timu'></img></a></td>";
            echo "<td align = 'center' width = '40px'><img src = 'images/Mail.png' border = '0' alt = 'notify'></img></td></tr>";
        }
        else{
            echo "<td align = 'center'>".ucfirst($pro_po_tim)."</td>";
            echo "<td align = 'center' width = '70px'><a href = 'prom_dodelj_proj_timu.php?key=".$imekori."'><img src = 'images/005-pen_1.png' border = '0' alt = 'add group task'></img></a>";
            echo "<img src = 'images/task_list.png' border = '0' alt = 'dodelj_proj_timu'></img></td>";
            echo "<td align = 'center' width = '40px'><a href = 'obave_tl_o_post.php?key=".$imekori."'><img src = 'images/Mail.png' border = '0' alt = 'notify'></img></a></td></tr>";
        }
    }
    mysqli_close($kon_sa_serv);
}
echo "</table>";
echo "</div>";
?>
