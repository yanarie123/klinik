<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM pendaftaran";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>LAPORAN DATA PENDAFTARAN </h2>
<table class="table-list" width="842" border="0" cellspacing="1" cellpadding="2">
  
  <tr>
    <td colspan="8" align="center">&nbsp;</td>
    <td align="center"><a href="export_pendaftaran.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><div align="center"><strong>No</strong></div></td>
    <td bgcolor="#CCCCCC"><div align="center"></div>      <div align="center"><strong>Tgl. Daftar </strong></div></td>
    <td width="75" bgcolor="#CCCCCC"><div align="center"><strong>Nomor RM </strong></div></td>
    <td width="150" bgcolor="#CCCCCC"><div align="center"><strong>Nama Pasien  </strong></div></td>
    <td width="75" bgcolor="#CCCCCC"><div align="center"><strong>Tgl. Janji </strong></div></td>
    <td width="70" bgcolor="#CCCCCC"><div align="center"><strong>Jam. Janji </strong></div></td>
    <td width="134" bgcolor="#CCCCCC"><div align="center"><strong>Tindakan</strong></div></td>
    <td width="69" align="center" bgcolor="#CCCCCC"><div align="center"><strong>Antri</strong></div></td>
    <td width="69" align="center" bgcolor="#CCCCCC"><div align="center"><strong>Tools</strong></div></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi pendaftaran
	$mySql = "SELECT pendaftaran.*, pasien.nm_pasien, tindakan.nm_tindakan 
				FROM pendaftaran 
				LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm
				LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan
				ORDER BY pendaftaran.no_daftar ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;		
		
	# Membaca Kode pendaftaran/ Nomor transaksi
	$noDaftar = $myData['no_daftar']; 
	?>
  <tr>
    <td><div align="center"><?php echo $nomor; ?></div></td>
    <td><div align="center"></div>      <div align="center"><?php echo IndonesiaTgl($myData['tgl_daftar']); ?></div></td>
    <td><div align="center"><?php echo $myData['nomor_rm']; ?></div></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><div align="center"><?php echo IndonesiaTgl($myData['tgl_janji']); ?></div></td>
    <td><div align="center"><?php echo $myData['jam_janji']; ?></div></td>
    <td><div align="center"><?php echo $myData['nm_tindakan']; ?></div></td>
    <td align="center"><?php echo $myData['nomor_antri']; ?></td>
    <td align="center"><a href="cetak/pendaftaran_cetak.php?Kode=<?php echo $myData ['no_daftar'];?>"><img src="images/btn_print.png" width="20" height="20" border="0" /></a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="7" align="right"><strong>Halaman ke :</strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Pendaftaran&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
