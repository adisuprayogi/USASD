<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '1'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
	echo "<h3>Tambah Data Pegawai</h3>
	<form name='form_karyawan' method='POST' action='modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
	<table>
		<tr><td><b>NIK</b></td><td><input type='text' name='kyw_nik' size='10' maxlength='10'></td></tr>
		<tr><td><b>Nama</b></td><td><input type='text' name='kyw_nama' size='50'></td></tr>
		<tr><td><b>Gender</b></td><td><select name='kyw_jeniskelamin'><option value=''>-Pilih-</option>";
			{
				echo "<option value=Laki-laki>laki-laki</option>";
				echo "<option value=Perempuan>Perempuan</option>";
			}
			echo "
			</select></td></tr>
		<tr><td><b>Foto</b></td><td><input type='file' name='foto'></td></tr>
		<tr><td><b>Alamat</b></td><td><input type='text' name='kyw_alamat' size='50' value='$d[kyw_alamat]'></td></tr>
		<tr><td><b>Email</b></td><td><input type='text' name='kyw_email' size='30'></td></tr>
		<tr><td></td><td><input type='submit' class='button' value='SIMPAN'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
	</table>
	</form>
	";
break;

///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3>Data Pegawai</h3>";

if($status == '11') echo "<div class='sukses'>Simpan Data Berhasil</div>";
elseif($status == '10') echo "<div class='gagal'>Simpan Data Gagal</div>";
elseif($status == '21') echo "<div class='sukses'>Ubah Data Berhasil</div>";
elseif($status == '20') echo "<div class='gagal'>Ubah Data Gagal</div>";
elseif($status == '31') echo "<div class='sukses'>Hapus Data Berhasil</div>";
elseif($status == '30') echo "<div class='gagal'>Hapus Data Gagal</div>";

echo "
<input type='button' class='button' value='Tambah Data' style='float:right' 
 onclick=\"location.href='index.php?m=$menu&s=tambah'\">
<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>NIK</th>
		<th class='data'>Nama</th>
		<th class='data'>Gender</th>
		<th class='data'>Email</th>
		<th class='data' width='75px'>Pilihan</th>
	</tr>";
	
	$r=mysql_query("SELECT * FROM tbl_karyawan ORDER BY kyw_nik DESC");
	$no = 1;
	while($d=mysql_fetch_array($r)){
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[kyw_nik]</td>
			<td class='data'>$d[kyw_nama]</td>
			<td class='data' align='right'>$d[kyw_jeniskelamin]</td>
			<td class='data' align='right'>$d[kyw_email]</td>
			<td class='data' width='75px'>
			<center>
			<a href='index.php?m=$menu&s=edit&id=$d[kyw_nik]' title='Edit'><img src='css/img/edit.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='modul/$menu/act_$menu.php?act=hapus&id=$d[kyw_nik]' title='Delete' onclick=\"return confirm('Yakin hapus data ini..?')\"><img src='css/img/delete.png'></a>
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>
";
break;

///////////////////////////////////////////// edit ///////////////////////////////////////////
case 'edit':
	$id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
	$r=mysql_query("SELECT * FROM tbl_karyawan WHERE kyw_nik = '$id'");
	$d=mysql_fetch_array($r);
	echo "<h3>Edit Data Karyawan</h3>
	<form name='form_karyawan' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
		<tr><td><b>NIK</b></td><td><b>$d[kyw_nik]</b><input type='hidden' name='kyw_nik' value='$d[kyw_nik]'></td></tr>
		<tr><td><b>Nama</b></td><td><input type='text' name='kyw_nama' size='50' value='$d[kyw_nama]'></td></tr>
		<tr><td><b>Gender</b></td><td><select name='kyw_jeniskelamin'><option value='$d[kyw_jeniskelamin]'>$d[kyw_jeniskelamin]</option>";
			{
				echo "<option value=Laki-laki>laki-laki</option>";
				echo "<option value=Perempuan>Perempuan</option>";
			}
			echo "
			</select></td></tr>
		<tr><td><b>Foto</b></td><td><input type='file' name='foto' value='$d[kyw_foto]'></td></tr>
		<tr><td><b>Alamat</b></td><td><input type='text' name='kyw_alamat' size='50' value='$d[kyw_alamat]'></td></tr>
		<tr><td><b>Email</b></td><td><input type='text' name='kyw_email' size='30' value='$d[kyw_email]'></td></tr>
		<tr><td><b></b></td><td><img src='photo/pegawai/$d[kyw_foto]'/> </td></tr>
		<tr><td></td><td><input type='submit' class='button' value='UPDATE'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
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