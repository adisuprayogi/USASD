<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'inputkeluarga';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$kyw_nik = isset($_POST['kyw_nik']) ? htmlspecialchars($_POST['kyw_nik'],ENT_QUOTES) : '';
	$Hub_keluarga = isset($_POST['Hub_keluarga']) ? htmlspecialchars($_POST['Hub_keluarga'],ENT_QUOTES) : '';
	$nama_keluarga = isset($_POST['nama_keluarga']) ? htmlspecialchars($_POST['nama_keluarga'],ENT_QUOTES) : '';
	$jk = isset($_POST['jk']) ? htmlspecialchars($_POST['jk'],ENT_QUOTES) : '';
	$tempat_lahir = isset($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir'],ENT_QUOTES) : '';
	$tgl_lahir = isset($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir'],ENT_QUOTES) : ''; 
	$tgl_lahir = format_tgl($tgl_lahir,'yyyy-mm-dd');
	$Pend_terakhir = isset($_POST['Pend_terakhir']) ? htmlspecialchars($_POST['Pend_terakhir'],ENT_QUOTES) : '';
	$Jab_pekerjaan = isset($_POST['Jab_pekerjaan']) ? htmlspecialchars($_POST['Jab_pekerjaan'],ENT_QUOTES) : '';
	$Per_pekerjaan = isset($_POST['Per_pekerjaan']) ? htmlspecialchars($_POST['Per_pekerjaan'],ENT_QUOTES) : '';
	
	
	if(empty($nama_keluarga) || empty($kyw_nik)){
		echo "<script>alert('NIK, dan Nama Keluarga harus diisi');history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO tabel_keluarga(NIP,Hub_keluarga,nama_keluarga,jk,tempat_lahir,tgl_lahir,pend_terakhir,jab_pekerjaan,Per_pekerjaan) VALUES('$kyw_nik','$Hub_keluarga','$nama_keluarga','$jk','$tempat_lahir','$tgl_lahir','$Pend_terakhir','$Jab_pekerjaan','$Per_pekerjaan')");
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
	$id_keluarga=isset($_POST['id_keluarga']) ? htmlspecialchars($_POST['id_keluarga'],ENT_QUOTES) : '';
	$Hub_keluarga = isset($_POST['Hub_keluarga']) ? htmlspecialchars($_POST['Hub_keluarga'],ENT_QUOTES) : '';
	$nama_keluarga = isset($_POST['nama_keluarga']) ? htmlspecialchars($_POST['nama_keluarga'],ENT_QUOTES) : '';
	$jk = isset($_POST['jk']) ? htmlspecialchars($_POST['jk'],ENT_QUOTES) : '';
	$tempat_lahir = isset($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir'],ENT_QUOTES) : '';
	$Pend_terakhir = isset($_POST['Pend_terakhir']) ? htmlspecialchars($_POST['Pend_terakhir'],ENT_QUOTES) : '';
	$Jab_pekerjaan = isset($_POST['Jab_pekerjaan']) ? htmlspecialchars($_POST['Jab_pekerjaan'],ENT_QUOTES) : '';
	$Per_pekerjaan = isset($_POST['Per_pekerjaan']) ? htmlspecialchars($_POST['Per_pekerjaan'],ENT_QUOTES) : '';
	$tgl_lahir = isset($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir'],ENT_QUOTES) : ''; 
	$tgl_lahir = format_tgl($tgl_lahir,'yyyy-mm-dd');
	
	
	if(empty($nama_keluarga)){
		echo "<script>alert('Nama harus diisi');history.back();</script>";
	}
	else{
		$update=mysql_query("UPDATE tabel_keluarga SET nama_keluarga= '$nama_keluarga', Hub_keluarga='$Hub_keluarga', jk = '$jk' , tempat_lahir = '$tempat_lahir',tgl_lahir='$tgl_lahir',pend_terakhir='$Pend_terakhir',jab_pekerjaan='$Jab_pekerjaan',Per_pekerjaan='$Per_pekerjaan' WHERE id_keluarga = '$id_keluarga'");
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
	$id_keluarga = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$delete=mysql_query("DELETE FROM tabel_keluarga WHERE id_keluarga = '$id_keluarga'");
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