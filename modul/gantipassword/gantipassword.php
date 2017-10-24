<?php
if(isset($_SESSION['user_level_kd'])){

$status = isset($_GET['status']) ? $_GET['status'] : '';
switch($submenu){
///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3>Change Password</h3>";

if($status == '21') echo "<div class='sukses'>Succesful</div>";
elseif($status == '20') echo "<div class='gagal'>Unsuccesful</div>";

echo "
	<div class='clear'></div>
	<form name='form_periode' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
		<tr><td width='160px'><b>Level</b></td><td>".$_SESSION['user_level']."</td></tr>
		<tr><td><b>Username</b></td><td>".$_SESSION['user_name']."</td></tr>
		<tr><td><b>Current Password</b></td><td><input type='password' name='password_lama' size='25'></td></tr>
		<tr><td colspan='2'>&nbsp;</td></tr>
		<tr><td><b>New Password</b></td><td><input type='password' name='password_baru' size='25'></td></tr>
		<tr><td><b>Confirm New Password</b></td><td><input type='password' name='password_baru_konf' size='25'></td></tr>
		<tr><td></td><td><input type='submit' class='button' value='UPDATE'> </td></tr>
	</table>
	</form>
	";
break;
}

//validasi login
}
else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>