<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'inputpegawai';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$kyw_nik = isset($_POST['kyw_nik']) ? htmlspecialchars($_POST['kyw_nik'],ENT_QUOTES) : '';
	$kyw_nama = isset($_POST['kyw_nama']) ? htmlspecialchars($_POST['kyw_nama'],ENT_QUOTES) : '';
	$kyw_jeniskelamin = isset($_POST['kyw_jeniskelamin']) ? htmlspecialchars($_POST['kyw_jeniskelamin'],ENT_QUOTES) : '';
	$kyw_alamat = isset($_POST['kyw_alamat']) ? htmlspecialchars($_POST['kyw_alamat'],ENT_QUOTES) : '';
	$kyw_email = isset($_POST['kyw_email']) ? htmlspecialchars($_POST['kyw_email'],ENT_QUOTES) : '';
	$lokasi_file = $_FILES['foto']['tmp_name'];
  	$tipe_file   = $_FILES['foto']['type'];
  	$nama_file   = $_FILES['foto']['name'];
  	$direktori   = '../../photo/pegawai/$nama_file';
	
	if(empty($kyw_nik) || empty($kyw_nama) || empty($kyw_jeniskelamin)){
		echo "<script>alert('NIK, NAMA dan Jenis Kelamin harus diisi');history.back();</script>";
	}
	else{
	
	if (!empty($lokasi_file)) {
 		//move_uploaded_file($lokasi_file,$direktori); 
		 upload_resize_image($nama_file,$lokasi_file,200,200,$direktori);
		//upload_resize_image($lokasi_file,$direktori,100,100);
		}
		
		$insert=mysql_query("INSERT INTO tbl_karyawan(kyw_nik, kyw_nama, kyw_jeniskelamin, kyw_alamat,kyw_email,kyw_foto) VALUES('$kyw_nik','$kyw_nama','$kyw_jeniskelamin','$kyw_alamat','$kyw_email','$nama_file')");
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
	$kyw_nama = isset($_POST['kyw_nama']) ? htmlspecialchars($_POST['kyw_nama'],ENT_QUOTES) : '';
	$kyw_jeniskelamin = isset($_POST['kyw_jeniskelamin']) ? htmlspecialchars($_POST['kyw_jeniskelamin'],ENT_QUOTES) : '';
	$kyw_alamat = isset($_POST['kyw_alamat']) ? htmlspecialchars($_POST['kyw_alamat'],ENT_QUOTES) : '';
	$kyw_email = isset($_POST['kyw_email']) ? htmlspecialchars($_POST['kyw_email'],ENT_QUOTES) : '';
	$lokasi_file = $_FILES['foto']['tmp_name'];
  	$tipe_file   = $_FILES['foto']['type'];
  	$nama_file   = $_FILES['foto']['name'];
  	$direktori   ="../../photo/pegawai/$nama_file";
	
	if(empty($kyw_nik) || empty($kyw_nama) || empty($kyw_jeniskelamin)){
		echo "<script>alert('NIK, NAMA dan Jenis Kelamin harus diisi');history.back();</script>";
	}
	else{
	
	if (!empty($lokasi_file)) {
 		//move_uploaded_file($lokasi_file,$direktori); 
		upload_resize_image($nama_file,$lokasi_file,200,200,$direktori);
		}
		
		$update=mysql_query("UPDATE tbl_karyawan 
												SET kyw_nama = '$kyw_nama', kyw_jeniskelamin = '$kyw_jeniskelamin', kyw_alamat = '$kyw_alamat',kyw_email='$kyw_email',kyw_foto='$nama_file' WHERE kyw_nik = '$kyw_nik'");
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
	$kyw_nik = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$delete=mysql_query("DELETE FROM tbl_karyawan WHERE kyw_nik = '$kyw_nik'");
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