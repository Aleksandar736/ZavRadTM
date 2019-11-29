<?php
session_start();

session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stil.css">
    <title>Glavna stranica</title>
</head>
<body>
    <?php
        include 'header.php';
    ?>     
    <div class="raspored-kolona">      
        <div class="navigacija-sa-leve-strane">
            
        </div>
        
        <div class="glavni-sadrzaj">
            <div class="glavni-naslov">
                <h1>Tim Menadžment</h1>
            </div>
        
            <div class="tekst-sadrzaja">                      
                <div class="tabelaProPo">
                    <form name='login_form' method='post' action='logovanje.php'>
                        <div class="tabelaProPo">
                            <label>Korisničko ime: </label>
                            <input type = 'text' name = 'kor_ime' value = ''>
                        </div>
                        <div class="tabelaProPo">
                            <label>Lozinka: </label>
                            <input type = 'password' name = 'loz' value = ''>
                        </div>
                        <div>
                            <input type = 'submit' name = 'login' class="dugmici" value = 'Uloguj se'>
                        </div>
                    </form>
                </div>                                  
            </div>
        
        </div>
        
        <div class="navigacija-sa-desne-strane">
            
        </div>
    </div>
    <?php
        include 'footer.php';
    ?> 
</body>
</html>
