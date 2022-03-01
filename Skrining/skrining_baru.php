<?php 
include_once "../library/inc.seslogin.php";

# Fungsi membuat nomor antrian
function nomorAntrian($tanggal) {
	//$tanggal dalam format Y-m-d
	$antriKe= 0;
	$mySql	= "SELECT count(*) as jum_skrining FROM skrining_baru WHERE tgl_janji='$tanggal' ORDER BY nomor_antri";
	$myQry 	= mysql_query($mySql) or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	if(mysql_num_rows($myQry) >=1) {
		$antriKe	= $myData['jum_skrining'] + 1;
	}
	else {
		$antriKe	= 1;
	}
	
	return $antriKe;
}

#Tombol Simpan diklik
if (isset ($_POST ['btnSimpan'])) {
		//Skrip program disini
		$pesanError = array ();
		if (trim ($_POST ['txtNomorRM']) == "") {
				$pesanError [] = "Data <b> Nomor RM (Rekam Medik) </b> tidak boleh kosong!";
		}
		if (trim ($_POST ['txtTglDaftar']) == "") {
				$pesanError [] = "Data <b> Tgl.Daftar </b> tidak boleh kosong, silahkan pilih pada kalender!";
		}
		if (trim ($_POST ['txtHasil']) == "") {
				$pesanError [] = "Data <b> Keluhan Pasien </b> tidak boleh kosong, silahkan dilengkapi!";
		}
				
		#Baca Variabel Form
		$txtNomorRM = $_POST ['txtNomorRM'];
		$txtTglDaftar = InggrisTgl ($_POST ['txtTglDaftar']);
		$txtTglJanji = InggrisTgl($_POST['txtTglJanji']);
		$txtHasil = $_POST ['txtHasil'];
	
		
		#menampilkan pesan error
		if (count ($pesanError)>=1 ) {
			echo "<div class='mssgBox'>";
			echo "<img src='../images/attention.png'> <br> <hr>";
					$noPesan=0;
					foreach ($pesanError as $indeks=> $pesan_tampil){
					$noPesan++;
			echo "&nbsp; $noPesan. $pesan_tampil <br>";
			}
			echo "</div> <br>";
			}
			else {
			#SKRIP Simpan data Ke database 
			$userLogin = $_SESSION ['SES_LOGIN'];
			$nomorAntri = nomorAntrian ($txtTglJanji);
			$kodeBaru = buatKode ("skrining_baru", "");
			$mySql = "INSERT INTO skrining_baru (no_sk, nomor_rm, tgl_daftar, tgl_janji, hasil, nomor_antri, status)
			VALUES ('$kodeBaru', '$txtNomorRM', '$txtTglDaftar', '$txtTglJanji', '$txtHasil', '$nomorAntri', '$userLogin')";
			$myQry = mysql_query ($mySql, $koneksidb)
					or die ("Gagal query".mysql_error());
			if ($myQry) {
			echo "<meta http-equiv='refresh'' content=0; url=?page=Skrining-Baru'>";
			}
			exit; 
			}
			}//Membaca Nomor RM data Pasien
			$NomorRM = isset ($_GET ['NomorRM']) ? $_GET ['NomorRM'] : '';
			$mySql = "SELECT nomor_rm, nm_pasien, no_telepon FROM pasien WHERE nomor_rm= '$NomorRM'"; 
			$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah: ".mysql_error());
			$myData = mysql_fetch_array ($myQry);
			$dataPasien = $myData ['nm_pasien'];
			$dataTelepon = $myData ['no_telepon'];
			#kode Pasien
			if ($NomorRM=="") {
			$NomorRM = isset ($_POST ['txtNomorRM']) ? $_POST ['txtNomorRM'] : '';
			}
			
			#Nilai Pda From Input
			$dataKode = buatKode ("skrining_baru", "SK");
			$dataTglDaftar = isset ($_POST ['txtTglDaftar']) ? $_POST['txtTglDaftar'] : date ('d-m-Y');
			$dataTglJanji = isset ($_POST ['txtTglJanji']) ? $_POST ['txtTglJanji'] : date ('d-m-Y') ;
					$dataHasil = isset ($_POST ['txtHasil']) ? $_POST ['txtHasil'] : '';
			$dataTindakan = isset ($_POST ['cmbTindakan']) ? $_POST ['cmbTindakan'] : '';
			
			?>
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style2 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>


<form action="<?php $_SERVER ['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <th bgcolor="#CCCCCC"colspan="3" scope="col"><span class="style2">SKRINING PASIEN </span></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="168">Kode</td>
      <td width="8">:</td>
      <td width="502"><label>
        <input name="textfield" type="text" value="<?php echo $dataKode;?>" size="10" readonly="readonly" maxlength="10">
      </label></td>
    </tr>
    <tr>
      <td>Nomor RM </td>
      <td>:</td>
      <td><label>
        <input name="txtNomorRM" type="text" id="txtNomorRM" value="<?php echo $NomorRM;?>" size="20" maxlength="20">
        <span class="style1">*pilih dari <a href="?page=Cari-Pasien">Daftar Pasien</a>, lalu klik menu <strong>Daftar</strong> </span></label></td>
    </tr>
    <tr>
      <td>Nama Pasien </td>
      <td>:</td>
      <td><label>
        <input name="txtPasien" type="text" id="txtPasien" value="<?php echo $dataPasien;?>" size="80" maxlength="100">
      </label></td>
    </tr>
    <tr>
      <td>No. HP </td>
      <td>&nbsp;</td>
      <td><label>
        <input name="textfield2" type="text" value="<?php echo $dataTelepon;?>" />
      </label></td>
    </tr>
    <tr>
      <td>Tgl. Skrining Lanjut </td>
      <td>:</td>
      <td><label>
        <input name="txtTglDaftar" type="text" class="tcal" id="txtTglDaftar" value="<?php echo $dataTglDaftar;?>" size="23">
      </label></td>
    </tr>
   <tr>
      <td>Hasil  Pasien </td>
      <td>:</td>
      <td><label>
        <input name="txtHasil" type="text" id="txtHasil" value="<?php echo $dataHasil;?>" size="80" maxlength="100">
      </label></td>
    </tr>
       <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input name="btnSimpan" type="submit" id="btnSimpan" value="SIMPAN">
      </label></td>
    </tr>
  </table>
</form>
