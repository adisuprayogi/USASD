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
	echo "<h3 align='center'>.:: Add Participant Test ::.</h3>
	<br>
	<table align='center'><tr><td>";
	echo"$status";
	
	echo"
	<form name='form_jadwal' method='POST' action='Modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
	<table>
	
			
			<tr><td width='180px'><b>Reg Number</b></td><td width='5px'>:</td><td>
			<input type='text' name='rn' size='35' maxlength='25'></td></tr>
			
			<tr><td width='180px'><b>Name</b></td><td width='5px'>:</td><td>
			<input type='text' name='nama' size='35' maxlength='25'></td></tr>
			</td></tr>
			
			";
			//<tr><td width='180px'><b>Place Of Birth</b></td><td width='5px'>:</td><td><input type='text' name='tempat' size='20' maxlength='30'></td></tr>
			
			//<tr><td><b>Date Of birth</b></td><td width='5px'>:</td><td><input class='text' type='text' maxlength='10' size='10' name='tgl_lahir' id='tgl_lahir' readonly='yes' onfocus=\"displayCalendar(document.form_jadwal.tgl_lahir,'dd-mm-yyyy',this)\"/> <img src='stuff/calendar/images/kalender.gif' style='vertical-align:middle;cursor:pointer;' width='18' height='14' onclick=\"displayCalendar(document.form_jadwal.tgl_lahir,'dd-mm-yyyy',this)\" title='Kalendar'/>
		//</tr>
		
	
		//<tr><td><b>Religion</b></td><td width='5px'>:</td><td>";
		//"	echo "<select name='agama' id='agama' width='75px'>-chose religion-</option>";
		//	$s=mysql_query("SELECT * FROM tbl_agama where status='A' order by id_agama");
		//	while($g=mysql_fetch_array($s)){
		//		echo "<option value='$g[agama]'>$g[agama]</option>";
		//	}
			//"echo "
			//</select></td></tr>
			
			//<tr><td><b>Gender</b></td><td width='5px'>:</td><td>";
			//"echo "<select name='jk' id='jk' width='75px'>-chose gender-</option>";
			//"	echo "<option value='Laki-laki'>Laki-laki</option>";
			//"	echo "<option value='Perempuani'>Perempuan</option>";
				
				
			echo "
			</select></td></tr>
		
	
		
		
			
			<tr><td><b>Scedule Test</b></td><td width='5px'>:</td><td>";
			echo "<select name='jadwal' id='jadwal' width='100px'>-Pilih Jadwal Ujian-</option>";
			$s=mysql_query("SELECT * FROM jadwal_ujian WHERE status='N' ORDER BY ruangID");
			while($g=mysql_fetch_array($s)){
			$tgls=format_tgl(($g['tgl_ujian']),'dd-mmmm-yyyy');
				echo "<option value='$g[id_jujian]'>$g[nama] - $g[no_ujian] - $tgls</option>";
			}
			echo "
			</select></td></tr>
			
			<tr><td width='180px'><b>Password</b></td><td width='5px'>:</td><td>
			<input type='text' name='pass' size='35' maxlength='25'></td></tr>
			</td></tr>
				
			</td></tr>
		<tr><td></td><td></td><td align='left'><input type='submit' class='button' value='Save'> 
			<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu&tahun=$tanda'\"></td></tr>
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

echo "<h3 align='center'>.: List Of Exam Member:.</h3>";

if($status == '11') echo "<div class='sukses'>Simpan Data Berhasil</div>";
elseif($status == '10') echo "<div class='gagal'>Simpan Data Gagal</div>";
elseif($status == '21') echo "<div class='sukses'>Ubah Data Berhasil</div>";
elseif($status == '20') echo "<div class='gagal'>Ubah Data Gagal</div>";
elseif($status == '31') echo "<div class='sukses'>Hapus Data Berhasil</div>";
elseif($status == '30') echo "<div class='gagal'>Hapus Data Gagal</div>";

echo "
<form name='cari' method='POST' action='index.php?m=daftarpeserta' enctype='multipart/form-data'>
";

echo"<table width=100%>";



echo "<tr><td width=15%>Searching </td><td width='5px'>:</td><td width=15%><input type='text' name='cari2' value='$car' size='30' maxlength='25'></td><td><input type='submit' class='button' value='search'></td><td><input type='button' class='button' value='Add Participant' style='float:right' 
 onclick=\"location.href='index.php?m=$menu&s=tambah'\"></td>
 <td><input type='button' class='button' value='Import' style='float:right' 
 onclick=\"location.href='index.php?m=$menu&s=import'\"></td>
 </tr>";


echo"
 </table>";



 
