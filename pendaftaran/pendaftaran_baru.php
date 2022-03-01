<?php 
include_once "../library/inc.seslogin.php";

# Fungsi membuat nomor antrian
function nomorAntrian($tanggal) {
	//$tanggal dalam format Y-m-d
	$antriKe= 0;
	$mySql	= "SELECT count(*) as jum_antri FROM pendaftaran WHERE tgl_janji='$tanggal' ORDER BY nomor_antri";
	$myQry 	= mysql_query($mySql) or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	if(mysql_num_rows($myQry) >=1) {
		$antriKe	= $myData['jum_antri'] + 1;
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
			if (trim($_POST['txtTglJanji'])=="") {
		$pesanError[] = "Data <b>Tgl. Janji</b> tidak boleh kosong, silahkan pilih pada kalender !";			
	}
		if (trim ($_POST ['txtJamJanji'])=="") {
				$pesanError [] = "Data <b> Jam Janji </b> tidak boleh kosong, isi dengan format 00:00:00!";
		}
		if (trim ($_POST ['txtKeluhan']) == "") {
				$pesanError [] = "Data <b> Keluhan Pasien </b> tidak boleh kosong, silahkan dilengkapi!";
		}
		if (trim ($_POST ['cmbTindakan'])== "KOSONG") {
				$pesanError [] = "Data <b> Tindakan </b> tidak boleh kosong, silahkan dilengkapi!";
				}
		
		#Baca Variabel Form
		$txtNomorRM = $_POST ['txtNomorRM'];
		$txtTglDaftar = InggrisTgl ($_POST ['txtTglDaftar']);
	$txtTglJanji	= InggrisTgl($_POST['txtTglJanji']);
		$txtJamJanji = $_POST ['txtJamJanji'];
		$txtKeluhan = $_POST ['txtKeluhan'];
		$cmbTindakan = $_POST ['cmbTindakan'];
		
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
			$kodeBaru = buatKode ("pendaftaran", "");
			$mySql = "INSERT INTO pendaftaran (no_daftar, nomor_rm, tgl_daftar, tgl_janji, jam_janji, keluhan, kd_tindakan,
			nomor_antri, kd_petugas)
			VALUES ('$kodeBaru', '$txtNomorRM', '$txtTglDaftar', '$txtTglJanji', '$txtJamJanji', '$txtKeluhan', '$cmbTindakan', '$nomorAntri', '$userLogin')";
			$myQry = mysql_query ($mySql, $koneksidb)
					or die ("Gagal query".mysql_error());
			if ($myQry) {
			echo "<meta http-equiv='refresh'' content=0; url=?page=Pendaftaran-Baru'>";
			}
			exit; 
			}
			}//Membaca Nomor RM data Pasien
			$NomorRM = isset ($_GET ['NomorRM']) ? $_GET ['NomorRM'] : '';
			$mySql = "SELECT nomor_rm, nm_pasien FROM pasien WHERE nomor_rm= '$NomorRM'"; 
			$myQry = mysql_query ($mySql, $koneksidb) or die ("Query salah: ".mysql_error());
			$myData = mysql_fetch_array ($myQry);
			$dataPasien = $myData ['nm_pasien'];
			#kode Pasien
			if ($NomorRM=="") {
			$NomorRM = isset ($_POST ['txtNomorRM']) ? $_POST ['txtNomorRM'] : '';
			}
			
			#Nilai Pda From Input
			$dataKode = buatKode ("pendaftaran", "");
			$dataTglDaftar = isset ($_POST ['txtTglDaftar']) ? $_POST['txtTglDaftar'] : date ('d-m-Y');
			$dataTglJanji = isset ($_POST ['txtTglJanji']) ? $_POST ['txtTglJanji'] : date ('d-m-Y') ;

			$dataKeluhan = isset ($_POST ['txtKeluhan']) ? $_POST ['txtKeluhan'] : '';
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
      <th bgcolor="#CCCCCC"colspan="3" scope="col"><span class="style2">PENDAFTARAN PASIEN </span></th>
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
        <span class="style1">*pilih dari <a href="?page=Pencarian-Pasien">Daftar Pasien</a>, lalu klik menu <strong>Daftar</strong> </span></label></td>
    </tr>
    <tr>
      <td>Nama Pasien </td>
      <td>:</td>
      <td><label>
        <input name="txtPasien" type="text" id="txtPasien" value="<?php echo $dataPasien;?>" size="80" maxlength="100">
      </label></td>
    </tr>
    <tr>
      <td>Tgl. Daftar </td>
      <td>:</td>
      <td><label>
        <input name="txtTglDaftar" type="text" class="tcal" id="txtTglDaftar" value="<?php echo $dataTglDaftar;?>" size="23">
      </label></td>
    </tr>
    <tr>
      <td>Tgl. &amp; Jam Janji </td>
      <td>:</td>
      <td><label>
        <input name="txtTglJanji" type="text" class="tcal" id="txtTglJanji" value="<?php echo $dataTglJanji;?>" size="23">
      / 
      <input name="txtJamJanji" type="text" id="txtJamJanji" size="10" maxlength="8">
      <strong>ex </strong>: 12:30</label></td>
    </tr>
    <tr>
      <td>Keluhan Pasien </td>
      <td>:</td>
      <td><label>
        <input name="txtKeluhan" type="text" id="txtKeluhan" value="<?php echo $dataKeluhan;?>" size="80" maxlength="100">
      </label></td>
    </tr>
    <tr>
      <td>Tindakan Pasien </td>
      <td>:</td>
      <td><label>
        <select name="cmbTindakan" id="cmbTindakan">
		<option value="KOSONG">.....</option>
		  <?php
	  $dataSql = "SELECT * FROM tindakan ORDER BY kd_tindakan";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kd_tindakan'] == $dataTindakan) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kd_tindakan]' $cek>[ $dataRow[kd_tindakan] ]  $dataRow[nm_tindakan]</option>";
		}
		?>
		</select>
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
