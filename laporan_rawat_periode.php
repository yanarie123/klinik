<?php
include_once "library/inc.seslogin.php";

#Deklarasi Variabel
$filterPeriode = "";
$tglAwal = "";
$tglAkhir = "";
#Membaca tanggal dari form, jika belum di-POST formnya, maka diisi dengan tanggal sekarang
$tglAwal = isset ($_POST ['txtTglAwal']) ? $_POST ['txtTglAwal'] : "01-".date('m-Y');
$tglAkhir= isset ($_POST ['txtTglAkhir']) ? $_POST ['txtTglAkhir'] : date ('d-m-Y') ;
//Jika tombol filter tanggal (tampilkan) diklik
if (isset ($_POST ['btnTampil'])) {
//membuat sub SQL filter data berdasarkan 2 tanggal (periode)
$filterPeriode = "WHERE (tgl_rawat BETWEEN'".InggrisTgl ($tglAwal)."' AND'".InggrisTgl ($tglAkhir)."')";
}
else {
//Membaca data tanggal dari URL, saat menu Pages diklik
	$tglAwal 	= isset($_GET['tglAwal']) ? $_GET['tglAwal'] : $tglAwal;
	$tglAkhir 	= isset($_GET['tglAkhir']) ? $_GET['tglAkhir'] : $tglAkhir; 
//Membuat sub SQL filter data berdasarkan 2 tanggal (periode)
$filterPeriode = "WHERE (tgl_rawat BETWEEN '".InggrisTgl ($tglAwal)."' AND'". InggrisTgl ($tglAkhir)."')"; 
}

#NOMOR HALAMAN PAGING
$row = 50;
$hal = isset ($_GET ['hal']) ? $_GET ['hal'] : 0;
$pageSql = "SELECT * FROM rawat $filterPeriode"; 
$pageQry = mysql_query ($pageSql, $koneksidb)
			or die ("error paging: ".mysql_error());
$jml = mysql_num_rows ($pageQry);
$max = ceil ($jml/$row);
?> 



<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p class="style1">LAPORAN DATA RAWAT PASIEN PER PERIODE</p>
<form action="<?php $_SERVER ['PHP_SELF'];?>" method="post" name="form1" target="_self">
  <table width="500" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#CCCCCC"><strong>PERIODE RAWAT </strong></td>
    </tr>
    <tr>
      <td width="90"><strong>Periode </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="391">
	  <input name="txtTglAwal" type="text" class="tcal" value="<?php echo $tglAwal; ?>" /> s/d
      <input name="txtTglAkhir" type="text" class="tcal" value="<?php echo $tglAkhir; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
	  
</form>

<table class="table-list" width="1285" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="9" align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" >&nbsp;</td>
    <td align="center" ><a href="export_rawat.php"><img src="images/excel.png" width="30" height="30" border="0"></a></td>
  </tr>
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="68" bgcolor="#CCCCCC"><strong>No. Rawat </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Tgl. Rawat </strong></td>
    <td width="75" bgcolor="#CCCCCC"><strong>Nomor RM </strong></td>
    <td width="140" bgcolor="#CCCCCC"><strong>Nama Pasien  </strong></td>
    <td width="68" align="right" bgcolor="#CCCCCC"><div align="center"><strong>Kategori</strong></div></td>
    <td width="74" align="right" bgcolor="#CCCCCC"><strong> Bayar (Rp) </strong></td>
    <td width="113" bgcolor="#CCCCCC"><strong>Keluhan</strong></td>
    <td width="263" bgcolor="#CCCCCC"><strong>Hasil Diagnosa </strong></td>
    <td width="71" align="center" bgcolor="#CCCCCC">ID Dokter </td>
    <td width="180" align="center" bgcolor="#CCCCCC">Dokter</td>
    <td width="58" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
  </tr>
  
  <?php
  #Perintah Untuk menamiplkan data Rawat dengan Filter Periode
	$mySql = "SELECT * FROM rawat
				INNER JOIN pasien ON rawat.nomor_rm = pasien.nomor_rm
				INNER JOIN rawat_tindakan ON rawat.no_rawat = rawat_tindakan.no_rawat
				$filterPeriode
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
    <td><?php echo $myData ['no_rawat'];?></td>
    <td><?php echo IndonesiaTgl ($myData ['tgl_rawat']);?></td>
    <td><?php echo $myData ['nomor_rm'];?></td>
    <td><?php echo $myData ['nm_pasien'];?></td>
    <td> <?php echo $myData ['Kategori'];?></td>
    <td align="right"><?php echo format_angka ($myData ['uang_bayar']);?></td>
    <td><?php echo $myData ['Keluhan'];?></td>
    <td><?php echo $myData ['hasil_diagnosa'];?></td>
    <td><?php echo $myData ['kd_dokter'];?></td>
	<td align="center"><?php 
	 $kd = $myData["kd_dokter"];
	 $ambil = "select * from dokter where kd_dokter= '$kd'";
	 $sql_dokter = mysql_query ($ambil, $koneksidb)     or die("Query failed with error: ".mysql_error());
	 while ($myDokter = mysql_fetch_array($sql_dokter)) {
	  echo $myDokter['nm_dokter']."<br>"; }?></td>
	<td align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $myData ['no_rawat'];?>"><img src="images/btn_print.png" width="20" height="20"></a></td>
    <td width="11"><div align="center"><a href="cetak/rawat_cetak.php?noRawat=<?php echo $myData ['no_rawat'];?>"></a> </div></td>
  </tr>
  <?php } ?>
    
  <tr>
    <td colspan="3"><strong>Jumlah Data :</strong><?php echo $jml; ?></td>
    <td colspan="9" align="right"><strong>Halaman ke :</strong>
  <?php 
		for ($h = 1; $h <= $max; $h++) {
		$list [$h] = $row * $h - $row;
		echo " <a href='?page=Laporan-Rawat-Periode&hal=$list[$h]$tglAwal&tglAkhir=$tglAkhir'>$h</a>";
		}
		?>  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
