<?php
include_once "library/inc.seslogin.php";

//Periksa ada atua tidak variabel Kode pada URL (alamat Browser)
if (isset ($_GET ['Kode'])) {
//Hapus data sesuai Kode yang didapat di URL
$mySql = "DELETE FROM Tindakan
			WHERE kd_tindakan = '".$_GET['Kode']."'";
$myQry = mysql_query ($mySql, $koneksidb)
		or die ("Eror hapus data".mysql_error());
if ($myQry) { 
//Refresh Halaman
echo "<meta http-equiv='refresh' content='0; url=?page=Tindakan-Data'>";
	}
}
else {
//Jika tidak ada kode ditemukan di URL
echo "<b> Data yang dihapus tidak ada</b>";
}
?>