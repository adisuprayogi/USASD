<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'inputjabatan';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$kyw_nik = isset($_POST['kyw_nik']) ? htmlspecialchars($_POST['kyw_nik'],ENT_QUOTES) : '';
	$jabatan = isset($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan'],ENT_QUOTES) : '';
	$golongan = isset($_POST['golongan']) ? htmlspecialchars($_POST['golongan'],ENT_QUOTES) : '';
	$unit_kerja = isset($_POST['unit_kerja']) ? htmlspecialchars($_POST['unit_kerja'],ENT_QUOTES) : '';
	$mutasi = isset($_POST['mutasi']) ? htmlspecialchars($_POST['mutasi'],ENT_QUOTES) : '';
	$tgl_berlaku = isset($_POST['tgl_berlaku']) ? htmlspecialchars($_POST['tgl_berlaku'],ENT_QUOTES) : ''; 
	$tgl_berlaku = format_tgl($tgl_berlaku,'yyyy-mm-dd');
	
	if(empty($jabatan) || empty($kyw_nik)){
		echo "<script>alert('NIK, dan Jabatan harus diisi');history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO tabel_riwayat_jabatan(NIP,tgl_berlaku,jabatan,golongan,unit_kerja,mutasi,status) VALUES('$kyw_nik','$tgl_berlaku','$jabatan','$golongan','$unit_kerja','$mutasi','A')");
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
	$id_riw_jabatan=isset($_POST['id_riw_jabatan']) ? htmlspecialchars($_POST['id_riw_jabatan'],ENT_QUOTES) : '';
	$jabatan = isset($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan'],ENT_QUOTES) : '';
	$golongan = isset($_POST['golongan']) ? htmlspecialchars($_POST['golongan'],ENT_QUOTES) : '';
	$unit_kerja = isset($_POST['unit_kerja']) ? htmlspecialchars($_POST['unit_kerja'],ENT_QUOTES) : '';
	$mutasi = isset($_POST['mutasi']) ? htmlspecialchars($_POST['mutasi'],ENT_QUOTES) : '';
	$tgl_berlaku = isset($_POST['tgl_berlaku']) ? htmlspecialchars($_POST['tgl_berlaku'],ENT_QUOTES) : ''; 
	$tgl_berlaku = format_tgl($tgl_berlaku,'yyyy-mm-dd');
	
	
	if(empty($jabatan)){
		echo "<script>alert('Jabatan harus diisi');history.back();</script>";
	}
	else{
		$update=mysql_query("UPDATE tabel_riwayat_jabatan SET tgl_berlaku= '$tgl_berlaku', jabatan='$jabatan', golongan = '$golongan' , unit_kerja = '$unit_kerja',mutasi='$mutasi' WHERE id_riw_jabatan = '$id_riw_jabatan'");
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
	$id_riw_jabatan = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$delete=mysql_query("DELETE FROM tabel_riwayat_jabatan WHERE id_riw_jabatan = '$id_riw_jabatan'");
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