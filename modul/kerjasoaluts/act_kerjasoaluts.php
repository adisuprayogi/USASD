<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'inputsoal';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$mkkode = isset($_POST['mkkode']) ? htmlspecialchars($_POST['mkkode'],ENT_QUOTES) : '';
	$nm = isset($_POST['nm']) ? htmlspecialchars($_POST['nm'],ENT_QUOTES) : '';
	$judul = isset($_POST['judul']) ? htmlspecialchars($_POST['judul'],ENT_QUOTES) : '';
	$bobot = isset($_POST['bobot']) ? htmlspecialchars($_POST['bobot'],ENT_QUOTES) : '';
	//$soal = isset($_POST['soal']) ? htmlspecialchars($_POST['soal'],ENT_QUOTES) : '';
	$soal=$_POST['soal'];
	$ja = isset($_POST['ja']) ? htmlspecialchars($_POST['ja'],ENT_QUOTES) : '';
	$sa = isset($_POST['sa']) ? htmlspecialchars($_POST['sa'],ENT_QUOTES) : '';
	$jb = isset($_POST['jb']) ? htmlspecialchars($_POST['jb'],ENT_QUOTES) : '';
	$sb = isset($_POST['sb']) ? htmlspecialchars($_POST['sb'],ENT_QUOTES) : '';
	$jc = isset($_POST['jc']) ? htmlspecialchars($_POST['jc'],ENT_QUOTES) : '';
	$sc = isset($_POST['sc']) ? htmlspecialchars($_POST['sc'],ENT_QUOTES) : '';
	$jd = isset($_POST['jd']) ? htmlspecialchars($_POST['jd'],ENT_QUOTES) : '';
	$sd = isset($_POST['sd']) ? htmlspecialchars($_POST['sd'],ENT_QUOTES) : '';
	$je = isset($_POST['je']) ? htmlspecialchars($_POST['je'],ENT_QUOTES) : '';
	$se = isset($_POST['se']) ? htmlspecialchars($_POST['se'],ENT_QUOTES) : '';
	
	if(empty($mkkode) || empty($judul) || empty($bobot) || empty($soal)     ){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO soal(mkkode,judul,bobot,soal,ja,sa,jb,sb,jc,sc,jd,sd,je,se,status,tgl_insert,tgl_edit) VALUES('$mkkode','$judul','$bobot','$soal','$ja','$sa','$jb','$sb','$jc','$sc','$jd','$sd','$je','$se','A',NOW(),NOW())");
		if($insert){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status&kd=$mkkode&nm=$nm'/>";
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