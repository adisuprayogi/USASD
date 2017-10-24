<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'listujianuts';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'aktif':

	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$idj = isset($_GET['idj']) ? htmlspecialchars($_GET['idj'],ENT_QUOTES) : '';
	$mh = isset($_GET['mh']) ? htmlspecialchars($_GET['mh'],ENT_QUOTES) : '';
	
	
	if(empty($id) || empty($idj) || empty($mh)){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$insert=mysql_query("update master_ujian set st='A' where id_ujian='$id'");
		
		$insert2=mysql_query("");//random soal disini
		
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
	
	
	if(empty($id) || empty($idj) || empty($mh)){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$insert=mysql_query("update master_ujian set st='N' where id_ujian='$id'");
		
		$insert2=mysql_query("");//delete random soal disini
		
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