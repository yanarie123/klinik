<?php 
include_once "library/inc.seslogin.php";
#Deklarasi Variabel
$filterPeriode = "";
$tglAwal = "";
$tglAkhir = "";
#Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal = isset ($_POST ['txtTglAwal']) ? $_POST ['txtTglAwal'] : "01-".date ('m-Y');
$tglAkhir = isset ($_POST ['txtTglAkhir']) ? $_POST ['txtTglAkhir'] : date ('d-m-Y');
//jIKA TOMBOL filter tanggal (tampilkan) diklik
if (isset ($_POST ['btnTampil'])) {
	//Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
	$filterPeriode = "WHERE (tgl_penjualan BETWEEN '".InggrisTgl($tglAwal). "'AND'".InggrisTgl ($tglAkhir)."')";
	}
	else {
	//Membaca data tanggal dari URL, saat Nomor Halaman di klik
	$tglAwal = isset ($_GET ['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir = isset ($_GET ['tglAkhir']) ? $_GET ['tglAkhir'] : $tglAkhir;
	//Membuat sub SQL filter data berdasarkan 2 tanggal (periode0
	$filterPeriode = "WHERE (tgl_penjualan BETWEEN'".InggrisTgl ($tglAwal)."'AND'".InggrisTgl ($tglAkhir)."')";
	}

#PAGING HALAMAN
$row = 50;
$hal = isset ($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan $filterPeriode";
$pageQry = mysql_query ($pageSql, $koneksidb)
			or die ("error paging : ".mysql_error());
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
<h2>LAPORAN DATA PENJUALAN OBAT PER PERIODE </h2>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="form1" target="_self">
  <table width="500" border="0" class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>PERIODE PENJUALAN </strong></td>
    </tr>
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="391"><input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" />
        s/d
        <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>
<table class="table-list" width="845" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5" align="center" >&nbsp;</td>
    <td width="236" align="center">&nbsp;</td>
    <td align="center"><a href="export_penjualan.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="30" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="87" bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
    <td width="98" bgcolor="#CCCCCC"><strong>No. Penjualan </strong></td>
    <td width="206" bgcolor="#CCCCCC"><strong>Pelanggan </strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Keterangan </strong></td>
    <td width="43" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
  
# Perintah untuk menampilkan Semua Daftar Transaksi Penjualan
	$mySql = "SELECT * FROM penjualan ORDER BY no_penjualan DESC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['no_penjualan'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl ($myData ['tgl_penjualan']);?></td>
    <td><?php echo $myData ['no_penjualan'];?></td>
    <td><?php echo $myData ['pelanggan'];?></td>
    <td colspan="2"><?php echo $myData ['keterangan'];?></td>
    <td align="center"><a href="cetak/penjualan_cetak.php?noNota=<?php echo $noNota; ?>"><img src="images/btn_print.png" width="20" height="20" border="0" /></a></td>
  </tr>
  <?php } ?>
  <tr>
     <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jml; ?></td>
    <td colspan="4" align="right"><strong>Halaman ke :</strong>
  <?php
	for ($h = 1; $h <= $max; $h++) {
	$list [$h] = $row * $h - $row;
	echo "<a href='?page=Laporan-Penjualan-Periode&hal=$list[$h]&tglAwal=$tglAwal&tglAkhir=$tglAkhir'>$h</a>";
	}
	?>  </tr>
</table>
<p class="style1">&nbsp;</p>
