<?php
function connectaBD()
{
    $servidor = "localhost";
    $port = "5432";
    $DBnom = "tdiw-a7";
    $usuari = "tdiw-a7";
    $clau = "iqF_zira";
    $connexio = pg_connect("host=$servidor port=$port dbname=$DBnom user=$usuari password=$clau") or die("Error connexio DB");
    
    return($connexio);    
}
?>