echo "</form>
<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>Reg Code</th>
		<th class='data'>Name</th>
		<th class='data'>Place Of birth</th>
		<th class='data'>Date Of birth</th>
		<th class='data'>Gender</th>
		<th class='data' >Options</th>
	</tr>";
	
	$r=mysql_query("
SELECT a.*,b.id_ujian FROM 
(SELECT * FROM tbl_cmb WHERE cmb_status IN ('A'))a INNER JOIN
(SELECT * FROM master_ujian WHERE ST<>'F' and status<>'D')b ON a.cmb_kd=b.mhswid where (a.cmb_kd like '%$car%' or a.cmb_nama like '%$car%') order by a.cmb_kd desc limit $from, $max_results");
	$no = $from+1;
	while($d=mysql_fetch_array($r)){
	$tgls=format_tgl(($d['cmb_tgllahir']),'dd-mmmm-yyyy');
	
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[cmb_kd]</td>
			<td class='data'>$d[cmb_nama]</td>
			<td class='data'>$d[cmb_tmptlahir]</td>
			<td class='data' align='center'>$tgls</td>
			<td class='data'>$d[cmb_jnskelamin]</td>
			

			<td class='data' width='75px'>
			<center>
			<a href='index.php?m=$menu&s=edit&id=$d[cmb_kd]&idu=$d[id_ujian]' title='Edit'><img src='css/img/edit.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='modul/$menu/act_$menu.php?act=hapus&id=$d[cmb_kd]&idu=$d[id_ujian]' title='Delete' onclick=\"return confirm('Yakin hapus data ini..?')\"><img src='css/img/delete.png'></a>
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>
";

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num from
(SELECT * FROM tbl_cmb WHERE cmb_status IN ('A'))a INNER JOIN
(SELECT * FROM master_ujian WHERE ST<>'F' and status<>'D')b ON a.cmb_kd=b.mhswid where (a.cmb_kd like '%$car%' or a.cmb_nama like '%$car%')"),0);
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
	$idu = isset($_GET['idu']) ? htmlentities($_GET['idu'],ENT_QUOTES) : '';
	$re=mysql_query("SELECT a.*,c.nama,c.no_ujian,c.tgl_ujian,b.id_ujian FROM (select * from tbl_cmb where cmb_kd = '$id')a inner join (select * from master_ujian where id_ujian='$idu')b on a.cmb_kd=b.mhswid left join
	(select * from jadwal_ujian)c on b.id_jujian=c.id_jujian");
	$de=mysql_fetch_array($re);
	$tgla=format_tgl(($de['tgl_ujian']),'dd-mmmm-yyyy');
	echo "<h3 align='center'>Edit Exam Schedule</h3>
	<br>
	
	<form name='form_jadwal' method='POST' action='Modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
	
			
			<tr><td width='180px'><b>Reg Number</b></td><td width='5px'>:</td><td>
			<input type='text' name='rn' value='$de[cmb_kd]' size='35' maxlength='25'>
			<input type='hidden' name='idj' value='$de[cmb_kd]' size='35' maxlength='25'>
			<input type='hidden' name='idju' value='$de[id_jujian]' size='35' maxlength='25'>
			<input type='hidden' name='idu' value='$de[id_ujian]' size='35' maxlength='25'>
			</td></tr>
			
			<tr><td width='180px'><b>Name</b></td><td width='5px'>:</td><td>
			<input type='text' name='nama' value='$de[cmb_nama]'  size='35' maxlength='25'></td></tr>
			</td></tr>
		
			
			<tr><td><b>Scedule Test</b></td><td width='5px'>:</td><td>";
			echo "<select name='jadwal' id='jadwal' width='100px'><option value='$de[id_jujian]'>$de[nama] - $de[no_ujian] - $tgla</option>";
			$s=mysql_query("SELECT * FROM jadwal_ujian WHERE status='N' ORDER BY ruangID");
			while($g=mysql_fetch_array($s)){
			$tgls=format_tgl(($g['tgl_ujian']),'dd-mmmm-yyyy');
				echo "<option value='$g[id_jujian]'>$g[nama] - $g[no_ujian] - $tgls</option>";
			}
			echo "
			</select></td></tr>
			
			<tr><td width='180px'><b>Password</b></td><td width='5px'>:</td><td>
			<input type='text' name='pass' size='35' maxlength='25'></td></tr>
			</td></tr>
				
			</td></tr>
		<tr><td></td><td width='5px'></td><td align='left'><input type='submit' class='button' value='Save'> 
			<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu&tahun=$tanda'\"></td></tr>
         </table>
		 </td></tr>
		 </table>

	</form>
	
	";
break;

case 'import':
echo"
<h1>Import Data Peserta</h1>
<form name='form_jadwal' method='POST' action='Modul/$menu/act_$menu.php?act=import' enctype='multipart/form-data'>
<tr><td><b>Scedule Test</b></td><td width='5px'>:</td><td>";
			echo "<select name='jadwal' id='jadwal' width='100px'>-Pilih Jadwal Ujian-</option>";
			$s=mysql_query("SELECT * FROM jadwal_ujian WHERE status='N' ORDER BY ruangID");
			while($g=mysql_fetch_array($s)){
			$tgls=format_tgl(($g['tgl_ujian']),'dd-mmmm-yyyy');
				echo "<option value='$g[id_jujian]'>$g[nama] - $g[no_ujian] - $tgls</option>";
			}
			echo "
			</select></td></tr>
Silakan Pilih File Excel: <input name='userfile' type='file'>
<input name='upload' type='submit' value='Import'>
</form>";
break;
}

}
else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>