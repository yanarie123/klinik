<?php
//Konek ke web server lokal
$myHost = "localhost";
$myUser = "root";
$myPass = "" ;
$myDbs = "klinik_samudra";

//konek ke web server lokal
$koneksidb = mysql_connect ($myHost, $myUser, $myPass);
if (! $koneksidb) {
echo "Failed Connection !";
}

//memilih database pada MySQL server
mysql_select_db ($myDbs) or die ("Database not Found!");
?>