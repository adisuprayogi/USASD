<?php
$menu = 'kerjasoal';
$act = isset($_POST['act']) ? htmlspecialchars($_POST['act'],ENT_QUOTES) : 'utama';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':
	$id = isset($_POST['id']) ? htmlspecialchars($_POST['id'],ENT_QUOTES) : '';
	$idj = isset($_POST['idj']) ? htmlspecialchars($_POST['idj'],ENT_QUOTES) : '';
	$mh = isset($_POST['mh']) ? htmlspecialchars($_POST['mh'],ENT_QUOTES) : '';
	$ur = isset($_POST['ur']) ? htmlspecialchars($_POST['ur'],ENT_QUOTES) : '';
	$idso = isset($_POST['idso']) ? htmlspecialchars($_POST['idso'],ENT_QUOTES) : '';
	$ids = isset($_POST['idso']) ? htmlspecialchars($_POST['ids'],ENT_QUOTES) : '';
	$check1 = isset($_POST['check1']) ? htmlspecialchars($_POST['check1'],ENT_QUOTES) : 'S';
	$check2 = isset($_POST['check2']) ? htmlspecialchars($_POST['check2'],ENT_QUOTES) : 'S';
	$check3 = isset($_POST['check3']) ? htmlspecialchars($_POST['check3'],ENT_QUOTES) : 'S';
	$check4 = isset($_POST['check4']) ? htmlspecialchars($_POST['check4'],ENT_QUOTES) : 'S';
	$check5 = isset($_POST['check5']) ? htmlspecialchars($_POST['check5'],ENT_QUOTES) : 'S';
	$urn=$ur+1;
	
	
	
	
	if(empty($id) || empty($idj) || empty($ur) || empty($idso) || empty($check1) || empty($check2) || empty($check3) || empty($check4) || empty($check5)){
		echo "<script>alert('Jawaban Tidak Bisa Diproses');history.back();</script>";
	}
	else{
	$q=mysql_query("select * from soal where id_soal='$ids'");
	while($r=mysql_fetch_array($q)){
	$sa=$r['sa'];
	$sb=$r['sb'];
	$sc=$r['sc'];
	$sd=$r['sd'];
	$se=$r['se'];
	$bbt=$r['bobot'];
	}
	
	if ($sa==$check1 && $sb==$check2 && $sc==$check3 && $sd==$check4 && $se==$check5){
	$jss='B';
	}else{
	$jss='S';
	}
		$insert=mysql_query("update soal_mhsw set ja='$check1',jb='$check2',jc='$check3',jd='$check4',je='$check5',SJ='F',jawaban='$jss',bobot='$bbt' where id_soalm='$idso'");
		if($insert){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=index.php?m=$menu&id=$id&idj=$idj&ur=$urn'/>";
	}
break;

case 'final':
$menu = 'daftarujianuts';
	$id = isset($_POST['id']) ? htmlspecialchars($_POST['id'],ENT_QUOTES) : '';
	$idj = isset($_POST['idj']) ? htmlspecialchars($_POST['idj'],ENT_QUOTES) : '';
	$mh = isset($_POST['mh']) ? htmlspecialchars($_POST['mh'],ENT_QUOTES) : '';
	$ur = isset($_POST['ur']) ? htmlspecialchars($_POST['ur'],ENT_QUOTES) : '';
	$idso = isset($_POST['idso']) ? htmlspecialchars($_POST['idso'],ENT_QUOTES) : '';
	
	
	if(empty($id) || empty($idj)){
		echo "<script>alert('Jawaban Tidak Bisa Diproses');history.back();</script>";
	}
	else{
	$q=mysql_query("SELECT id_ujian,COALESCE(SUM(bobot),0) AS bobot FROM soal_mhsw WHERE id_ujian='255' AND sj='F' AND jawaban='B'");
	while($r=mysql_fetch_array($q)){
	$bobot=$r['bobot'];
	}
	$q1=mysql_query("SELECT id_ujian,coalesce(SUM(bobot),0) AS jml FROM soal_mhsw WHERE id_ujian='$id'");
	while($r1=mysql_fetch_array($q1)){
	$jml=$r1['jml'];
	}
	$Nilai=($bobot/$jml)*100;
	
		$insert=mysql_query("update master_ujian set Nilai='$Nilai',NilaiT='$Nilai',ST='F' where id_ujian='$id'");
		
		$insert2=mysql_query("update soal_mhsw set status='F' where id_ujian='$id'");
		
		if($insert and $insert2){
		echo"<table width='100%'>
			<tr><td></td><td width='30%' align='center'>";
			echo"
			<table class='data'><tr><td class='data' align='center'>
			Ujian Selesai
			</td></tr>
			<tr><td class='data' align='center'>Nilai Anda adalah</td></tr>
			<tr><td class='data' align='center'><b>$Nilai</b></td></tr> </table>";
			echo"<br>
			<input type='button' class='button' value='End' style='float:center' onclick=\"location.href='index.php?m=$menu'\">";
 
			echo"</td><td></td>
			</table>";
		}
		else{
			echo"Gagal";
		}
		//echo "<meta http-equiv='Refresh' content='0; URL=index.php?m=$menu&id=$id&idj=$idj&ur=$urn'/>";
	}
	
	
break;

////////////// lainnya /////////////
case 'utama':

	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$idj = isset($_GET['idj']) ? htmlspecialchars($_GET['idj'],ENT_QUOTES) : '';
	$mh = isset($_GET['mh']) ? htmlspecialchars($_GET['mh'],ENT_QUOTES) : '';
	$krs = isset($_GET['k']) ? htmlspecialchars($_GET['k'],ENT_QUOTES) : '';
	$ur = isset($_GET['ur']) ? htmlspecialchars($_GET['ur'],ENT_QUOTES) : '';

echo "
<div class='clear'></div>
<table class='data'><tr class='data'><td class='data' width='97px'>";
$q1=mysql_query("select count(id_soalm) as idc from soal_mhsw where id_ujian='$id'");
while($r1=mysql_fetch_array($q1)){
$urf=$r1['idc'];
}
if ($ur>$urf){
$ur=1;
}

$query1=mysql_query("select * from soal_mhsw where id_ujian='$id' order by no_urut");
while($row1=mysql_fetch_array($query1)){

if (($row1['no_urut'])==$ur){
echo"<a href='index.php?m=kerjasoal&id=$id&idj=$idj&ur=$row1[no_urut]' title='Soal No $row1[no_urut]'><img src='css/img/pro.png'></a>&nbsp";
}else{
if(($row1['sj'])=="W"){
echo"<a href='index.php?m=kerjasoal&id=$id&idj=$idj&ur=$row1[no_urut]' title='Soal No $row1[no_urut]'><img src='css/img/belum.png'></a>&nbsp";
}else{
echo"<a href='index.php?m=kerjasoal&id=$id&idj=$idj&ur=$row1[no_urut]' title='Soal No $row1[no_urut]'><img src='css/img/sudah.png'></a>&nbsp";
}
}
}
echo"
</td>
<td class='data'>";

$query=mysql_query("SELECT id_soalm,no_urut,krsid,a.id_soal,a.ja AS jawa,a.jb AS jawb,a.jc AS jawc,a.jd AS jawd,a.je AS jawe,a.status,a.tgl_insert,a.id_jujian,a.id_ujian,a.sj,b.mkkode,b.judul,b.bobot,b.* FROM
(SELECT * FROM soal_mhsw WHERE id_ujian='$id' AND no_urut='$ur' and status='A')a LEFT JOIN
(SELECT * FROM soal WHERE STATUS='A')b ON a.id_soal=b.id_soal");
while($row=mysql_fetch_array($query)){
echo"
<form name='form_jawab' method='POST' action='' enctype='multipart/form-data'>
<table width='100%'>";
echo"<tr><td align='left' colspan='3'>";
	echo "Number : $ur";
	echo "<br>";
	echo"</td></tr>";
	echo"<tr><td align='left' colspan='3'>";
	echo html_entity_decode($row["soal"]);
	echo"</td></tr>";
	echo"<tr><td align='left' colspan='3'>";
	echo "<br>";
	echo "<hr>";
	echo"</td></tr>";
	if (($row['jawa'])=='S'){
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check1' value='B'></td><td align='left' width='30px'>";echo "A."; echo "</td><td align='left'>"; echo 
	html_entity_decode($row["ja"]);
	}else{
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check1' value='B' checked='checked'></td><td align='left' width='30px'>";echo "A."; echo "</td><td align='left'>"; echo
	html_entity_decode($row["ja"]);
	} 
	
	echo"</td></tr>";
	if (($row['jawb'])=='S'){
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check2' value='B'></td><td align='left width='30px''>";echo "B."; echo "</td><td align='left'>"; echo html_entity_decode($row["jb"]);
	}else{
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check2' value='B' checked='checked'></td><td align='left width='30px''>";echo "B."; echo "</td><td align='left'>"; echo html_entity_decode($row["jb"]);
	}
	echo"</td></tr>";
	if (($row['jawc'])=='S'){
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check3' value='B'></td><td align='left' width='30px'>";echo "C."; echo "</td><td align='left'>"; echo html_entity_decode($row["jc"]);
	}else{
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check3' value='B' checked='checked'></td><td align='left' width='30px'>";echo "C."; echo "</td><td align='left'>"; echo html_entity_decode($row["jc"]);
	}
	echo"</td></tr>";
	if (($row['jawd'])=='S'){
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check4' value='B'></td><td align='left' width='30px'>";echo "D."; echo "</td><td align='left'>"; echo html_entity_decode($row["jd"]);
	}else{
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check4' value='B' checked='checked'</td><td align='left' width='30px'>";echo "D."; echo "</td><td align='left'>"; echo html_entity_decode($row["jd"]);
	}
	echo"</td></tr>";
	if (($row['jawe'])=='S'){
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check5' value='B'></td><td align='left' width='30px'>";echo "E."; echo "</td><td align='left'>"; echo html_entity_decode($row["je"]);
	}else{
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check5' value='B' checked='checked'></td><td align='left' width='30px'>";echo "E."; echo "</td><td align='left'>"; echo html_entity_decode($row["je"]);
	}
	echo"</td></tr>";
	echo "<hr>";
echo"</td></tr>";
echo"<tr><td>
<input type='hidden' name='act' value='simpan'>
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='idj' value='$idj'>
<input type='hidden' name='mh' value='$mh'>
<input type='hidden' name='ur' value='$ur'>
<input type='hidden' name='idso' value='$row[id_soalm]'>
<input type='hidden' name='ids' value='$row[id_soal]'>

</rd></tr>";
			
echo "</table>";


echo "<hr>";
echo"
<table>
<tr><td></td><td></td><td align='center'><input type='submit' class='button' value='Confirm'> 
</td></tr></table>
			
</form>";

echo"
<form name='form_jawab' method='POST' action='' enctype='multipart/form-data'>	
<input type='hidden' name='act' value='final'>
<input type='hidden' name='id' value='$id'>
<input type='hidden' name='idj' value='$idj'>
<input type='hidden' name='mh' value='$mh'>
<input type='hidden' name='ur' value='$ur'>
<input type='hidden' name='idso' value='$row[id_soalm]'>
<table width='100%'>
<tr><td></td><td></td><td align='right'>Click for Finish this Exam --> <input type='submit' class='button' value='Finish'> 
</td></tr></table>
</form>";
}


echo"
</td>
</tr>


</table>";

break;	

default:
echo "--------------";
break;	
}

?>