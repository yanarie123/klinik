<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM rawat";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);

// Jika tombol Cari diklik
if(isset($_POST['btnCari'])){
	if($_POST) {
		// Cari berdasarkan Nomor RM dan Nama Pasien yang mirip
		$txtKataKunci	= $_POST['txtKataKunci'];
		$mySql = "SELECT * FROM pasien WHERE Kategori='$txtKataKunci'";
			}
		}	
		else {
			# Perintah untuk menampilkan Semua Daftar Transaksi rawat
	$mySql = "SELECT * FROM rawat
				INNER JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				INNER JOIN rawat_tindakan ON rawat.no_rawat = rawat_tindakan.no_rawat
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
			} 

// Membaca variabel form
$dataKataKunci	= isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';


?>
<h2>LAPORAN DATA RAWAT PASIEN </h2>
<table class="table-list" width="978" border="0" cellspacing="1" cellpadding="2">
  <tr>
      <th colspan="3"><strong>CARI PASIEN </strong></th>
    </tr>
    <tr>
      <td width="139"><strong>Kategori / Nama </strong></td>
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
    <tr>
    <td colspan="11" align="center" >&nbsp;</td>
    <td width="37" colspan="3" align="center" ><a href="export_rawat.php"><img src="images/excel.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td width="27" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="61" bgcolor="#CCCCCC"><strong>No. Rawat </strong></td>
    <td width="61" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="65" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="89" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="65" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Kategori</strong></div></td>
    <td width="67" align="right" bgcolor="#CCCCCC"><strong> Bayar (Rp) </strong></td>
    <td width="119" bgcolor="#CCCCCC"><div align="center"><strong>Keluhan</strong></div></td>
    <td width="117" bgcolor="#CCCCCC"><strong>Hasil Diagnosa </strong></td>
    <td width="65" align="center" bgcolor="#CCCCCC"><strong>ID Dokter </strong></td>
    <td width="144" align="center" bgcolor="#CCCCCC"><strong>Dokter</strong></td>
    <td colspan="3" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
 
  
  <?php

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
    <td><?php echo format_angka($myData['uang_bayar']); ?></td>
    <td><?php echo $myData['Keluhan']; ?></td>
    <td><?php echo $myData['hasil_diagnosa']; ?></td>
    <td align="center"><?php echo $myData['kd_dokter']; ?></td>
    <td align="center"></a>
    <?php 
	 $kd = $myData["kd_dokter"];
	 $ambil = "select * from dokter where kd_dokter= '$kd'";
	 $sql_dokter = mysql_query ($ambil, $koneksidb)     or die("Query failed with error: ".mysql_error());
	 while ($myDokter = mysql_fetch_array($sql_dokter)) {
	  echo $myDokter['nm_dokter']."<br>"; }?></td>
	 <td align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $noRawat; ?>"><img src="images/btn_print.png" width="30" height="30" border="0" /></a></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="11" align="right"><strong>Halaman ke :</strong>
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Rawat&hal=$list[$h]'>$h</a> ";
	}
	?></td>
  </tr>
</table>
