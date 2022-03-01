
<?php
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
		$mySql = "SELECT * FROM rawat
				INNER JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				INNER JOIN rawat_tindakan ON rawat.no_rawat = rawat_tindakan.no_rawat
				WHERE Kategori='$txtKataKunci'";
			}
		}	
		else {
  	$mySql = "SELECT * FROM rawat
				INNER JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				INNER JOIN rawat_tindakan ON rawat.no_rawat = rawat_tindakan.no_rawat
				ORDER BY rawat.no_rawat ASC LIMIT $hal, $row";
		} 

// Membaca variabel form
$dataKataKunci	= isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';
?>


		

		<!DOCTYPE html>
<html>
<head>
	<title></title>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style></head>
<body>
	
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<p class="style1">LAPORAN DATA PASIEN</p>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
  <table  class="table-list" width="500" border="0" cellspacing="1" cellpadding="4">
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
  </table>
</form>
<table class="table-list" width="1100" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="10" align="right"><a href="export_rawat.php"></a><br>
      </br></td>
    <td align="center"><a href="export_rawat.php"><img src="images/excel.png" width="30" height="30" border="0"></a></td>
  <tr>
    <td width="24" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="71" align="center" bgcolor="#CCCCCC"><strong>No. RM </strong></td>
    <td width="94" align="center" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="95" align="center" bgcolor="#CCCCCC"><strong>No. RM</strong></td>
    <td width="153" align="center" bgcolor="#CCCCCC"><strong>Nama</strong></td>
    <td width="67" align="center" bgcolor="#CCCCCC"><strong>Kategori</strong></td>
    <td width="55" align="center" bgcolor="#CCCCCC"><strong>Bayar </strong></td>
    <td width="182" align="center" bgcolor="#CCCCCC"><strong>Keluhan</strong></td>
    <td width="103" align="center" bgcolor="#CCCCCC"><strong>Diagnosa</strong></td>
    <td width="126" align="center" bgcolor="#CCCCCC"><strong>Dokter</strong></td>
    <td width="74" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  <?PHP
  
  //Query SQL ada di bagian atas, kolom tombol cari (btnCari)

 	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
  $nomor = 0;
  while ($myData = mysql_fetch_array ($myQry)) {
  $nomor++;
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
    <td colspan="3">&nbsp;</td>
  <td colspan="8" align="right">  </tr>
  <tr>
     <td colspan="3"><strong>Jumlah Data :</strong> <?php echo $jml; ?> </td>
    <td colspan="8" align="right"><strong>Halaman ke :</strong>
  <?php
	for ($h = 1; $h  <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo "<a href='?page=Laporan-Pasien&hal=$list[$h]'> $h</a> ";
		}
		?>  </tr>
</table>
<p class="style1">&nbsp;</p>


</body>
</html>
