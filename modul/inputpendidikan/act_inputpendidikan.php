<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'inputpendidikan';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$kyw_nik = isset($_POST['kyw_nik']) ? htmlspecialchars($_POST['kyw_nik'],ENT_QUOTES) : '';
	$jenjang = isset($_POST['jenjang']) ? htmlspecialchars($_POST['jenjang'],ENT_QUOTES) : '';
	$lembaga = isset($_POST['lembaga']) ? htmlspecialchars($_POST['lembaga'],ENT_QUOTES) : '';
	$jurusan = isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan'],ENT_QUOTES) : '';
	$tahun = isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun'],ENT_QUOTES) : '';
	$no_ijasah = isset($_POST['no_ijasah']) ? htmlspecialchars($_POST['no_ijasah'],ENT_QUOTES) : '';
	
	if(empty($jenjang) || empty($kyw_nik)){
		echo "<script>alert('NIK, dan Jenjang harus diisi');history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO tabel_pend_formal(NIP,jenjang,lembaga,jurusan,tahun,no_ijasah) VALUES('$kyw_nik','$jenjang','$lembaga','$jurusan','$tahun','$no_ijasah')");
		if($insert){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
	}
break;

/////////////////////////// kode update //////////////////
case 'update':
	$kyw_nik = isset($_POST['kyw_nik']) ? htmlspecialchars($_POST['kyw_nik'],ENT_QUOTES) : '';
	$id_pendidikan=isset($_POST['id_pendidikan']) ? htmlspecialchars($_POST['id_pendidikan'],ENT_QUOTES) : '';
	$jenjang = isset($_POST['jenjang']) ? htmlspecialchars($_POST['jenjang'],ENT_QUOTES) : '';
	$lembaga = isset($_POST['lembaga']) ? htmlspecialchars($_POST['lembaga'],ENT_QUOTES) : '';
	$jurusan = isset($_POST['jurusan']) ? htmlspecialchars($_POST['jurusan'],ENT_QUOTES) : '';
	$tahun = isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun'],ENT_QUOTES) : '';
	$no_ijasah = isset($_POST['no_ijasah']) ? htmlspecialchars($_POST['no_ijasah'],ENT_QUOTES) : '';
	
	
	
	if(empty($jenjang)){
		echo "<script>alert('Jenjang harus diisi');history.back();</script>";
	}
	else{
		$update=mysql_query("UPDATE tabel_pend_formal SET jenjang= '$jenjang', lembaga='$lembaga', jurusan = '$jurusan' , tahun = '$tahun',no_ijasah='$no_ijasah' WHERE id_pendidikan = '$id_pendidikan'");
		if($update){
			$status = '21';
		}
		else{
			$status = '20';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
	}
break;

/////////////////////////// kode hapus //////////////////
case 'hapus':
	$id_pendidikan = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$delete=mysql_query("DELETE FROM tabel_pend_formal WHERE id_pendidikan = '$id_pendidikan'");
	if($delete){
		$status = '31';
	}
	else{
		$status = '30';
	}
	echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>