<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
if($user_level_kd == '21' || $user_level_kd == '23'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
$cari2 = isset($_POST['cari2']) ? htmlspecialchars($_POST['cari2'],ENT_QUOTES) : '';
$mkk = isset($_POST['mkk']) ? htmlspecialchars($_POST['mkk'],ENT_QUOTES) : '';
$car = isset($_GET['car']) ? $_GET['car'] : '';
$tan = isset($_GET['tan']) ? $_GET['tan'] : '';
if (($cari2)=='') {
$car=$car;
}else{
$car=$cari2;
}	
	



switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
echo "<br>";
	echo "<h3 align='center'>.:: Add Test Scedule ::.</h3>
	<br>
	<form name='form_mk' method='post'>
	<table align='center'><tr><td>
	</form>
	<form name='form_jadwal' method='POST' action='Modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
	<table>
	
			<tr><td width='180px'><b>Course</b></td><td width='5px'>:</td><td>
			Kompentensi Akuntansi</td></tr>
			<input type='hidden' name='mk' value='USASD'></td></tr></td></tr>
			
			<tr><td width='180px'><b>Title</b></td><td width='5px'>:</td><td>
			<input type='text' name='judul' size='35' maxlength='25'></td></tr>
			
			<tr><td width='180px'><b>Test Number</b></td><td width='5px'>:</td><td>
			<input type='text' name='noujian' size='15' maxlength='25'></td></tr>
			</td></tr>
			
			<tr><td><b>Date Of Exam</b></td><td width='5px'>:</td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_ujian' id='tgl_ujian' readonly='yes' onfocus=\"displayCalendar(document.form_jadwal.tgl_ujian,'dd-mm-yyyy',this)\"/> <img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_jadwal.tgl_ujian,'dd-mm-yyyy',this)\" title='Kalendar'/>
		</tr>
		
		<tr><td width='180px'><b>Inspector</b></td><td width='5px'>:</td><td><input type='text' name='pengawas' size='20' maxlength='30'></td></tr>
		
		
		
	
		
		
			
			<tr><td><b>Room</b></td><td width='5px'>:</td><td>";
			echo "<select name='ruang' id='ruang' width='75px'>-Pilih Ruang Ujian-</option>";
			$s=mysql_query("SELECT * FROM ruang WHERE na='N' ORDER BY ruangID");
			while($g=mysql_fetch_array($s)){
				echo "<option value='$g[RuangID]'>$g[RuangID]-$g[Nama]</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Time Start</b></td><td width='5px'>:</td><td><input type='text' name='jammulai' size='25' maxlength='50'></td></tr>
		<tr><td><b>Time Finish</b></td><td width='5px'>:</td><td><input type='text' name='jamselesai' size='25' maxlength='50'></td></tr>
		";//<tr><td><b>Question Count</b></td><td width='5px'>:</td><td><input type='text' name='jsoal' size='10' maxlength='20'></td></tr>
		
		
		//<tr><td><b>Grade 1</b></td><td width='5px'>:</td><td><input type='text' name='b1' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 2</b></td><td width='5px'>:</td><td><input type='text' name='b2' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 3</b></td><td width='5px'>:</td><td><input type='text' name='b3' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 4</b></td><td width='5px'>:</td><td><input type='text' name='b4' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 5</b></td><td width='5px'>:</td><td><input type='text' name='b5' size='10' maxlength='20'></td></tr>
		
		//"echo"
		//<tr><td><b>Matematika</b></td><td width='5px'>:</td><td><input type='text' name='mat' size='10' maxlength='20'></td></tr>
		//<tr><td><b>English</b></td><td width='5px'>:</td><td><input type='text' name='eng' size='10' maxlength='20'></td></tr>
		//<tr><td><b>PAI</b></td><td width='5px'>:</td><td><input type='text' name='pai' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Umum</b></td><td width='5px'>:</td><td><input type='text' name='pmu' size='10' maxlength='20'></td></tr>
		echo"	
			</td></tr>
		<tr><td></td><td></td><td align='center'><input type='submit' class='button' value='Save'> 
			<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
         </table>
		 </td></tr>
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

$max_results = 10;
$from=$page * $max_results - $max_results;

echo "<h3 align='center'>.: List Of Exam Schedule:.</h3>";

//if($status == '11') echo "<div class='sukses'>Simpan Data Berhasil</div>";
//elseif($status == '10') echo "<div class='gagal'>Simpan Data Gagal</div>";
//elseif($status == '21') echo "<div class='sukses'>Ubah Data Berhasil</div>";
//elseif($status == '20') echo "<div class='gagal'>Ubah Data Gagal</div>";
//elseif($status == '31') echo "<div class='sukses'>Hapus Data Berhasil</div>";
//elseif($status == '30') echo "<div class='gagal'>Hapus Data Gagal</div>";

echo "
<form name='cari' method='POST' action='index.php?m=jadwal' enctype='multipart/form-data'>
";

echo"<table width=100%>";



echo "<tr><td width=15%>Searching </td><td width='5px'>:</td><td width=15%><input type='text' name='cari2' value='$car' size='30' maxlength='25'></td><td><input type='submit' class='button' value='search'></td><td><input type='button' class='button' value='Add Schedule' style='float:right' 
 onclick=\"location.href='index.php?m=$menu&s=tambah'\"></td></tr>";


echo"
 </table>";



 
echo "</form>
<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>Course Code</th>
		<th class='data'>Title</th>
		<th class='data'>Exam Number</th>
		<th class='data'>Date</th>
		<th class='data'>Time</th>
		<th class='data'>Mid/Fin</th>
		<th class='data'>Ispector</th>
		<th class='data'>Questions Count</th>
		<th class='data' >Options</th>
	</tr>";
	
	$r=mysql_query("SELECT * from jadwal_ujian where status in ('Y','N')  and (mkkode like '%$car%' or nama like '%$car%' or no_ujian like '%$car%' or pengawas like '%$car%') order by tgl_ujian desc limit $from, $max_results");
	$no = $from+1;
	while($d=mysql_fetch_array($r)){
	$tgls=format_tgl(($d['tgl_ujian']),'dd-mmmm-yyyy');
	if (($d['utsuas'])=='A'){
	$gaga='UAS';
	}else{
	$gaga='UTS';
	}
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[mkkode]</td>
			<td class='data'>$d[nama]</td>
			<td class='data'>$d[no_ujian]</td>
			<td class='data' align='center'>$tgls</td>
			<td class='data' align='center'>$d[jam_mulai] - $d[jam_selesai]</td>
			<td class='data' align='center'>$gaga</td>
			<td class='data'>$d[pengawas]</td>
			<td class='data' align='right'>$d[jsoal]</td>
			

			<td class='data' width='75px'>
			<center>
			<a href='index.php?m=$menu&s=edit&id=$d[id_jujian]' title='Edit'><img src='css/img/edit.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='modul/$menu/act_$menu.php?act=hapus&id=$d[id_jujian]' title='Delete' onclick=\"return confirm('Yakin hapus data ini..?')\"><img src='css/img/delete.png'></a>
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>
";

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num from jadwal_ujian where status in ('Y','N')  and (mkkode like '%$car%' or nama like '%$car%' or no_ujian like '%$car%' or pengawas like '%$car%')"),0);
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
	$re=mysql_query("SELECT * FROM jadwal_ujian where id_jujian = '$id'");
	$de=mysql_fetch_array($re);
	echo "<h3 align='center'>Edit Exam Schedule</h3>
	<br>
	
	<form name='form_jadwal' method='POST' action='Modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table align='center'><tr><td>
	<table>
			<tr><td width='180px'><b>Course</b></td><td width='5px'>:</td><td>
			$de[mkkode]</td></tr>
			<input type='hidden' name='id' value='$id'></td></tr></td></tr>
			<input type='hidden' name='mk' value='PMB1'></td></tr></td></tr>
			
			<tr><td width='180px'><b>Title</b></td><td width='5px'>:</td><td>
			<input type='text' name='judul' value='$de[nama]' size='35' maxlength='25'></td></tr>
			
			<tr><td width='180px'><b>Test Number</b></td><td width='5px'>:</td><td>
			<input type='text' name='noujian' value='$de[no_ujian]' size='15' maxlength='25'></td></tr>
			</td></tr>
			
			<tr><td><b>Date Of Exam</b></td><td width='5px'>:</td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_ujian' id='tgl_ujian' value='".format_tgl($de['tgl_ujian'],'dd-mm-yyyy')."' readonly='yes' onfocus=\"displayCalendar(document.form_jadwal.tgl_ujian,'dd-mm-yyyy',this)\"/> <img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_jadwal.tgl_ujian,'dd-mm-yyyy',this)\" title='Kalendar'/>
		</tr>
		
		<tr><td width='180px'><b>Inspector</b></td><td width='5px'>:</td><td><input type='text' name='pengawas' value='$de[pengawas]' size='20' maxlength='30'></td></tr>
		
			
			
			<tr><td><b>Room</b></td><td width='5px'>:</td><td>";
			
			$a=mysql_query("SELECT * from ruang where RuangID='$de[ruangid]' group by ruangid limit 1");
			while($b=mysql_fetch_array($a)){
			echo "<select name='ruang' id='ruang' width='75px'> <option value='$de[ruangid]'>$de[ruangid]-$b[Nama]</option >";
			}
			$s=mysql_query("SELECT * FROM ruang WHERE na='N' ORDER BY ruangID");
			while($g=mysql_fetch_array($s)){
				echo "<option value='$g[RuangID]'>$g[RuangID]-$g[Nama]</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Time Start</b></td><td width='5px'>:</td><td><input type='text' name='jammulai' value='$de[jam_mulai]' size='25' maxlength='50'></td></tr>
		<tr><td><b>Time Finish</b></td><td width='5px'>:</td><td><input type='text' name='jamselesai' value='$de[jam_selesai]' size='25' maxlength='50'></td></tr>";
		//<tr><td><b>Question Count</b></td><td width='5px'>:</td><td><input type='text' name='jsoal' value='$de[jsoal]' size='25' maxlength='50'></td></tr>
		//<tr><td><b>Grade 1</b></td><td width='5px'>:</td><td><input type='text' name='b1' value='$de[b1]' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 2</b></td><td width='5px'>:</td><td><input type='text' name='b2' value='$de[b2]' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 3</b></td><td width='5px'>:</td><td><input type='text' name='b3' value='$de[b3]' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 4</b></td><td width='5px'>:</td><td><input type='text' name='b4' value='$de[b4]' size='10' maxlength='20'></td></tr>
		//<tr><td><b>Grade 5</b></td><td width='5px'>:</td><td><input type='text' name='b5' value='$de[b5]' size='10' maxlength='20'></td></tr
			
		echo"
			</td></tr>
		<tr><td></td><td width='5px'></td><td align='left'><input type='submit' class='button' value='Save'> 
			<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu'\"></td></tr>
         </table>
		 </td></tr>
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