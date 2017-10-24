<?php
//include_once '../connectdb.php';
//include_once '../function.php';
include_once "../dwo.lib.php";
include_once "../db.mysql.php";
include_once "../connectdb.php";
include_once "../parameter.php";
include_once "../cekparam.php";

$krs = isset($_GET['m']) ? htmlentities($_GET['m'],ENT_QUOTES) : '';
$jadwal = isset($_GET['s']) ? htmlentities($_GET['s'],ENT_QUOTES) : '';
$mhsw = isset($_GET['p']) ? htmlentities($_GET['p'],ENT_QUOTES) : '';
$makul = isset($_GET['o']) ? htmlentities($_GET['o'],ENT_QUOTES) : '';

?>
<link rel="stylesheet" type="text/css" href="../themes/tazkia/index.css" />
 <link rel="stylesheet" type="text/css" href="../themes/tazkia/ddcolortabs.css" />
<?php
echo "<br>";
echo "<h3 align='center'>.: Detail Absensi:.</h3>";
echo "
 </form>
<div class='clear'></div>
<table>
<tr><td>Nama</td><td>:</td><td>$mhsw</td></tr>
<tr><td>Mata Kuliah</td><td>:</td><td>$makul</td></tr>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>";
		echo "<th class='data'>Tanggal</th>";
		echo "<th class='data'>Keterangan</th>";
		echo "<th class='data'>Materi</th>";
		echo "
	</tr>";
	
	
	//$r=mysql_query("select * from presensimhsw where KRSID=$krs and JadwalID=$jadwal");
	$r=mysql_query("SELECT b.tanggal,a.JenisPresensiID,b.Catatan FROM
(SELECT * FROM presensimhsw WHERE NA='N' and krsid=$krs AND jadwalID=$jadwal)a inner JOIN
(SELECT * FROM presensi)b ON a.PresensiID=b.PresensiID order by b.tanggal");
	
	$no = $lim+1;
	while($d=mysql_fetch_array($r)){
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			";
			echo "<td class='data'>$d[tanggal]</td>";
			if (($d[JenisPresensiID])=='M'){
			echo "<td class='data' align='center'>Absen</td>";
			}else{
			echo "<td class='data' align='center'>Hadir</td>";
			}
			echo "<td class='data'>$d[Catatan]</td>";
			echo "
		</tr>";
		$no++;
	}
	
	echo "	
</table>

";
echo "<table width=100%>";
echo "<tr><td align='center'>";
echo"</td></tr>";
echo"</table>";
?>
