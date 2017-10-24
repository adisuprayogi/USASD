<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'jadwal';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':

	//$tahun = isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun'],ENT_QUOTES) : '';
	$judul = isset($_POST['judul']) ? htmlspecialchars($_POST['judul'],ENT_QUOTES) : '';
	//$kelas = isset($_POST['kelas']) ? htmlspecialchars($_POST['kelas'],ENT_QUOTES) : '';
	$noujian = isset($_POST['noujian']) ? htmlspecialchars($_POST['noujian'],ENT_QUOTES) : '';
	$tgl_ujian = isset($_POST['tgl_ujian']) ? htmlspecialchars($_POST['tgl_ujian'],ENT_QUOTES) : '';
	$tgl_ujian = format_tgl($tgl_ujian,'yyyy-mm-dd');
	$pengawas = isset($_POST['pengawas']) ? htmlspecialchars($_POST['pengawas'],ENT_QUOTES) : '';
	$jk = isset($_POST['jk']) ? htmlspecialchars($_POST['jk'],ENT_QUOTES) : '';
	$mk = isset($_POST['mk']) ? htmlspecialchars($_POST['mk'],ENT_QUOTES) : '';
	$ruang = isset($_POST['ruang']) ? htmlspecialchars($_POST['ruang'],ENT_QUOTES) : '';
	$jammulai = isset($_POST['jammulai']) ? htmlspecialchars($_POST['jammulai'],ENT_QUOTES) : '';
	$jamselesai = isset($_POST['jamselesai']) ? htmlspecialchars($_POST['jamselesai'],ENT_QUOTES) : '';
	$jsoal = isset($_POST['jsoal']) ? htmlspecialchars($_POST['jsoal'],ENT_QUOTES) : '';
	$b1 = isset($_POST['b1']) ? htmlspecialchars($_POST['b1'],ENT_QUOTES) : '0';
	$b2 = isset($_POST['b2']) ? htmlspecialchars($_POST['b2'],ENT_QUOTES) : '0';
	$b3 = isset($_POST['b3']) ? htmlspecialchars($_POST['b3'],ENT_QUOTES) : '0';
	$b4 = isset($_POST['b4']) ? htmlspecialchars($_POST['b4'],ENT_QUOTES) : '0';
	$b5 = isset($_POST['b5']) ? htmlspecialchars($_POST['b5'],ENT_QUOTES) : '0';
	
	$mat = isset($_POST['mat']) ? htmlspecialchars($_POST['mat'],ENT_QUOTES) : '35';
	$eng = isset($_POST['eng']) ? htmlspecialchars($_POST['eng'],ENT_QUOTES) : '35';
	$pai = isset($_POST['pai']) ? htmlspecialchars($_POST['pai'],ENT_QUOTES) : '20';
	$pmu = isset($_POST['pmu']) ? htmlspecialchars($_POST['pmu'],ENT_QUOTES) : '10';
	
	$jum=$b1+$b2+$b3+$b4+$b5;
	
	if(empty($judul) || empty($mk) || empty($tgl_ujian) || empty($pengawas)){
		echo "<script>alert('data tidak lengkap');window.history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO jadwal_ujian(mkkode,mkid,nama,no_ujian,tgl_ujian,pengawas,uname,password,utsuas,kelasid,ruangid,jam_mulai,jam_selesai,status,tahunid,jsoal,b1,b2,b3,b4,b5,mat,eng,pai,pmu) VALUES('SASD','0','$judul','$noujian','$tgl_ujian','$pengawas','-','-','P','-','$ruang','$jammulai','$jamselesai','N','-','$jum','$b1','$b2','$b3','$b4','$b5','$mat','$eng','$pai','$pmu')");
		
		//$insert2=mysql_query("INSERT INTO master_ujian (mhswid,krsid,id_jujian,PASSWORD,STATUS,utsuas)
//SELECT b.mhswid AS mhid,b.krsid AS krs,id_jujian AS idj,b.krsid AS pass,'A' AS stat,'$jk' as utsuas FROM
//(SELECT * FROM jadwal WHERE tahunid='$tahun' AND mkkode='$mk' AND NamaKElas='$kelas')a INNER JOIN
//(SELECT * FROM krs WHERE tahunid='$tahun')b ON a.jadwalid=b.jadwalid INNER JOIN
//(SELECT * FROM jadwal_ujian WHERE tahunid='$tahun' AND mkkode='$mk' AND kelasid='$kelas')c ON a.mkkode=c.mkkode AND a.NamaKelas=c.kelasid");
		
		if($insert){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status&kd=$mk'/>";
	}
