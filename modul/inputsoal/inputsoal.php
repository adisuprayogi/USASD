<?php

$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';
$user_id = isset($_SESSION['user_kd']) ? $_SESSION['user_kd'] : '';

if($user_level_kd == '21' || $user_level_kd == '22' || $user_level_kd == '23'){

$status = isset($_GET['status']) ? $_GET['status'] : '';
$mkkode = isset($_GET['kd']) ? $_GET['kd'] : 'SASD';
$nm = isset($_GET['nm']) ? $_GET['nm'] : 'Sertifikasi Akuntansi Syariah Dasar';
$cari2 = isset($_POST['cari2']) ? htmlspecialchars($_POST['cari2'],ENT_QUOTES) : '';
$car = isset($_GET['car']) ? $_GET['car'] : '';
if (($cari2)=='') {
$car=$car;
}else{
$car=$cari2;
}	

switch($submenu){
///////////////////////////////////////////// tambah ///////////////////////////////////////////
case 'tambah':
//<tr><td width='180px'><b>Pegawai</b></td><td>
//<select name='kyw_nik'><option value=''>-Pilih-</option>";
			//$r=mysql_query("SELECT * FROM tbl_karyawan ORDER BY kyw_nik DESC");
			//while($d=mysql_fetch_array($r)){
			//	echo "<option value='$d[kyw_nik]'>$d[kyw_nama]</option>";
			//}
			//echo "
			//</select>
				//</td></tr>
	echo "<h3>Add Questions Database For $nm</h3>
	<form name='form_soal' method='POST' action='modul/$menu/act_$menu.php?act=simpan' enctype='multipart/form-data'>
	<table>
		
			
		<tr><td><b>Course Code</b></td><td>$mkkode <input type='hidden' name='mkkode' value='$mkkode'>
		<input type='hidden' name='nm' value='$nm'> </td></tr>
		<input type='hidden' name='user_id' value='$user_id'> </td></tr>
		
		<tr><td><b>Course</b></td><td>$nm</td></tr>
		
		

		
		<tr><td width='180px'><b>Category</b></td><td>
		<select name='judul'><option value=''>-Pilih-</option>";
		
			echo "<option value='SAK'>Sejarah Anuntansi</option>";
			echo "<option value='RAESII'>RAESII</option>";
			echo "<option value='FMUI'>Fatwa MUI</option>";
			echo "<option value='KDPPLKS'>KDPPLKS</option>";
			echo "<option value='PSAK101'>PSAK 101</option>";
			echo "<option value='PSAK102'>PSAK 102</option>";
			echo "<option value='PSAK103'>PSAK 103</option>";
			echo "<option value='PSAK104'>PSAK 104</option>";
			echo "<option value='PSAK105'>PSAK 105</option>";
			echo "<option value='PSAK106'>PSAK 106</option>";
			echo "<option value='PSAK107'>PSAK 107</option>";
			echo "<option value='PSAK108'>PSAK 108</option>";
			echo "<option value='PSAK109'>PSAK 109</option>";
			echo "<option value='PSAK110'>PSAK 110</option>";
			
			echo "
			</select>
			</td></tr>
		
		
		<tr><td width='180px'><b>Grade</b></td><td>
		<select name='bobot'><option value=''>-Pilih-</option>";
			$r=mysql_query("SELECT * FROM bobot ORDER BY bobot");
			while($d=mysql_fetch_array($r)){
			echo "<option value='$d[bobot]'>$d[bobot]</option>";
			}
			echo "
			</select>
			</td></tr>
	
		<tr><td><b>Question</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='soal'></textarea></td></tr>	
		
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center><b>Answer</b></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		
		<tr><td><b>Answer (A)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='ja'></textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sa'><option value=''></option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>
		
		<tr><td><b>Answer (B)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='jb'></textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sb'><option value=''></option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Answer (C)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='jc'></textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sc'><option value=''></option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Answer (D)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='jd'></textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sd'><option value=''></option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>";
			
		//<tr><td><b>Answer (E)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='je'></textarea></td></tr>
			//<tr><td><b>Status</b></td><td><select name='se'><option value=''></option>";
			//{
				//<option value=B>True</option>";
				//<option value=S>False</option>";
			//}
			//
			//</select></td></tr>
		
			
			
	
		echo"
		<tr><td></td><td><input type='submit' class='button' value='Save'> 
			<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu&kd=$mkkode&nm=$nm'\"></td></tr>
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

$max_results = 50;
$from=$page * $max_results - $max_results;

echo "<h3 align='center'>Question List Of $nm</h3>";

if($status == '11') echo "<div class='sukses'>Save Succesful.</div>";
elseif($status == '10') echo "<div class='gagal'>Save Failed</div>";
elseif($status == '21') echo "<div class='sukses'>Change Succesful</div>";
elseif($status == '20') echo "<div class='gagal'>Change Failed</div>";
elseif($status == '31') echo "<div class='sukses'>Deleted</div>";
elseif($status == '30') echo "<div class='gagal'>Delete Failed</div>";

echo "

<form name='cari' method='POST' action='index.php?m=$menu&s=default&kd=$mkkode&car=$car&nm=$nm' enctype='multipart/form-data'>
<table width='100%'><tr><td>
";

echo "Searching : <input type='text' name='cari2' value='$car' size='30' maxlength='25'>";
echo "
<input type='submit' class='button' value='search'>"; 
echo"

 
</td><td align='right'>

<input type='button' class='button' value='Add Question' style='float:right' 
 onclick=\"location.href='index.php?m=$menu&s=tambah&kd=$mkkode&nm=$nm'\">
 </td></tr>
 </table>
 ";
 
echo "</form>
 
<div class='clear'></div>
<table class='data'>
	<tr class='data'>
		<th class='data' width='30px'>No</th>
		<th class='data'>ID</th>
		<th class='data'>Code</th>
		<th class='data'>Title</th>
		<th class='data'>Grade</th>
		<th class='data'>NA</th>
		<th class='data'>Date of Update</th>
		<th class='data'>Update By</th>
		<th class='data' >Options</th>
	</tr>";
	
	
	$r=mysql_query("SELECT a.id_soal,a.Mkkode,a.Judul,a.bobot,a.status,a.tgl_edit,b.kyw_nama from 
	(select * from soal where mkkode='$mkkode' and status='A' and utsuas='A' and(id_soal like '%$car%' or judul like '%$car%' or bobot like '%$car') order by tgl_edit desc LIMIT $from, $max_results)a left join
	(select * from tbl_karyawan)b on a.upd=b.kyw_nik");
	$no = $from+1;
	while($d=mysql_fetch_array($r)){
		echo"	
		<tr class='data'>
			<td class='data' width='30px' align='right'>$no</td>
			<td class='data' align='center'>$d[id_soal]</td>
			<td class='data' align='center'>$d[Mkkode]</td>
			<td class='data' align='center'>$d[Judul]</td>
			<td class='data' align='center'>$d[bobot]</td>
			<td class='data' align='center'>$d[status]</td>
			<td class='data' align='center'>$d[tgl_edit]</td>
			<td class='data' align='center'>$d[kyw_nama]</td>

			<td class='data' width='95px'>
			<center>
			<a href='index.php?m=viewsoal&s=edit&id=$d[id_soal]&mn=inputsoal&kd=$mkkode&nm=$nm' title='View'><img src='css/img/detail.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='index.php?m=$menu&s=edit&id=$d[id_soal]' title='Edit'><img src='css/img/edit.png'></a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='modul/$menu/act_$menu.php?act=hapus&id=$d[id_soal]&mkkode=$mkkode&nm=$nm' title='Delete' onclick=\"return confirm('Yakin hapus data ini..?')\"><img src='css/img/delete.png'></a>
			</center>
			</td>
		</tr>";
		$no++;
	}
	
	echo "	
</table>";
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num from soal where mkkode='$mkkode' and status='A' and utsuas='A'  and(judul like '%$car%' or bobot like '%$car')order by tgl_edit desc"),0);
$total_pages = ceil($total_results / $max_results); 
echo "<center>Select a Page<br />";
if(($hal) > 1){
$prev = $page-1;
echo "<a href=index.php?m=$menu&s=default&kd=$mkkode&hal=$prev&car=$car&nm=$nm><font color='#8f0303'> <-Previous </a> ";
}

for($i = 1; $i <= $total_pages; $i++){
if(($hal) == $i){
echo "<font color='#070606'>$i ";
} else {
echo "<a href=index.php?m=$menu&s=default&kd=$mkkode&hal=$i&car=$car&nm=$nm><font color='#8f0303'>$i</a> ";
}
} 
if($hal < $total_pages){
$next = $page + 1;
echo "<a href=index.php?m=$menu&s=default&kd=$mkkode&hal=$next&car=$car&nm=$nm><font color='#8f0303'>Next-></a>";
}
echo "</center>
";
break;

///////////////////////////////////////////// edit ///////////////////////////////////////////
case 'edit':
	$id = isset($_GET['id']) ? htmlentities($_GET['id'],ENT_QUOTES) : '';
	$re=mysql_query("SELECT * FROM soal where id_soal = '$id'");
	$de=mysql_fetch_array($re);
	echo "<h3>Edit Question Database For $nm</h3>
	<form name='form_soal' method='POST' action='modul/$menu/act_$menu.php?act=update' enctype='multipart/form-data'>
	<table>
		
			
		<tr><td><b>Course Code</b></td><td>$de[Mkkode]<input type='hidden' name='mkkode' value='$de[Mkkode]'>
		<input type='hidden' name='nm' value='PMB Test'> </td></tr>
		<input type='hidden' name='ids' value='$de[id_soal]'> </td></tr>
		<input type='hidden' name='user_id' value='$user_id'> </td></tr>
		
		<tr><td><b>Course</b></td><td>PMB Test</td></tr>
		
		
		<tr><td><b>Title</b></td><td><input type='text' name='judul' value='$de[Judul]' ></td></tr>
		
		<tr><td width='180px'><b>Category</b></td><td>
		<select name='judul'><option value='$de[Judul]'>$de[Judul]</option>";
			echo "<option value='MAT'>MATEMATIKA</option>";
			echo "<option value='ENG'>ENGLISH</option>";
			echo "<option value='PAI'>PAI</option>";
			echo "<option value='PMU'>UMUM</option>";
			echo "
			</select>
			</td></tr>
		
		<tr><td width='180px'><b>Grade</b></td><td>
		<select name='bobot'><option value='$de[bobot]'>$de[bobot]</option>";
			$r=mysql_query("SELECT * FROM bobot ORDER BY bobot");
			while($d=mysql_fetch_array($r)){
			echo "<option value='$d[bobot]'>$d[bobot]</option>";
			}
			echo "
			</select>
			</td></tr>
	
		<tr><td><b>Question</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='soal' value='$de[soal]'>$de[soal]</textarea></td></tr>	
		
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center><b>Answer</b></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		<tr><td colspan=2 align=center></td></tr>
		
		<tr><td><b>Answer (A)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='ja' value='$de[ja]'>$de[ja]</textarea></td></tr>
		"; 
		if (($de['sa'])=='S') {$sa='False';}else{$sa='True';}
		if (($de['sb'])=='S') {$sb='False';}else{$sb='True';}
		if (($de['sc'])=='S') {$sc='False';}else{$sc='True';}
		if (($de['sd'])=='S') {$sd='False';}else{$sd='True';}
		if (($de['se'])=='S') {$se='False';}else{$se='True';}
		echo"
			<tr><td><b>Status</b></td><td><select name='sa'><option value='$de[sa]'>$sa</option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>
		
		<tr><td><b>Answer (B)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='jb' value='$de[jb]'>$de[jb]</textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sb'><option value='$de[sb]'>$sb</option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Answer (C)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='jc' value='$de[jc]'>$de[jc]</textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sc'><option value='$de[sc]'>$sc</option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>
			
		<tr><td><b>Answer (D)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='jd' value='$de[jd]'>$de[jd]</textarea></td></tr>
			<tr><td><b>Status</b></td><td><select name='sd'><option value='$de[sd]'>$sd</option>";
			{
				echo "<option value=B>True</option>";
				echo "<option value=S>False</option>";
			}
			echo "
			</select></td></tr>";
			
	//	<tr><td><b>Answer (E)</b></td><td><textarea class='ckeditor' cols='10' rows='40' name='je' value='$de[je]'>$de[je]</textarea></td></tr>
		//	<tr><td><b>Status</b></td><td><select name='se'><option value='$de[se]'>$se</option>";
		//	{
				//<option value=B>True</option>";
				//<option value=S>False</option>";
		//	}
			//
			//</select></td></tr>
		
			
			
	echo"
		
		<tr><td></td><td><input type='submit' class='button' value='Save'> 
			<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu&kd=$mkkode&nm=$nm'\"></td></tr>
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