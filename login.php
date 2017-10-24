<?php
if(isset($_POST['submit'])){
	include 'include/connection.php';
	include 'include/function.php';
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(empty($username) || empty($password)){
		echo "<script>alert('Username dan Password Harus Diisi..!!')</script>
		<meta http-equiv='Refresh' content='0; URL=index.php'/>";	
	}
	else{
		$pass_en = encrypt_password($password);
		$login = mysql_query("SELECT A.*,IFNULL(kyw_nik,cmb_kd) as user_kd,B.level_nama FROM tbl_user A, tbl_level B 
		WHERE A.level_kd = B.level_kd AND user_name = '$username' AND user_password='$pass_en'");
		if(mysql_num_rows($login) == 1){
			$d=mysql_fetch_array($login);
			session_start();
			$_SESSION['user_kd'] = $d['user_kd'];
			$_SESSION['user_name'] = $d['user_name'];
			$_SESSION['user_level_kd'] = $d['level_kd'];
			$_SESSION['user_level'] = $d['level_nama'];
			$_SESSION['KCFINDER']=array();
			$_SESSION['KCFINDER']['disabled'] = false;
			$_SESSION['KCFINDER']['uploadURL'] = "/webku/images/";
			$_SESSION['KCFINDER']['uploadDir'] = "";
			
			echo "<meta http-equiv='Refresh' content='0; URL=index.php'/>";
			
		}
		else{
			echo "<script>alert('Login Gagal\\nPeriksa Username dan Password Anda..!')</script>
			<meta http-equiv='Refresh' content='0; URL=index.php'/>";
		}
		
	}
	
	mysql_close($koneksi);
}
?>