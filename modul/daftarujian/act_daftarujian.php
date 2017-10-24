<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'daftarujian';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'aktif':

	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$idj = isset($_GET['idj']) ? htmlspecialchars($_GET['idj'],ENT_QUOTES) : '';
	$mh = isset($_GET['mh']) ? htmlspecialchars($_GET['mh'],ENT_QUOTES) : '';
	$krs = isset($_GET['k']) ? htmlspecialchars($_GET['k'],ENT_QUOTES) : '';
	
	
	if(empty($id) || empty($idj) || empty($mh)){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$insert=mysql_query("update master_ujian set st='A' where id_ujian='$id'");
		
		$r=mysql_query("SELECT * FROM Jadwal_ujian where id_jujian='$idj'");
	while($d=mysql_fetch_array($r)){
	$mkkode=$d['mkkode'];
	$b1=$d['b1'];
	$b2=$d['b2'];
	$b3=$d['b3'];
	$b4=$d['b4'];
	$b5=$d['b5'];
	}
	
		$ra=mysql_query("
		SELECT id_soal FROM(
		(SELECT * FROM soal WHERE mkkode='$mkkode' AND utsuas='A' AND bobot='1' ORDER BY RAND() LIMIT $b1)
		UNION
		(SELECT * FROM soal WHERE mkkode='$mkkode' AND utsuas='A' AND bobot='2' ORDER BY RAND() LIMIT $b2)
		UNION
		(SELECT * FROM soal WHERE mkkode='$mkkode' AND utsuas='A' AND bobot='3' ORDER BY RAND() LIMIT $b3)
		UNION
		(SELECT * FROM soal WHERE mkkode='$mkkode' AND utsuas='A' AND bobot='4' ORDER BY RAND() LIMIT $b4)
		UNION
		(SELECT * FROM soal WHERE mkkode='$mkkode' AND utsuas='A' AND bobot='5' ORDER BY RAND() LIMIT $b5)
		)a ORDER BY RAND()");//random soal disini
		$noo = 1;
		while($da=mysql_fetch_array($ra)){
		$idso=$da['id_soal'];
		$insert2=mysql_query("insert into soal_mhsw(no_urut,krsid,id_soal,ja,jb,jc,jd,je,status,tgl_insert,id_jujian,id_ujian,sj,jawaban,bobot)values('$noo','$krs','$idso','-','-','-','-','-','A',NOW(),'$id','$idj','B','S','0')");
		$noo++;
		}
		
		if($insert and $insert2){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&s=proses&id=$idj'/>";
	}
break;

/////////////////////////// kode update //////////////////
case 'nonaktif':

	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$idj = isset($_GET['idj']) ? htmlspecialchars($_GET['idj'],ENT_QUOTES) : '';
	$mh = isset($_GET['mh']) ? htmlspecialchars($_GET['mh'],ENT_QUOTES) : '';
	$krs = isset($_GET['k']) ? htmlspecialchars($_GET['k'],ENT_QUOTES) : '';
	
	
	if(empty($id) || empty($idj) || empty($mh)){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$insert=mysql_query("update master_ujian set st='N' where id_ujian='$id'");
		
		$insert2=mysql_query("update soal_mhsw set status='D' where krsid='$krs' and id_ujian='$id'");//delete random soal disini
		
		if($insert and $insert2){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&s=proses&id=$idj'/>";
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