<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'inputsoaluts';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$mkkode = isset($_POST['mkkode']) ? htmlspecialchars($_POST['mkkode'],ENT_QUOTES) : '';
	$nm = isset($_POST['nm']) ? htmlspecialchars($_POST['nm'],ENT_QUOTES) : '';
	$judul = isset($_POST['judul']) ? htmlspecialchars($_POST['judul'],ENT_QUOTES) : '';
	$bobot = isset($_POST['bobot']) ? htmlspecialchars($_POST['bobot'],ENT_QUOTES) : '';
	$soal = isset($_POST['soal']) ? htmlspecialchars($_POST['soal'],ENT_QUOTES) : '';
	$ja = isset($_POST['ja']) ? htmlspecialchars($_POST['ja'],ENT_QUOTES) : '';
	$sa = isset($_POST['sa']) ? htmlspecialchars($_POST['sa'],ENT_QUOTES) : '';
	$jb = isset($_POST['jb']) ? htmlspecialchars($_POST['jb'],ENT_QUOTES) : '';
	$sb = isset($_POST['sb']) ? htmlspecialchars($_POST['sb'],ENT_QUOTES) : '';
	$jc = isset($_POST['jc']) ? htmlspecialchars($_POST['jc'],ENT_QUOTES) : '';
	$sc = isset($_POST['sc']) ? htmlspecialchars($_POST['sc'],ENT_QUOTES) : '';
	$jd = isset($_POST['jd']) ? htmlspecialchars($_POST['jd'],ENT_QUOTES) : '';
	$sd = isset($_POST['sd']) ? htmlspecialchars($_POST['sd'],ENT_QUOTES) : '';
	$je = isset($_POST['je']) ? htmlspecialchars($_POST['je'],ENT_QUOTES) : '';
	$se = isset($_POST['se']) ? htmlspecialchars($_POST['se'],ENT_QUOTES) : 'S';
	
	if(empty($mkkode) || empty($judul) || empty($bobot) || empty($soal) || empty($sa) || empty($ja) || empty($sb) || empty($jb) || empty($sc) || empty($jc) || empty($sd) || empty($jd) || empty($se)){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO soal(mkkode,judul,bobot,soal,ja,sa,jb,sb,jc,sc,jd,sd,je,se,status,tgl_insert,tgl_edit,utsuas) VALUES('$mkkode','$judul','$bobot','$soal','$ja','$sa','$jb','$sb','$jc','$sc','$jd','$sd','$je','$se','A',NOW(),NOW(),'T')");
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

	$ids = isset($_POST['ids']) ? htmlspecialchars($_POST['ids'],ENT_QUOTES) : '';
	$mkkode = isset($_POST['mkkode']) ? htmlspecialchars($_POST['mkkode'],ENT_QUOTES) : '';
	$nm = isset($_POST['nm']) ? htmlspecialchars($_POST['nm'],ENT_QUOTES) : '';
	$judul = isset($_POST['judul']) ? htmlspecialchars($_POST['judul'],ENT_QUOTES) : '';
	$bobot = isset($_POST['bobot']) ? htmlspecialchars($_POST['bobot'],ENT_QUOTES) : '';
	$soal = isset($_POST['soal']) ? htmlspecialchars($_POST['soal'],ENT_QUOTES) : '';
	$ja = isset($_POST['ja']) ? htmlspecialchars($_POST['ja'],ENT_QUOTES) : '';
	$sa = isset($_POST['sa']) ? htmlspecialchars($_POST['sa'],ENT_QUOTES) : '';
	$jb = isset($_POST['jb']) ? htmlspecialchars($_POST['jb'],ENT_QUOTES) : '';
	$sb = isset($_POST['sb']) ? htmlspecialchars($_POST['sb'],ENT_QUOTES) : '';
	$jc = isset($_POST['jc']) ? htmlspecialchars($_POST['jc'],ENT_QUOTES) : '';
	$sc = isset($_POST['sc']) ? htmlspecialchars($_POST['sc'],ENT_QUOTES) : '';
	$jd = isset($_POST['jd']) ? htmlspecialchars($_POST['jd'],ENT_QUOTES) : '';
	$sd = isset($_POST['sd']) ? htmlspecialchars($_POST['sd'],ENT_QUOTES) : '';
	$je = isset($_POST['je']) ? htmlspecialchars($_POST['je'],ENT_QUOTES) : '';
	$se = isset($_POST['se']) ? htmlspecialchars($_POST['se'],ENT_QUOTES) : 'S';
	
	if(empty($mkkode) || empty($judul) || empty($bobot) || empty($soal) || empty($sa) || empty($ja) || empty($sb) || empty($jb) || empty($sc) || empty($jc) || empty($sd) || empty($jd) || empty($se)){
		echo "<script>alert('Data belum diisi dengan lengkap');history.back();</script>";
	}
	else{
		$update=mysql_query("UPDATE soal set judul='$judul',bobot='$bobot',soal='$soal',ja='$ja',sa='$sa',jb='$jb',sb='$sb',jc='$jc',sc='$sc',jd='$jd',sd='$sd',je='$je',se='$se',tgl_edit=NOW() where id_soal='$ids'");
		if($update){
			$status = '21';
		}
		else{
			$status = '20';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status&kd=$mkkode&nm=$nm'/>";
	}
break;

/////////////////////////// kode hapus //////////////////
case 'hapus':
	$id_soal = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$mkkode = isset($_GET['mkkode']) ? htmlspecialchars($_GET['mkkode'],ENT_QUOTES) : '';
	$nm = isset($_GET['nm']) ? htmlspecialchars($_GET['nm'],ENT_QUOTES) : '';
	
	$delete=mysql_query("update soal set status='D' WHERE id_soal = '$id_soal'");
	if($delete){
		$status = '31';
	}
	else{
		$status = '30';
	}
	echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status&kd=$mkkode&nm=$nm'/>";
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>