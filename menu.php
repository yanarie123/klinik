<?php
if(isset($_SESSION['SES_ADMIN'])){
# JIKA YANG LOGIN LEVEL ADMIN, menu di bawah yang dijalankan
?>
<style type="text/css">
<!--
.style2 {color: #003366}
.style3 {color: #606060}
.style4 {color: #000080}
-->
</style>

<ul>
	<li><span class="style3"><span class="style4"><span class="style4"><a href='?page' title='Halaman Utama'>Home</a></span></span></span></li>
	<li class="style4"><a href="?page=Tindakan-Data" font-color="#CCCCCC">Data Tindakan</a></li>
	<li class="style4"><a href='?page=Petugas-Data' title='Petugas'>Data Petugas</a></li>
	<li class="style4"><a href='?page=Dokter-Data' title='Dokter' target="_self">Data Dokter</a></li>
	<li class="style4"><a href='?page=Obat-Data' title='Obat' target="_self">Data Obat</a></li>
	<li class="style4"><a href='?page=Pasien-Data' title='Pasien' target="_self">Data Pasien</a> </li>
<!-- 	<li class="style4"><a href='pendaftaran/' title='Pendaftaran Pasien' target='_self'>Pendaftaran Pasien</a> </li> -->
	<li class="style4"><a href='skrining/' title='Skrining Pasien' target='_self'>Skrining</a> </li>
	<li class="style4"><a href='rawat-pasien/' title='Rawat Pasien' target='_self'>Rawat Pasien</a> </li>
	<li class="style4"><a href='penjualan/' title='Penjualan Apotek' target='_self'>Penjualan Apotek</a> </li>
		<li class="style4"><a href='?page=Prolanis-Data' title='Prolanis' target='_self'>Prolanis</a> </li>
	<li class="style4"><a href='?page=Laporan' title='Laporan'>Laporan</a></li>
	<li class="style2"><span class="style4"><a href='?page=Logout' title='Logout (Exit)'>Logout</a></span></li>
</ul>
<span class="style2">
<?php
}
elseif(isset($_SESSION['SES_PETUGAS'])){
# JIKA YANG LOGIN LEVEL PETUGAS JAGA KLINIK, menu di bawah yang dijalankan
?>
</span>
<ul class="style2">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li class="style4"><a href='?page=Pasien-Data' title='Pasien' target="_self">Data Pasien</a> </li>
<!-- 	<li><a href='pendaftaran/' title='Pendaftaran Pasien' target='_self'>Pendaftaran Pasien</a> </li> -->
	<li><a href='rawat-pasien/' title='Rawat Pasien' target='_self'>Rawat Pasien</a> </li>
	<li class="style4"><a href='?page=Laporan' title='Laporan'>Laporan</a></li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>
<span class="style2">
<?php
}
elseif(isset($_SESSION['SES_APOTEK'])){
# JIKA YANG LOGIN LEVEL KASIR APOTEK, menu di bawah yang dijalankan
?>
</span>
<ul class="style2">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li class="style4"><a href='?page=Obat-Data' title='Obat' target="_self">Data Obat</a></li>
	<li><a href='penjualan/' title='Penjualan Apotek' target='_self'>Penjualan Apotek</a> </li>
	<li class="style4"><a href='?page=Laporan' title='Laporan'>Laporan</a></li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>
<span class="style2">
<?php
}
elseif(isset($_SESSION['SES_DOKTER'])){
# JIKA YANG LOGIN LEVEL PETUGAS JAGA KLINIK, menu di bawah yang dijalankan
?>
</span>
<ul class="style2">
	<li><a href='?page' title='Halaman Utama'>Home</a></li>
	<li class="style4"><a href='?page=Obat-Dokter' title='Obat' target="_self">Data Obat</a></li>
	<li><a href='rawat-pasien/' title='Rawat Pasien' target='_self'>Rawat Pasien</a> </li>
	<li><a href='?page=Logout' title='Logout (Exit)'>Logout</a></li>
</ul>
<span class="style2">

<?php
}
else {
# JIKA BELUM LOGIN (BELUM ADA SESION LEVEL YG DIBACA)
?>
</span>
<ul class="style2">
	<li><a href='?page=Login' title='Login System'>Login</a></li>	
</ul>
<span class="style2">
<?php
}
?>
</span>