<?php 
echo "<div id='leftBar'><ul>";

if($_SESSION['user_level_kd'] == '1'){ //data karyawan
	echo "<li><a href='index.php?m=inputpegawai'>Input Data Pegawai</a></li>";
	echo "<li><a href='index.php?m=inputkeluarga'>Input Data Keluarga</a></li>";
	echo "<li><a href='index.php?m=inputjabatan'>Riwayat Jabatan</a></li>";
	//echo "<li><a href='index.php?m=pendaftarancmb'>Riwayat Pendidikan-> Fixed</a></li>";
	//echo "<li><a href='index.php?m=pendaftarancmb&s=listtemp'>Data CMB -> Temp</a></li>";
	//echo "<li><a href='index.php?m=laporancmbdaftar&s=listtemp'>Lap. CMB Daftar</a></li>";
	echo "<li><a href='index.php?m=inputpendidikan'>Riwayat Pendidikan</a></li>";
	echo "<li><a href='index.php?m=soal'>Input Database soal</a></li>";
	echo "<li><a href='index.php?m=kerjasoal'>Ujian</a></li>";
	
}	
else{
		
}
echo "</ul></div>";

?>