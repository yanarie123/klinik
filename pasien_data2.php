<?php
include_once "library/inc.seslogin.php";
$row = 50;
$hal = isset ($_GET ['hal']) ? $_GET ['hal'] : 0;
$pageSql = "SELECT * FROM Pasien";
$pageQry = mysql_query ($pageSql, $koneksidb) or die ("error paging : ".mysql_error());
$jml = mysql_num_rows ($pageQry);
$max = ceil ($jml/$row);
?>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {font-family: Arial, Helvetica, sans-serif}
.style4 {
	font-size: 16px;
	font-weight: bold;
}
.style5 {font-size: 16px}
-->
</style>
<table width="924" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2" align="right"><p align="center" class="style1">DATA PASIEN </p></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><a href="?page=Pasien-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="22" align="center"><div align="center"><span class="style3">No</span></div></th>
        <th width="54"><div align="center"><span class="style3">No RM</span></div></th>
        <th width="73"><div align="center"><span class="style3">Katagori</span></div></th>
        <th width="158"><div align="center">No. BPJS/Pertamina</div></th>
        <th width="135"><div align="center"><span class="style3">Nama Pasien </span></div></th>
        <th width="72"><div align="center"><span class="style3">Kelamin</span></div></th>
        <th width="71">Pekerjaan</th>
        <th width="206"><div align="center"><span class="style3">Alamat</span></div></th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><div align="center"><span class="style3"><strong>Tools</strong></span></div></td>
      </tr>
	  
			<?php
		$mySql = "SELECT * FROM Pasien ORDER BY nomor_rm ASC LIMIT $hal, $row";
		$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
		$nomor = 0;
		while ($myData = mysql_fetch_array ($myQry)){
		$nomor ++ ;
		$Kode = $myData ['nomor_rm']
		?>
		
      <tr>
        <td align="center"><?php echo $nomor; ?></td>
        <td align="center"><?php echo $myData ['nomor_rm']; ?></td>
        <td align="center"><?php echo $myData ['Kategori']; ?></td>
        <td align="center"><?php echo $myData ['no_bpjs'];?> </td>
        <td><?php echo $myData ['nm_pasien']; ?></td>
        <td align="center"><?php echo $myData ['jns_kelamin']; ?></td>
        <td><?php echo $myData ['pekerjaan']; ?></td>
        <td><?php echo $myData ['alamat']; ?></td>
        <td width="30" align="center" with="8%"><a href="?page=Pasien-Edit&Kode=<?php echo $Kode; ?>"><img src="images/edit.png" width="20" height="20" /></a></td>
        <td width="46" align="center"><a href="?page=Pasien-Delete&Kode=<?php echo $Kode;?>" target="_self" onclick="return confirm ('ANDA YAKIN AKAN MENGHAPUS DATA PASIEN INI....?')"><img src="images/delete.png" width="20" height="20" /></a></td>
      </tr>
	  <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><a href="export.php"></a></td>
  </tr><tr>
    <td width="433"><div align="center" class="style4">
      <div align="left">Jumlah Data : </div>
    </div></td>
	 <td width="480" align="right"><div align="center" class="style5">
	   <div align="right"><strong>Halaman ke :</strong> 
	      <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?page=Pasien-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
        </div>
    </div></td>
</table>
