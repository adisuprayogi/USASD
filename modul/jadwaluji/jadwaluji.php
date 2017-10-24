<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '1'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
	echo "<h3>Tambah Data Keluarga</h3>
	<form name='form_keluarga' method='POST' action='modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
	<table>
		<tr><td width='180px'><b>Pegawai</b></td><td>
			<select name='kyw_nik'><option value=''>-Pilih-</option>";
			$r=mysql_query("SELECT * FROM tbl_karyawan ORDER BY kyw_nik DESC");
			while($d=mysql_fetch_array($r)){
				echo "<option value='$d[kyw_nik]'>$d[kyw_nama]</option>";
			}
			echo "
			</select>
			</td></tr>
		<tr><td><b>Nama</b></td><td><input type='text' name='nama_keluarga'></td></tr>
		<tr><td><b>Gender</b></td><td><select name='jk'><option value=''>-Pilih=</option>";
			{
				echo "<option value=Laki-laki>laki-laki</option>";
				echo "<option value=Perempuan>Perempuan</option>";
			}
			echo "
			</select></td></tr>
		<tr><td><b>Hubungan</b></td><td><select name='Hub_keluarga'><option value=''>Pilih</option>";
			{
				echo "<option value=Isteri>Isteri</option>";
				echo "<option value=Anak>Anak</option>";
				echo "<option value=Ibu>Ibu</option>";
				echo "<option value=Bapak>Bapak</option>";
				echo "<option value=Adik>Adik</option>";
				echo "<option value=Kakak>Kakak</option>";
			}
			echo "
			</select></td></tr>
		<tr><td><b>Tempat Lahir</b></td><td><input type='text' name='tempat_lahir' size='50' value=''></td></tr>
		
		<tr><td><b>Tanggal Lahir</b></td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_lahir' readonly='yes' onfocus=\"displayCalendar(document.form_keluarga.tgl_lahir,'dd-mm-yyyy',this)\"/><img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_keluarga.tgl_lahir,'dd-mm-yyyy',this)\" title='Kalendar'/>
		
		<tr><td><b>Pendidikan Terakhir</b></td><td><input type='text' name='Pend_terakhir' size='50' value=''></td></tr>
		<tr><td><b>Jabatan</b></td><td><input type='text' name='Jab_pekerjaan' size='50' value=''></td></tr>
		<tr><td><b>Perusahaan</b></td><td><input type='text' name='Per_pekerjaan' size='50' value=''></td></tr>
		
		<tr><td></td><td><input type='submit' class='button' value='SIMPAN'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
	</table>
	</form>
	";
break;

///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3>Masukan Tahun ID Jadwal</h3>";

echo "
<form name='cari1' method='POST' action='index.php?m=jadwal' enctype='multipart/form-data'>
";

echo "<input type='text' name='cari1' value='' size='30' maxlength='25'>";
echo "
<input type='submit' class='button' value='search'>"; 
echo"
 <br>
 </form>";
break;

///////////////////////////////////////////// edit ///////////////////////////////////////////
case 'edit':
	$id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
	$re=mysql_query("SELECT * FROM tabel_keluarga A, tbl_karyawan B WHERE A.NIP = b.kyw_nik AND id_keluarga = '$id'");
	$de=mysql_fetch_array($re);
	echo "<h3>Edit Data Keluarga pegawai</h3>
	<form name='form_keluarga' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
		<tr><td width='180px'><b>Nama Pegawai</b></td><td><b>$de[kyw_nama]</b></td></tr>
		<tr><td width='180px'><b>Kode Keluarga</b></td><td><b>$de[id_keluarga]</b>
														<input type='hidden' name='id_keluarga' value='$de[id_keluarga]'></td></tr>
		<tr><td><b>Nama</b></td><td><input type='text' name='nama_keluarga' size='50' value='$de[nama_keluarga]'></td></tr>
		<tr><td><b>Gender</b></td><td><select name='jk'><option value='$de[jk]'>$de[jk]</option>";
			{
				echo "<option value=Laki-laki>laki-laki</option>";
				echo "<option value=Perempuan>Perempuan</option>";
			}
			echo "
			</select></td></tr>
		<tr><td><b>Hubungan</b></td><td><select name='Hub_keluarga'><option value='$de[Hub_keluarga]'>$de[Hub_keluarga]</option>";
			{
				echo "<option value=Isteri>Isteri</option>";
				echo "<option value=Anak>Anak</option>";
				echo "<option value=Ibu>Ibu</option>";
				echo "<option value=Bapak>Bapak</option>";
				echo "<option value=Adik>Adik</option>";
				echo "<option value=Kakak>Kakak</option>";
			}
			echo "
			</select></td></tr>
		<tr><td><b>Tempat Lahir</b></td><td><input type='text' name='tempat_lahir' size='50' value='$de[tempat_lahir]'></td></tr>
		
		<tr><td><b>Tanggal Lahir</b></td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_lahir' readonly='yes' onfocus=\"displayCalendar(document.form_keluarga.tgl_lahir,'dd-mm-yyyy',this)\" value='".format_tgl($de['tgl_lahir'],'dd-mm-yyyy')."'/> <img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_keluarga.tgl_lahir,'dd-mm-yyyy',this)\" title='Kalendar'/>
		
		<tr><td><b>Pendidikan Terakhir</b></td><td><input type='text' name='Pend_terakhir' size='50' value='$de[pend_terakhir]'></td></tr>
		<tr><td><b>Jabatan</b></td><td><input type='text' name='Jab_pekerjaan' size='50' value='$de[jab_pekerjaan]'></td></tr>
		<tr><td><b>Perusahaan</b></td><td><input type='text' name='Per_pekerjaan' size='50' value='$de[Per_pekerjaan]'></td></tr>
		
		<tr><td></td><td><input type='submit' class='button' value='UPDATE'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
	</table>
	</form>
	";
break;
}

}
else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>