<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '1' || $user_level_kd == '4'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$tahun2 = isset($_GET['tahun2']) ? $_GET['tahun2'] : '';
$cari1 = isset($_POST['cari1']) ? htmlspecialchars($_POST['cari1'],ENT_QUOTES) : '';
$cari2 = isset($_POST['cari2']) ? htmlspecialchars($_POST['cari2'],ENT_QUOTES) : '';
$mkk = isset($_POST['mkk']) ? htmlspecialchars($_POST['mkk'],ENT_QUOTES) : '';



	
	
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
echo "<br>";
	echo "<h3 align='center'>.:: Tambah Data Jadwal Ujian ::.</h3>
	<br>
	<form name='form_mk' method='post'>
	<table>
			<tr><td width='180px'><b>TahunID</b></td><td width='5px'>:</td><td>
			$tanda</td></tr>
			<input type='hidden' name='tahun2' value='$tanda'></td></tr></td></tr>
			
		<tr><td><b>Mata Kuliah</b></td><td width='5px'>:</td><td>";
			$aa=mysql_query("SELECT * from mk where MKKode='$mkk' group by MKKode limit 1");
			while($ba=mysql_fetch_array($aa)){
			echo "<select name='mkk' id='mkk' width='75px'> <option value='$mkk'>$mkk-$ba[Nama]</option >";
			$namam=$ba[Nama];
			}
			$r=mysql_query("SELECT a.mkkode as MKKode,b.nama as Nama,b.nama_en FROM
(SELECT MKKode FROM jadwal WHERE tahunid='$tanda' GROUP BY mkkode)a LEFT JOIN
(SELECT * FROM mk WHERE na='N')b ON a.mkkode=b.mkkode order by a.mkkode");
			while($d=mysql_fetch_array($r)){
				echo "<option value='$d[MKKode]'>$d[MKKode]-$d[Nama]</option>";
			}
			echo "
			</select></td></tr>
			
	<tr><td></td><td></td><td align='left'><input type='submit' class='button' value='Pilih'> 
	</table>
	</form>
	<form name='form_jadwal' method='POST' action='Modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
	<table>
	
			<tr><td width='180px'><b>Mata Kuliah</b></td><td width='5px'>:</td><td>
			$mkk-$namam</td></tr>
			<input type='hidden' name='mk' value='$mkk'></td></tr></td></tr>
			<input type='hidden' name='tahun' value='$tanda'></td></tr></td></tr>
			
			
			<tr><td><b>Kelas</b></td><td width='5px'>:</td><td>";
			$hhh='ccc';
			$ggg='';
			$sd=mysql_query("SELECT kelasid FROM jadwal_ujian where tahunid='$tanda' AND mkkode='$mkk'");
			while($gd=mysql_fetch_array($sd)){
			$ggg=mysql_real_escape_string($gd['kelasid']);
			$hhh=$hhh."','".$ggg;
			}
			//echo"$hhh";
			echo "<select name='kelas' id='kelas' width='75px'>-Pilih Kelas-</option>";
			$s=mysql_query("SELECT * FROM jadwal WHERE tahunid='$tanda' AND mkkode='$mkk' and NamaKelas not in('$hhh') ORDER BY namakelas");
			while($g=mysql_fetch_array($s)){
				echo "<option value='$g[NamaKelas]'>$g[NamaKelas]</option>";
			}
			echo "
			</select></td></tr>
			
			<tr><td width='180px'><b>Judul</b></td><td width='5px'>:</td><td>
			<input type='text' name='judul' size='35' maxlength='25'></td></tr>
			
			<tr><td width='180px'><b>No Ujian</b></td><td width='5px'>:</td><td>
			<input type='text' name='noujian' size='15' maxlength='25'></td></tr>
			</td></tr>
			
			<tr><td><b>Tanggal Ujian</b></td><td width='5px'>:</td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_ujian' id='tgl_ujian' readonly='yes' onfocus=\"displayCalendar(document.form_jadwal.tgl_ujian,'dd-mm-yyyy',this)\"/> <img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_jadwal.tgl_ujian,'dd-mm-yyyy',this)\" title='Kalendar'/>
		</tr>
		
		<tr><td width='180px'><b>Pengawas</b></td><td width='5px'>:</td><td><input type='text' name='pengawas' size='20' maxlength='10'></td></tr>
		
		<tr><td><b>Username</b></td><td width='5px'>:</td><td><input type='text' name='uname' size='45' maxlength='50'></td></tr>
		
		<tr><td><b>Password</b></td><td width='5px'>:</td><td><input type='text' name='pass' size='30' maxlength='50'></td></tr>
		
		
		
		<tr><td><b>UTS/UAS</b></td><td>:</td><td>
		";
		echo "<input type='radio' name='jk' id='jk' value='T' checked='checked' /> UTS";
		echo "
		&nbsp;&nbsp;&nbsp;&nbsp; 
		";
		echo "<input type='radio' name='jk' id='jk' value='A' /> UAS";
		echo "
		&nbsp;&nbsp;&nbsp;&nbsp;
		</td></tr>
		
		
			
			<tr><td><b>Ruang</b></td><td width='5px'>:</td><td>";
			echo "<select name='ruang' id='ruang' width='75px'>-Pilih Ruang Ujian-</option>";
			$s=mysql_query("SELECT * FROM ruang WHERE na='N' ORDER BY ruangID");
			while($g=mysql_fetch_array($s)){
				echo "<option value='$g[RuangID]'>$g[RuangID]-$g[Nama]</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Jam Mulai</b></td><td width='5px'>:</td><td><input type='text' name='jammulai' size='25' maxlength='50'></td></tr>
		<tr><td><b>Jam Selesai</b></td><td width='5px'>:</td><td><input type='text' name='jamselesai' size='25' maxlength='50'></td></tr>
		<tr><td><b>Jumlah Soal</b></td><td width='5px'>:</td><td><input type='text' name='jsoal' size='25' maxlength='50'></td></tr>
			
			<tr><td><b>Tidak Aktif</b></td><td width='5px'>:</td><td>
			";
			echo "<input type='checkbox' name='aktif' value='N' />";
			echo "
			</td></tr>
		<tr><td></td><td></td><td align='center'><input type='submit' class='button' value='SIMPAN'> 
			<input type='button' class='button' value='KEMBALI' onclick=\"location.href='index.php?m=$menu&tahun=$tanda'\"></td></tr>
         </table>

	</form>
	
	";
break;



///////////////////////////////////////////// list ///////////////////////////////////////////
default:
echo "<h3 align='center'>.: List Of Mid Exam Schedule :.</h3>";

//if($status == '11') echo "<div class='sukses'>Simpan Data Berhasil</div>";
//elseif($status == '10') echo "<div class='gagal'>Simpan Data Gagal</div>";
//elseif($status == '21') echo "<div class='sukses'>Ubah Data Berhasil</div>";
//elseif($status == '20') echo "<div class='gagal'>Ubah Data Gagal</div>";
//elseif($status == '31') echo "<div class='sukses'>Hapus Data Berhasil</div>";
//elseif($status == '30') echo "<div class='gagal'>Hapus Data Gagal</div>";

echo "
<form name='cari' method='POST' action='index.php?m=listujianuts' enctype='multipart/form-data'>
";

echo"<table width=100%>";
echo "<tr><td width=15%>Chose Year Of Academic</td><td width='5px'>:</td><td width=15%>";

$sd=mysql_query("SELECT Nama from tahun where tahunid='$tanda'");
			while($gd=mysql_fetch_array($sd)){
			$glk=mysql_real_escape_string($gd['Nama']);
			}

echo"
<select onchange='this.form.submit()' name='cari1' id='cari1' width='75px'> <option value='$tanda'>$glk</option >";
			$sa=mysql_query("SELECT TahunID,Nama FROM tahun group by tahunid order by tahunid desc");
			while($ga=mysql_fetch_array($sa)){
				echo "<option value='$ga[TahunID]'>$ga[Nama]</option>";
			}
			echo "
			</select>

</td><td></td><td></td></tr>";
echo"<br><br>";


echo "<tr><td width=15%>Searching</td><td width='5px'>:</td><td width=15%><input type='text' name='cari2' value='$cari2' size='30' maxlength='25'></td><td><input type='submit' class='button' value='search'></td><td></td></tr>";
echo" <input type='hidden' name='cari3' value='$tanda'></td></tr>";


echo"
 <br></table>
 ";
 
echo "</form>
<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>Course Code</th>
		<th class='data'>Title</th>
		<th class='data'>Exam Number</th>
		<th class='data'>Date</th>
		<th class='data'>Inspector</th>
		<th class='data'>Start From</th>
		<th class='data'>Finish</th>
		<th class='data' >Options</th>
	</tr>";
	
	$r=mysql_query("SELECT * from jadwal_ujian where tahunid='$tanda' and status = 'N' and utsuas='T' order by tgl_ujian desc");
	$no = 1;
	while($d=mysql_fetch_array($r)){
	$tgls=format_tgl(($d['tgl_ujian']),'dd-mmmm-yyyy');
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[mkkode]</td>
			<td class='data'>$d[nama]</td>
			<td class='data'>$d[no_ujian]</td>
			<td class='data' align='center'>$tgls</td>
			<td class='data'>$d[pengawas]</td>
			<td class='data' align='center'>$d[jam_mulai]</td>
			<td class='data' align='center'>$d[jam_selesai]</td>
			

			<td class='data' width='75px'>
			<center>
			<a href='index.php?m=$menu&s=proses&id=$d[id_jujian]&tahun=$tanda' title='Proses'><img src='css/img/proses.png'></a>
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
	
break;

case 'proses';
	$id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
	echo "<h3 align='center'>List OF Mid Exam Member</h3>
	<br>
	
	<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>KRSID</th>
		<th class='data'>Student ID</th>
		<th class='data'>Name</th>
		<th class='data'>Course Code</th>
		<th class='data' >Option</th>
	</tr>";
	
	$r=mysql_query("SELECT a.id_ujian as id_ujian,a.krsid,a.id_jujian as id_jujian,a.mhswid as mhswid,b.Nama,a.st FROM
(SELECT * FROM master_ujian WHERE STATUS='A' AND utsuas='A' AND id_jujian='$id')a LEFT JOIN
(SELECT * FROM mhsw)b ON a.mhswid=b.mhswid ORDER BY a.mhswid");
	$no = 1;
	while($d=mysql_fetch_array($r)){
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[krsid]</td>
			<td class='data' align='center'>$d[mhswid]</td>
			<td class='data'>$d[Nama]</td>
			<td class='data' align='center'>$d[mkkode]</td>

			<td class='data' width='75px'>
			<center>";
			if(($d['st'])=='N'){
			echo"
			<a href='modul/$menu/act_$menu.php?act=aktif&id=$d[id_ujian]&idj=$d[id_jujian]&mh=$d[mhswid]' title='aktifkan' onclick=\"return confirm('Activated This Member..?')\"><img src='css/img/tdk.png'></a>";
			}else{
			echo"
			<a href='modul/$menu/act_$menu.php?act=nonaktif&id=$d[id_ujian]&idj=$d[id_jujian]&mh=$d[mhswid]' title='non aktifkan' onclick=\"return confirm('Deactivated This Member..?')\"><img src='css/img/aktif.png'></a>";
			}
			echo"
			
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>
";
break;

}

}
else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>