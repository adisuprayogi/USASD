<?php
echo "<h3>Lupa Password</h3>
	<form name='form_lupapassword' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
		<div class='quoteForgetPassword'>
			Halaman ini merupakan halaman khusus bagi para user yang sudah memiliki akun tetapi tidak dapat login karena lupa password.
		</div>
			<p align='justify'>
			Silahkan isi <b class='sisip'>kolom Username</b>, kemudian isi <b class='sisip'>
			kolom Verifikasi</b>, setelah itu <b class='sisip'> KLIK TOMBOL RESET</b>.
			Jika <b class='sisip'>Username anda valid</b>, dan kolom email anda pada saat mendaftar sudah anda
			isi, maka <b class='sisip'>sistem akan mengirimkan link untuk me-reset password anda melalui email tersebut</b>.</p>
			<table width='500px'>
			<tr width='100px'><td>Username</td><td><input type='text' name='lupapassword' size='40'></td></tr>
			<tr><td>Kode Verifikasi</td><td><input type='text' name='lupapassword' size='40'></td></tr>
			<tr><td></td><td><input type='button' class='button' value='RESET' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
			</table><br>
			<div class='clear'></div>
			Apabila anda belum/tidak mengisi email anda pada kolom email saat melakukan pendaftaran baik via online maupun offline, maka anda tidak dapat
			menggunakan fasilitas lupa password ini."
?>