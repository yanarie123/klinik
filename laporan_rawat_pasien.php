<?php
include_once "library/inc.seslogin.php";

// Variabel SQL
$filterSQL= "";

// Temporary Variabel form
$dataPasien	= isset($_POST['cmbPasien']) ? $_POST['cmbPasien'] : 'SEMUA';

# PENCARIAN DATA BERDASARKAN FILTER DATA
if(isset($_POST['btnTampil'])) {
	# PILIH pasien
	if (trim($_POST['cmbPasien']) =="KOSONG") {
		$filterSQL = "";
	}
	else {
		$filterSQL = "WHERE rawat.nomor_rm='$dataPasien'";
	}
}
else {
	$filterSQL= "";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat $filterSQL";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<h2>LAPORAN DATA RAWAT PER PASIEN</h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA PASIEN </strong></td>
    </tr>
    <tr>
      <td width="130"><strong>Nama Pasien </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="351">
	  <select name="cmbPasien">
        <option value="KOSONG">....</option>
        <?php
	  $dataSql = "SELECT * FROM pasien ORDER BY nomor_rm";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['nomor_rm'] == $dataPasien) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[nomor_rm]' $cek>[ $dataRow[nomor_rm] ]  $dataRow[nm_pasien]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>

<table class="table-list" width="1219" border="0" cellspacing="1" cellpadding="2">
  
  <tr>
    <td colspan="9" align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" ><a href="export_rawat.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="21" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="67" bgcolor="#CCCCCC"><strong>No. Rawat </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="76" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="144" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="70" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Kategori</strong></div></td>
    <td width="74" align="right" bgcolor="#CCCCCC"><strong> Bayar (Rp) </strong></td>
    <td width="152" bgcolor="#CCCCCC"><div align="center"><strong>Keluhan</strong></div></td>
    <td width="226" bgcolor="#CCCCCC"><strong>Hasil Diagnosa </strong></td>
    <td width="65" align="center" bgcolor="#CCCCCC">ID Dokter </td>
    <td width="119" align="center" bgcolor="#CCCCCC">Dokter</td>
    <td width="50" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  <?php
	# Perintah untuk menampilkan Semua Daftar Transaksi rawat
	$mySql = "SELECT * FROM rawat
				INNER JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				INNER JOIN rawat_tindakan ON rawat.no_rawat = rawat_tindakan.no_rawat
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
	
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
			$nomor++;		
		
	# Membaca Nomor Rawat
	$noRawat = $myData['no_rawat']; 
	?>
	
  <tr>
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['no_rawat']; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_rawat']); ?></td>
    <td><?php echo $myData['nomor_rm']; ?></td>
    <td><?php echo $myData['nm_pasien']; ?></td>
    <td><?php echo $myData['Kategori']; ?></td>
    <td align="right"><?php echo format_angka($myData['uang_bayar']); ?></td>
    <td><?php echo $myData['Keluhan']; ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td align="center"><?php echo $myData['kd_dokter']; ?></td>
	 <td align="center"><?php 
	 $kd = $myData["kd_dokter"];
	 $ambil = "select * from dokter where kd_dokter= '$kd'";
	 $sql_dokter = mysql_query ($ambil, $koneksidb)     or die("Query failed with error: ".mysql_error());
	 while ($myDokter = mysql_fetch_array($sql_dokter)) {
	  echo $myDokter['nm_dokter']."<br>"; }?></td>
    <td align="center"></a><a href="cetak/rawat_cetak.php?noRawat=<?php echo $noRawat; ?>" target="_blank"><img src="images/btn_print.png" width="20" height="20" /></a></td>
	 <td width="14" align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $noRawat; ?>" target="_blank"></a></td>
  </tr>
    <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="9" align="right"><strong>Halaman ke :</strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Rawat-Pasien&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
