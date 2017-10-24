<?php
session_start();

include '../../include/connection.php';
include '../../include/function.php';

$menu = 'gantipassword';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode update //////////////////
case 'update':
	$password_lama = isset($_POST['password_lama']) ? htmlspecialchars($_POST['password_lama'],ENT_QUOTES) : '';
	$password_baru = isset($_POST['password_baru']) ? htmlspecialchars($_POST['password_baru'],ENT_QUOTES) : '';
	$password_baru_konf = isset($_POST['password_baru_konf']) ? htmlspecialchars($_POST['password_baru_konf'],ENT_QUOTES) : '';
	
	if(empty($password_lama) || empty($password_baru) || empty($password_baru_konf)){
		echo "<script>alert('Semua Field harus diisi');history.back();</script>";
	}
	elseif($password_baru != $password_baru_konf){
		echo "<script>alert('Konfirmasi Password Baru harus sama dengan Password Baru');history.back();</script>";
	}
	else{
		$password_lama_en = encrypt_password($password_lama);
		$r=mysql_query("SELECT * FROM tbl_user WHERE user_name = '$_SESSION[user_name]' AND user_password = '$password_lama_en'");
		if(mysql_num_rows($r) == 1){
			$password_baru_en = encrypt_password($password_baru);
			$update=mysql_query("UPDATE tbl_user 
													SET user_password = '$password_baru_en'
													WHERE user_name = '$_SESSION[user_name]'");
			if($update){
				$status = '21';
			}
			else{
				$status = '20';
			}
			echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
		}
		else{
			echo "<script>alert('Password Lama yang Anda masukkan SALAH');history.back();</script>";
		}
	}
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>