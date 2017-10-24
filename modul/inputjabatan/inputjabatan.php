<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '1'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
	echo "<h3>Tambah Data Riwayat Jabatan</h3>
	<form name='form_jabatan' method='POST' action='modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
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
		<tr><td><b>Tanggal berlaku</b></td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_berlaku' readonly='yes' onfocus=\"displayCalendar(document.form_jabatan.tgl_berlaku,'dd-mm-yyyy',this)\"/><img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_jabatan.tgl_berlaku,'dd-mm-yyyy',this)\" title='Kalendar'/>
		
		<tr><td><b>Jabatan</b></td><td><input type='text' name='jabatan' size='50' value=''></td></tr>
		<tr><td><b>Golongan</b></td><td><input type='text' name='golongan' size='50' value=''></td></tr>
		<tr><td><b>Unit Kerja</b></td><td><input type='text' name='unit_kerja' size='50' value=''></td></tr>
		<tr><td><b>Mutasi</b></td><td><input type='text' name='mutasi' size='50' value=''></td></tr>
				
		<tr><td></td><td><input type='submit' class='button' value='SIMPAN'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
	</table>
	</form>
	";
break;

///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3>Daftar Riwayat Jabatan</h3>";

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
		<th class='data'>Nama</th>
		<th class='data'>tanggal berlaku</th>
		<th class='data'>Jabatan</th>
		<th class='data'>Golongan</th>
		<th class='data'>Unit Kerja</th>
		<th class='data' >Mutasi</th>
				<th class='data' >Pilihan</th>
	</tr>";
	
	$r=mysql_query("SELECT A.*, B.kyw_nama,B.kyw_nik FROM tabel_riwayat_jabatan A, tbl_karyawan B WHERE A.NIP = B.kyw_nik ORDER BY
					B.kyw_nik DESC, A.id_riw_jabatan DESC");
	$no = 1;
	while($d=mysql_fetch_array($r)){
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data'>$d[kyw_nama]</td>
			<td class='data' align='center'>$d[tgl_berlaku]</td>
			<td class='data'>$d[jabatan]</td>
			<td class='data' align='center'>$d[golongan]</td>
			<td class='data' align='center'>$d[unit_kerja]</td>
			<td class='data'>$d[mutasi]</td>
			

			<td class='data' width='75px'>
			<center>
			<a href='index.php?m=$menu&s=edit&id=$d[id_riw_jabatan]' title='Edit'><img src='css/img/edit.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='modul/$menu/act_$menu.php?act=hapus&id=$d[id_riw_jabatan]' title='Delete' onclick=\"return confirm('Yakin hapus data ini..?')\"><img src='css/img/delete.png'></a>
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
	$re=mysql_query("SELECT * FROM tabel_riwayat_jabatan A, tbl_karyawan B WHERE A.NIP = b.kyw_nik AND id_riw_jabatan = '$id'");
	$de=mysql_fetch_array($re);
	echo "<h3>Edit Data Keluarga pegawai</h3>
	<form name='form_jabatan' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
		<tr><td width='180px'><b>Nama Pegawai</b></td><td><b>$de[kyw_nama]</b></td></tr>
		<tr><td width='180px'><b>Kode jabatan</b></td><td><b>$de[id_riw_jabatan]</b>
														<input type='hidden' name='id_riw_jabatan' value='$de[id_riw_jabatan]'></td></tr>
		<tr><td><b>Tanggal berlaku</b></td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_berlaku' readonly='yes' onfocus=\"displayCalendar(document.form_jabatan.tgl_berlaku,'dd-mm-yyyy',this)\" value='".format_tgl($de['tgl_berlaku'],'dd-mm-yyyy')."'/><img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_jabatan.tgl_berlaku,'dd-mm-yyyy',this)\" title='Kalendar'/>
		
		<tr><td><b>Jabatan</b></td><td><input type='text' name='jabatan' size='50' value=$de[jabatan]></td></tr>
		<tr><td><b>Golongan</b></td><td><input type='text' name='golongan' size='50' value=$de[golongan]></td></tr>
		<tr><td><b>Unit Kerja</b></td><td><input type='text' name='unit_kerja' size='50' value=$de[unit_kerja]></td></tr>
		<tr><td><b>Mutasi</b></td><td><input type='text' name='mutasi' size='50' value=$de[mutasi]></td></tr>
		
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