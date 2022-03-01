<?php

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM penjualan";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);


// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT * FROM penjualan WHERE no_penjualan='$txtKataKunci' OR pelanggan LIKE '%$txtKataKunci%' 
				  ORDER BY no_penjualan ASC LIMIT $hal, $row";
			}
		}	
		else {
		$mySql = "SELECT * FROM penjualan ORDER BY no_penjualan ASC LIMIT $hal, $row";
		} 

// Membaca variabel form
$dataKataKunci	= isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';


?>


<h1>Laporan Penjualan  Obat </h1>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table  class="table-list" width="500" border="0" cellspacing="1" cellpadding="4">
    <tr>
      <th colspan="3"><strong>CARI PASIEN </strong></th>
    </tr>
    <tr>
      <td width="139"><strong>Nama Pasien </strong></td>
      <td width="1"><strong>:</strong></td>
      <td width="332"><b>
        <input name="txtKataKunci" type="text" value="<?php echo $dataKataKunci; ?>" size="40" maxlength="100" />
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><b>
        <input name="btnCari" type="submit" value="Cari" />
      </b></td>
    </tr>
  </table>
</form>
<table class="table-list" width="839" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="31" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="92" bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
    <td width="99" bgcolor="#CCCCCC"><strong>No. Penjualan </strong></td>
    <td width="161" bgcolor="#CCCCCC"><strong>Pelanggan </strong></td>
    <td width="284" bgcolor="#CCCCCC"><strong>Keterangan </strong></td>
    <td width="59" align="center" bgcolor="#CCCCCC"><strong>Kategori</strong></td>
    <td width="77" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
   //Query SQL ada di bagian atas, kolom tombol cari (btnCari)
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = $hal;
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		# Membaca Kode Penjualan/ Nomor transaksi
		$noNota = $myData['no_penjualan'];
	?>
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_penjualan']); ?></td>
    <td><?php echo $myData['no_penjualan']; ?></td>
    <td><?php echo $myData['pelanggan']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td align="center"><?php echo $myData['kategori']; ?></td>
    <td align="center"><a href="cetak/penjualan_cetak.php?noNota=<?php echo $noNota; ?>" target="_blank">Cetak</a></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
  <td colspan="5" align="right"><strong>Halaman ke :</strong>  </tr>
</table>
