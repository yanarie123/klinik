<?php
# Pengaturan tanggal komputer

date_default_timezone_set ("Asia/Jakarta");

# Fungsi untuk membuat kode automatis
function buatKode ($tabel, $inisial) {
	$struktur = mysql_query ("SELECT * FROM $tabel");
	$field = mysql_field_name ($struktur, 0);
	$panjang = mysql_field_len ($struktur, 0);
	$qry = mysql_query ("SELECT MAX (" .$field.") FROM ".$tabel);
	$row = mysql_fetch_array ($qry);
	if ($row [0]=="") {
			$angka=0;

}

else {
		$angka = substr ($row [0], strlen ($inisial));

}
$angka++;
$angka = strval ($angka);
$tmp = "";
for ($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)) ; $i++) {
		$tmp=$tmp."0";

}
return $inisial.$tmp.$angka;
}

function InggrisTgl ($tanggal) {
	$tgl = substr ($tanggal, 0, 2) ;
	$bln = substr ($tanggal, 3,2) ;
	$thn = substr ($tanggal, 6, 4) ;
	$awal = "thn-$bln-$tgl";
	return $awal ;
}

function IndonesiaTgl ($tanggal) {
	$tgl = substr ($tanggal, 8, 2);
	$bln = substr ($tanggal, 5, 2) ;
	$thn = substr ($tanggal, 0, 4) ;
	$awal = "$tgl-$bln-$thn" ;
	return $awal ;
}

function format_angka ($angka) {
	$hasil = number_format ($angka, 0, ",",".") ;
	return $hasil;
}

?>