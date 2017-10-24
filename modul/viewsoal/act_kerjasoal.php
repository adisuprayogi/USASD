<?php
include '../../include/connection.php';
include '../../include/function.php';

$menu = 'kerjasoal';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$id = isset($_POST['id']) ? htmlspecialchars($_POST['id'],ENT_QUOTES) : '';
	$idj = isset($_POST['idj']) ? htmlspecialchars($_POST['idj'],ENT_QUOTES) : '';
	$mh = isset($_POST['mh']) ? htmlspecialchars($_POST['mh'],ENT_QUOTES) : '';
	$ur = isset($_POST['ur']) ? htmlspecialchars($_POST['ur'],ENT_QUOTES) : '';
	$idso = isset($_POST['idso']) ? htmlspecialchars($_POST['idso'],ENT_QUOTES) : '';
	$check1 = isset($_POST['check1']) ? htmlspecialchars($_POST['check1'],ENT_QUOTES) : 'S';
	$check2 = isset($_POST['check2']) ? htmlspecialchars($_POST['check2'],ENT_QUOTES) : 'S';
	$check3 = isset($_POST['check3']) ? htmlspecialchars($_POST['check3'],ENT_QUOTES) : 'S';
	$check4 = isset($_POST['check4']) ? htmlspecialchars($_POST['check4'],ENT_QUOTES) : 'S';
	$check5 = isset($_POST['check5']) ? htmlspecialchars($_POST['check5'],ENT_QUOTES) : 'S';
	$urn=$ur+1;
	
	
	
	
	if(empty($id) || empty($idj) || empty($ur) || empty($idso) || empty($check1) || empty($check2) || empty($check3) || empty($check4) || empty($check5)){
		echo "<script>alert('Jawaban Tidak Bisa Diproses');history.back();</script>";
	}
	else{
		$insert=mysql_query("update soal_mhsw set ja='$check1',jb='$check2',jc='$check3',jd='$check4',je='$check5',SJ='F' where id_soalm='$idso'");
		if($insert){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&id=$id&idj=$idj&ur=$urn'/>";
	}
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>