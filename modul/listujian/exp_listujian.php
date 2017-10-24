<?php
include '../../include/connection.php';
include '../../include/function.php';

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=TestResult-export.xls");
 
// Tambahkan table
?>

<?php	
$id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
	echo "<h3 align='center'>List Of Test Result</h3>
	<br>
	
	<div class='clear'></div>
<table border='1'>
	<tr>
		<th width='30px'>No</th>
		<th>Code</th>
		<th>Student ID</th>
		<th>Name</th>
		<th>Course Code</th>
		<th>Result</th>
		<th>Status</th>
	</tr>";
	
	//$insert=mysql_query("update jadwal_ujian set status='S' where id_jujian='$id'");
	
	$ro=mysql_query("SELECT a.nilai,coalesce(a.NilaiT,'-')as NilaiT,a.id_ujian as id_ujian,a.krsid,a.id_jujian as id_jujian,b.cmb_kd as mhswid,b.cmb_nama as Nama,a.st,c.mkkode as mkkode,c.Nama as makul FROM
(SELECT * FROM master_ujian WHERE STATUS='N' AND id_jujian='$id')a LEFT JOIN
(SELECT * FROM tbl_cmb)b ON a.mhswid=b.cmb_kd left join 
(select * FROM Jadwal_ujian)c on a.id_jujian=c.id_jujian ORDER BY a.mhswid");
	$no = 1;
	while($de=mysql_fetch_array($ro)){
	$nilai = $de['NilaiT'];
	$nilai_dep = substr($nilai,0,2);
	$nilai_bel = substr($nilai,3,1);
	$nil=$nilai_dep .','. $nilai_bel;
		echo"	
		<tr>
			<td width='30px' align='right'>$no</td>
			<td align='center'>$de[krsid]</td>
			<td align='center'>$de[mhswid]</td>
			<td>$de[Nama]</td>
			<td align='center'>$de[mkkode]</td>";
			if ($nil=='-,'){
			echo"
			<td align='center'>-</td>";
			}else{
			echo"
			<td align='center'>$nil</td>";
			}
			if (($de['NilaiT'])=='-'){
			echo"
			<td align='center'>Tidak Ujian</td>";
			}
			elseif (($de['NilaiT'])<'70'){
			echo"
			<td align='center'>Tidak Lulus</td>";
			$lls="Tidak Lulus";
			}else{
			if(($de['NilaiT'])<'80'){
			echo"
			<td align='center'><font color='#0000ff'>B</td>";
			$lls="B";
			}else{
			echo"
			<td align='center'><font color='#ff0000'>A</td>";
			$lls="A";
			}
	}
			//echo"
			//<td class='data' align='center'>$lls</td>
echo"
			
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>
";

?>