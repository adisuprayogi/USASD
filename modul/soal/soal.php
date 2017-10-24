<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '1' || $user_level_kd == '2' || $user_level_kd == '3'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$tahun2 = isset($_GET['tahun2']) ? $_GET['tahun2'] : '';
$cari1 = isset($_POST['cari1']) ? htmlspecialchars($_POST['cari1'],ENT_QUOTES) : '';
$cari2 = isset($_POST['cari2']) ? htmlspecialchars($_POST['cari2'],ENT_QUOTES) : '';
$mkk = isset($_POST['mkk']) ? htmlspecialchars($_POST['mkk'],ENT_QUOTES) : '';
$car = isset($_GET['car']) ? $_GET['car'] : '';
if (($cari2)=='') {
$car=$car;
}else{
$car=$cari2;
}	
	
if (($cari1)=='') {
	if (($tahun2)==''){
	$tanda= $tahun;
	}else{
	$tanda=$tahun2;
	}
}else{
$tanda= $cari1;
}


switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
	echo "<h3 Align='center'>Tambah Data Soal</h3>
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
$hal = isset($_GET['hal']) ? $_GET['hal'] : '';

if(($hal)==''){
$page = 1;
} else {
$page = $hal;
}

$max_results = 15;
$from=$page * $max_results - $max_results;
echo "<h3 align='center'>List Of Course For Final Exam</h3>";

echo"
<form name='cari' method='POST' action='index.php?m=soal' enctype='multipart/form-data'>
";

echo "Searching : <input type='text' name='cari2' value='$cari2' size='30' maxlength='25'>";
echo" <input type='hidden' name='cari1' value='$tanda'></td></tr>";

echo "
<input type='submit' class='button' value='search'>"; 
echo"
 <br>
 ";
 
echo "</form>

<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data' width='120px'>Course Code</th>
		<th class='data'>Course Name (Bahasa)</th>
		<th class='data'>Course Name</th>
		<th class='data' width='70px'>SKS</th>
	
		<th class='data'>Add Question</th>
	</tr>";
	
	$r=mysql_query("SELECT  MKKode,Nama,coalesce(Nama_en,Nama)as Nama_en,SKS from mk where NA='N' and mkkode <> '' and (mkkode like '%$car%' or Nama like '%$cari2%') group by mkkode order by prodiid,mkkode LIMIT $from, $max_results");
	$no = $from+1;
	while($d=mysql_fetch_array($r)){
	if (($d['Nama_en'])==""){
	$NE=$d['Nama'];
	}else{
	$NE=$d['Nama_en'];
	}
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[MKKode]</td>
			<td class='data'>$d[Nama]</td>
			<td class='data'>$NE</td>
			<td class='data' align='center'>$d[SKS]</td>
			

			<td class='data' width='100px' align='center'>
			<center>
			<a href='index.php?m=input$menu&s=default&kd=$d[MKKode]&nm=$d[Nama_en]' title='Edit'><img src='css/img/add.png'></a>
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>";
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM (select * from mk where NA='N' and mkkode <> '' and (mkkode like '%$car%' or Nama like '%$car%') group by mkkode)a"),0);
$total_pages = ceil($total_results / $max_results); 
echo "<center>Select a Page<br />";
if(($hal) > 1){
$prev = $page-1;
echo "<a href=index.php?m=$menu&hal=$prev&car=$car> <-Previous </a> ";
}

for($i = 1; $i <= $total_pages; $i++){
if(($hal) == $i){
echo "$i ";
} else {
echo "<a href=index.php?m=$menu&hal=$i&car=$car>$i</a> ";
}
} 
if($hal < $total_pages){
$next = $page + 1;
echo "<a href=index.php?m=$menu&hal=$next&car=$car>Next-></a>";
}
echo "</center>";
break;

///////////////////////////////////////////// edit ///////////////////////////////////////////
case 'edit':
	$id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
	$re=mysql_query("SELECT * FROM tabel_keluarga A, tbl_karyawan B WHERE A.NIP = b.kyw_nik AND id_keluarga = '$id'");
	$de=mysql_fetch_array($re);
	echo "<h3 Align='center>Edit Data soal</h3>
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