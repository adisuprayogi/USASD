<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '25'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$tahun2 = isset($_GET['tahun2']) ? $_GET['tahun2'] : '';
$cari1 = isset($_POST['cari1']) ? htmlspecialchars($_POST['cari1'],ENT_QUOTES) : '';
$cari2 = isset($_POST['cari2']) ? htmlspecialchars($_POST['cari2'],ENT_QUOTES) : '';
$mkk = isset($_POST['mkk']) ? htmlspecialchars($_POST['mkk'],ENT_QUOTES) : '';
	
	
if (($cari1)=='') {
	if (($tahun2)==''){
	$tanda= $tahun;
	}else{
	$tanda=$tahun2;
	}
}else{
$tanda= $cari1;
}


switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':

break;



///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3 align='center'>.: List Exam Schedule Of ".get_data_user('nama')." :.</h3>";

//if($status == '11') echo "<div class='sukses'>Simpan Data Berhasil</div>";
//elseif($status == '10') echo "<div class='gagal'>Simpan Data Gagal</div>";
//elseif($status == '21') echo "<div class='sukses'>Ubah Data Berhasil</div>";
//elseif($status == '20') echo "<div class='gagal'>Ubah Data Gagal</div>";
//elseif($status == '31') echo "<div class='sukses'>Hapus Data Berhasil</div>";
//elseif($status == '30') echo "<div class='gagal'>Hapus Data Gagal</div>";

echo "

<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>Exam No</th>
		<th class='data'>Code</th>
		<th class='data'>courses</th>
		<th class='data'>Date Of Exam</th>
		<th class='data'>Start From</th>
		<th class='data'>Finish</th>
		<th class='data'>Score</th>
		<th class='data' >Option</th>
	</tr>";
	$mhsid=$_SESSION['user_name'];
	$r=mysql_query("SELECT id_ujian,b.id_jujian,a.krsid,b.mkkode,b.nama,c.nama as namu,b.tgl_ujian,jam_mulai,jam_selesai,a.st,coalesce(NilaiT,'-') as Nilai FROM
(SELECT * FROM master_ujian WHERE mhswid='$mhsid' AND STATUS='A' and utsuas='A')a LEFT JOIN
(SELECT * FROM jadwal_ujian WHERE utsuas='A' AND STATUS in ('N','F'))b ON a.id_jujian=b.id_jujian LEFT JOIN
(SELECT * FROM mk WHERE na='N')c ON b.mkkode=c.mkkode GROUP BY b.mkkode order by b.tgl_ujian,b.jam_mulai");
	$no = 1;
	while($d=mysql_fetch_array($r)){
	$tgls=format_tgl(($d['tgl_ujian']),'dd-mmmm-yyyy');
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[id_jujian]</td>
			<td class='data' align='center'>$d[mkkode]</td>
			<td class='data'>$d[namu]</td>
			<td class='data' align='center'>$tgls</td>
			<td class='data' align='center'>$d[jam_mulai]</td>
			<td class='data' align='center'>$d[jam_selesai]</td>
			<td class='data' align='center'>$d[Nilai]</td>
			

			<td class='data' width='75px'>
			<center>";
			if (($d['st'])=="A"){
			echo"
			<a href='index.php?m=kerjasoal&id=$d[id_ujian]&idj=$d[id_jujian]&ur=1' title='Start Exam'><img src='css/img/start.png'></a>";
			}else{
				echo"
			<a href='index.php?m=$menu' title='Tidak Aktif'><img src='css/img/Fin.png'></a>";
			}
			echo"
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>
";
break;

///////////////////////////////////////////// edit ///////////////////////////////////////////
case 'edit':
	
break;

case 'proses';
	
break;

}

}
else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>