break;

/////////////////////////// kode update //////////////////
case 'update':

	$id = isset($_POST['id']) ? htmlspecialchars($_POST['id'],ENT_QUOTES) : '';
	$judul = isset($_POST['judul']) ? htmlspecialchars($_POST['judul'],ENT_QUOTES) : '';
	$noujian = isset($_POST['noujian']) ? htmlspecialchars($_POST['noujian'],ENT_QUOTES) : '';
	$tgl_ujian = isset($_POST['tgl_ujian']) ? htmlspecialchars($_POST['tgl_ujian'],ENT_QUOTES) : '';
	$tgl_ujian = format_tgl($tgl_ujian,'yyyy-mm-dd');
	$pengawas = isset($_POST['pengawas']) ? htmlspecialchars($_POST['pengawas'],ENT_QUOTES) : '';
	$jk = isset($_POST['jk']) ? htmlspecialchars($_POST['jk'],ENT_QUOTES) : '';
	$mk = isset($_POST['mk']) ? htmlspecialchars($_POST['mk'],ENT_QUOTES) : '';
	$ruang = isset($_POST['ruang']) ? htmlspecialchars($_POST['ruang'],ENT_QUOTES) : '';
	$jammulai = isset($_POST['jammulai']) ? htmlspecialchars($_POST['jammulai'],ENT_QUOTES) : '';
	$jamselesai = isset($_POST['jamselesai']) ? htmlspecialchars($_POST['jamselesai'],ENT_QUOTES) : '';
	$jsoal = isset($_POST['jsoal']) ? htmlspecialchars($_POST['jsoal'],ENT_QUOTES) : '';
	$b1 = isset($_POST['b1']) ? htmlspecialchars($_POST['b1'],ENT_QUOTES) : '0';
	$b2 = isset($_POST['b2']) ? htmlspecialchars($_POST['b2'],ENT_QUOTES) : '0';
	$b3 = isset($_POST['b3']) ? htmlspecialchars($_POST['b3'],ENT_QUOTES) : '0';
	$b4 = isset($_POST['b4']) ? htmlspecialchars($_POST['b4'],ENT_QUOTES) : '0';
	$b5 = isset($_POST['b5']) ? htmlspecialchars($_POST['b5'],ENT_QUOTES) : '0';
	
	$mat = isset($_POST['mat']) ? htmlspecialchars($_POST['mat'],ENT_QUOTES) : '35';
	$eng = isset($_POST['eng']) ? htmlspecialchars($_POST['eng'],ENT_QUOTES) : '35';
	$pai = isset($_POST['pai']) ? htmlspecialchars($_POST['pai'],ENT_QUOTES) : '20';
	$pmu = isset($_POST['pmu']) ? htmlspecialchars($_POST['pmu'],ENT_QUOTES) : '10';
	
	$jum=$b1+$b2+$b3+$b4+$b5;
	
	if(empty($judul) || empty($mk) || empty($tgl_ujian) || empty($pengawas)){
		echo "<script>alert('data tidak lengkap');window.history.back();</script>";
	}
	else{
		$update=mysql_query("update jadwal_ujian set mkkode='SASD',mkid='0',nama='$judul',no_ujian='$noujian',tgl_ujian='$tgl_ujian',pengawas='$pengawas',utsuas='P',kelasid='-',ruangid='$ruang',jam_mulai='$jammulai',jam_selesai='$jamselesai',tahunid='-',jsoal='$jum',b1='$b1',b2='$b2',b3='$b3',b4='$b4',b5='$b5',mat='$mat',eng='$eng',pai='$pai',pmu='$pmu' where id_jujian='$id'");
		if($update){
			$status = '21';
		}
		else{
			$status = '20';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status&kd=$mk'/>";
	}
break;

/////////////////////////// kode hapus //////////////////
case 'hapus':
	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$tahun = isset($_GET['tahun']) ? htmlspecialchars($_GET['tahun'],ENT_QUOTES) : '';
	$delete=mysql_query("update jadwal_ujian set status='D' WHERE id_jujian = '$id'");
	
	if($delete){
		$status = '31';
	}
	else{
		$status = '30';
	}
	echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status&tahun=$tahun'/>";
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>