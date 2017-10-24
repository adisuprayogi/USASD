<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '1'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
	echo "<h3>Tambah Data Riwayat Pendidikan</h3>
	<form name='form_pendidikan' method='POST' action='modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
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
		<tr><td><b>Jenjang</b></td><td><input type='text' name='jenjang' size='50' value=$de[jenjang]></td></tr>
		<tr><td><b>Lembaga</b></td><td><input type='text' name='lembaga' size='50' value=$de[lembaga]></td></tr>
		<tr><td><b>Jurusan</b></td><td><input type='text' name='jurusan' size='50' value=$de[jurusan]></td></tr>
		<tr><td><b>Tahun</b></td><td><input type='text' name='tahun' size='50' value=$de[tahun]></td></tr>
		<tr><td><b>Ijasah</b></td><td><input type='text' name='no_ijasah' size='50' value=$de[ijasah]></td></tr>
		
		<tr><td></td><td><input type='submit' class='button' value='SIMPAN'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
	</table>
	</form>
	";
break;

///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3>Daftar Riwayat Pendidikan</h3>";

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
		<th class='data'>Jenjang</th>
		<th class='data'>Lembaga</th>
		<th class='data'>Jurusan</th>
		<th class='data'>Tahun</th>
		<th class='data'>No Ijasah</th>
		<th class='data' >Pilihan</th>
	</tr>";
	
	$r=mysql_query("SELECT A.*, B.kyw_nama,B.kyw_nik FROM tabel_pend_formal A, tbl_karyawan B WHERE A.NIP = B.kyw_nik ORDER BY
					B.kyw_nik DESC, A.id_pendidikan DESC");
	$no = 1;
	while($d=mysql_fetch_array($r)){
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data'>$d[kyw_nama]</td>
			<td class='data' align='center'>$d[jenjang]</td>
			<td class='data'>$d[lembaga]</td>
			<td class='data' align='center'>$d[jurusan]</td>
			<td class='data' align='center'>$d[tahun]</td>
			<td class='data'>$d[no_ijasah]</td>
			

			<td class='data' width='75px'>
			<center>
			<a href='index.php?m=$menu&s=edit&id=$d[id_pendidikan]' title='Edit'><img src='css/img/edit.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='modul/$menu/act_$menu.php?act=hapus&id=$d[id_pendidikan]' title='Delete' onclick=\"return confirm('Yakin hapus data ini..?')\"><img src='css/img/delete.png'></a>
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
	$re=mysql_query("SELECT * FROM tabel_pend_formal A, tbl_karyawan B WHERE A.NIP = b.kyw_nik AND id_pendidikan = '$id'");
	$de=mysql_fetch_array($re);
	echo "<h3>Edit Data Pendidikan</h3>
	<form name='form_pendidikan' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
		<tr><td width='180px'><b>Nama Pegawai</b></td><td><b>$de[kyw_nama]</b></td></tr>
		<tr><td width='180px'><b>ID Pendidikan</b></td><td><b>$de[id_pendidikan]</b>
														<input type='hidden' name='id_pendidikan' value='$de[id_pendidikan]'></td></tr>
		<tr><td><b>Jenjang</b></td><td><input type='text' name='jenjang' size='50' value=$de[jenjang]></td></tr>
		<tr><td><b>Lembaga</b></td><td><input type='text' name='lembaga' size='50' value=$de[lembaga]></td></tr>
		<tr><td><b>Jurusan</b></td><td><input type='text' name='jurusan' size='50' value=$de[jurusan]></td></tr>
		<tr><td><b>Tahun</b></td><td><input type='text' name='tahun' size='50' value=$de[tahun]></td></tr>
		<tr><td><b>Ijasah</b></td><td><input type='text' name='no_ijasah' size='50' value=$de[no_ijasah]></td></tr>
		
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