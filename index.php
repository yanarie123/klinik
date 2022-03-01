<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
include_once "library/inc.pilihan.php";
include_once "library/inc.tanggal.php";

// Baca Jam pada Komputer
date_default_timezone_set("Asia/Jakarta");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title> Sistem Informasi Klinik Dokter & Apotek </title>
  <link rel=”icon” href=”images/icon.ico”>
  <link href="styles/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="plugins/tigra_calendar/tcal.css"/>
  <script type="text/javascript" src="plugins/tigra_calendar/tcal.js"></script> 
</head>
<div id="wrap">
<body>
<table width="100%" class="table-main">
  <tr>
    <td height="103" colspan="2" align="center"><a href="?page"><div id="header"></div>
    </a></td>
  </tr>
  <tr valign="top">
    <td width="15%"  style="border-right:5px solid #DDDDDD;"><div style="margin:5px; padding:5px;"><?php include "menu.php"; ?></div></td>
    <td width="69%" height="550"><div style="margin:5px; padding:5px;"><?php include "buka_file.php";?></div></td>
  </tr>
</table>
</body>
</div>
</html>
