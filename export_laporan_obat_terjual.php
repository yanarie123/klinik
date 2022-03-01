<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Laporan Obat Terjual.xls");

#Deklarasi Variabel
$filterPeriode = "";
$tglAwal = "";
$tglAkhir = "";
#Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal = isset ($_POST ['txtTglAwal']) ? $_POST ['txtTglAwal'] : "01-".date('m-Y');
$tglAkhir= isset ($_POST ['txtTglAkhir']) ? $_POST ['txtTglAwal'] : date ('d-m-Y') ;
//Jika tombol filter tanggal (tampilkan) diklik
if (isset ($_POST ['btnTampil'])) {
//membuat sub SQL filter data berdasarkan 2 tanggal (periode)
$filterPeriode = "WHERE (tgl_penjualan BETWEEN'".InggrisTgl ($tglAwal)."' AND'".InggrisTgl ($tglAkhir)."')";
}
else {
//Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
//Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
$filterPeriode = "WHERE (tgl_penjualan BETWEEN '".InggrisTgl ($tglAwal)."' AND'". InggrisTgl ($tglAkhir)."')"; 
}

#NOMOR HALAMAN PAGING
$row = 50;
$hal = isset ($_GET ['hal']) ? $_GET ['hal'] : 0;
$pageSql = "SELECT * FROM penjualan $filterPeriode"; 
$pageQry = mysql_query ($pageSql, $koneksidb)
			or die ("error paging: ".mysql_error());
$jml = mysql_num_rows ($pageQry);
$max = ceil ($jml/$row);
?> 

<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<h2>LAPORAN OBAT TERJUAL
</h2>
<table class="table-list" width="808" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="30" align="center" bgcolor="#F5F5F5"><b>No</b></td>
    <td width="78" align="center" bgcolor="#F5F5F5"><strong>No. Penjualan</strong></td>
    <td width="91" align="center" bgcolor="#F5F5F5"><strong>Tgl. Penjualan </strong></td>
    <td width="45" align="center" bgcolor="#F5F5F5"><strong>Kode</strong></td>
    <td width="339" align="right" bgcolor="#F5F5F5"><div align="left"><strong><b>Nama Obat</b></strong></div></td>
    <td width="89" align="right" bgcolor="#F5F5F5"><b> Harga (Rp) </b></td>
    <td width="100" align="center" bgcolor="#F5F5F5"><b> Jumlah </b></td>
  </tr>
  <?php
	// SQL menampilkan item obat yang dijual
	$mySql ="SELECT penjualan_item.*, obat.nm_obat, penjualan.no_penjualan FROM penjualan_item
			  LEFT JOIN obat ON penjualan_item.kd_obat=obat.kd_obat
			  LEFT JOIN penjualan ON penjualan.no_penjualan=penjualan_item.no_penjualan
			  $filterPeriode
				ORDER BY penjualan.no_penjualan ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query Tmp".mysql_error());
	$nomor  = 0;  
	while($myData = mysql_fetch_array($myQry)) {
		$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td align="center"></a>
    <?php 
	 $kd = $myData["no_penjualan"];
	 $ambil = "select * from penjualan where no_penjualan= '$kd'";
	 $sql_dokter = mysql_query ($ambil, $koneksidb)     or die("Query failed with error: ".mysql_error());
	 while ($myDokter = mysql_fetch_array($sql_dokter)) {
	  echo $myDokter['tgl_penjualan']."<br>"; }?></td>
    <td><?php echo $myData['kd_obat']; ?></td>
    <td><?php echo $myData['nm_obat']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
    <td align="center"><?php echo $myData['jumlah']; ?></td>
	   <td align="center"> <?php 
	 $stok = $myData["kd_obat"];
	 $ambil = "select * from obat where kd_obat= '$stok'";
	 $sql_stok = mysql_query ($ambil, $koneksidb)     or die("Query failed with error: ".mysql_error());
	 while ($myStok = mysql_fetch_array($sql_stok)) {
	  echo $myStok['stok']."<br>"; }?></td>
	
  </tr>
  <?php } ?>
</table>
<p class="style1">&nbsp;</p>


</body>
</html>
