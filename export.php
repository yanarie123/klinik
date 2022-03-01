<?php 
header ("content-type:application/vnd-ms-excel");
header ("content-disposition: attachment; filename=Data Pasien.xls");
?>

<h3> DATA PASIEN </h3>
<table>
<tr>
	<th>No</th>
	<th>No. RM</th>
	<th>Kategori </th>
	<th>HPJS</th>
	<th>Nama Pasien </th>
	<th>Jenis Kelamin</th>
	<th>Alamat</th>
</tr>
<tr>
	<?php
	include_once "library/inc.connection.php";
		$mySql = "SELECT * FROM Pasien";
		$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah : ".mysql_error());
		$nomor = 0;
		while ($myData = mysql_fetch_array ($myQry)){
		$nomor ++ ;
			?>
	<td align="center"><?php echo $nomor; ?></td>
     <td align="center"><?php echo $myData ['nomor_rm']; ?></td>
     <td align="center"><?php echo $myData ['Kategori']; ?></td>
     <td align="center"><?php echo $myData ['no_bpjs'];?> </td>
     <td><?php echo $myData ['nm_pasien']; ?></td>
      <td align="center"><?php echo $myData ['jns_kelamin']; ?></td>
      <td><?php echo $myData ['alamat']; ?></td>
	  </tr>
	  <?php } ?>
</table>