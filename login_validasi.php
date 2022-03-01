<?php
if (isset ($_POST ['btnLogin'])) {
	$pesanError = array () ;
	if (trim ($_POST ['txtUser'])=="") {
			$pesanError[] = "Data <b> Username </b> tidak boleh kosong!";
	}
	if (trim ($_POST [ 'txtPassword'])=="") {
			$pesanError[] = "Data <b> Password </b> tidak boleh kosong!";
	}
	// if (trim($_POST [ 'cmbLevel'])=="KOSONG") {
	// 		$pesanError[] = "Data <b> Level </b> belum dipilih !";
	// }
	#Baca Variabel Form
	$txtUser  = $_POST ['txtUser'];
	$txtUser = str_replace ("'", "&acute;",$txtUser);
	$txtPassword =$_POST ['txtPassword'];
	$txtPassword= str_replace ("'", "&acute;",$txtPassword);
	// $cmbLevel = $_POST ['cmbLevel'];
	#JIKA ANDA PESAN ERROR DARI VALIDASI
	if (count ($pesanError)>=1) {
		echo "(div class=',mssgbBox'>";
		echo "<img src='images/attention.png'><br><hr>";
				$noPesan=0;
				foreach ($pesanError as $indeks=> $pesan_tampil) {
				$noPesan++;
		echo "&nbsp;&nbsp; $noPesan. $pesan_tampil </br>";
				}
		echo "</div> <br>";
		//Tampilkan lagi form login 
		include "login.php";
	}
	else {
	#LOGIN CEK TABEL USER LOGIN
		$mySql = "SELECT * FROM petugas WHERE username='".$txtUser."' AND password='".md5($txtPassword)."'";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Query Salah : ".mysql_error());
		$myData= mysql_fetch_array($myQry);
		
			#JIKA LOGIN SUKSES
			if (mysql_num_rows ($myQry) >=1) {
					$_SESSION ['SES_LOGIN'] = $myData ['kd_petugas'];
					$_SESSION ['SES_USER'] = $myData ['username'];
					
					//Jika yang login Administrator 
					if ($myData['level']=="Admin") {
							$_SESSION ['SES_ADMIN'] = "Admin";
					}
					
					//Jika yang login petugas
					if ($myData['level']=="Klinik") {
							$_SESSION ['SES_PETUGAS'] = "Klinik";
					}
					
					// Jika yang login Apotek
					if($myData['level']=="Apotek") {
						$_SESSION['SES_APOTEK'] = "Apotek";
					}
					// Jika yang login Apotek
					if($myData['level']=="Dokter") {
						$_SESSION['SES_DOKTER'] = "Dokter";
					}
						//Refresh
						echo "<meta http-equiv='refresh' content = '0; url=?page=Halaman-Utama'>";
					}else {
					// echo "Login Anda Bukan $mySql ".$_POST ['cmbLevel'];
					echo "Login Error!";
					}
				}
			} // End POST
	?>