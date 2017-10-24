<?php
$menu = 'kerjasoal';
$user_id = isset($_SESSION['user_kd']) ? $_SESSION['user_kd'] : '';
$act = isset($_POST['act']) ? htmlspecialchars($_POST['act'],ENT_QUOTES) : 'utama';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':

	$ids = isset($_POST['ids']) ? htmlspecialchars($_POST['ids'],ENT_QUOTES) : '';
	$ur = isset($_POST['ur']) ? htmlspecialchars($_POST['ur'],ENT_QUOTES) : '1';
	$idso = isset($_POST['idso']) ? htmlspecialchars($_POST['idso'],ENT_QUOTES) : '';
	$check1 = isset($_POST['check1']) ? htmlspecialchars($_POST['check1'],ENT_QUOTES) : 'S';
	$check2 = isset($_POST['check2']) ? htmlspecialchars($_POST['check2'],ENT_QUOTES) : 'S';
	$check3 = isset($_POST['check3']) ? htmlspecialchars($_POST['check3'],ENT_QUOTES) : 'S';
	$check4 = isset($_POST['check4']) ? htmlspecialchars($_POST['check4'],ENT_QUOTES) : 'S';
	$check5 = isset($_POST['check5']) ? htmlspecialchars($_POST['check5'],ENT_QUOTES) : 'S';
	$urn=$ur+1;
	
	
	
	
	if(empty($ur) || empty($idso) || empty($check1) || empty($check2) || empty($check3) || empty($check4) || empty($check5)){
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
	
	if ($sa==$check1 && $sb==$check2 && $sc==$check3 && $sd==$check4){
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
		echo "<meta http-equiv='Refresh' content='0; URL=index.php?m=$menu&ur=$urn'/>";
	}
break;

case 'final':
$menu = 'daftarujian';
	$id = isset($_POST['id']) ? htmlspecialchars($_POST['id'],ENT_QUOTES) : '';
	$idj = isset($_POST['idj']) ? htmlspecialchars($_POST['idj'],ENT_QUOTES) : '';
	$ur = isset($_POST['ur']) ? htmlspecialchars($_POST['ur'],ENT_QUOTES) : '1';
	$mh = isset($_POST['mh']) ? htmlspecialchars($_POST['mh'],ENT_QUOTES) : '';
	$ur = isset($_POST['ur']) ? htmlspecialchars($_POST['ur'],ENT_QUOTES) : '1';
	$idso = isset($_POST['idso']) ? htmlspecialchars($_POST['idso'],ENT_QUOTES) : '';
	
	
	if(empty($idso)){
		echo "<script>alert('Jawaban Tidak Bisa Diproses');history.back();</script>";
	}
	else{
	$q=mysql_query("SELECT id_ujian,SUM(bobot) AS bobot FROM soal_mhsw WHERE id_ujian='$id' AND sj='F' AND jawaban='B'");
	while($r=mysql_fetch_array($q)){
	$bobot=$r['bobot'];
	}
	$q1=mysql_query("SELECT id_ujian,SUM(bobot) AS jml FROM soal_mhsw WHERE id_ujian='$id'");
	while($r1=mysql_fetch_array($q1)){
	$jml=$r1['jml'];
	}
	$Nilai=($bobot*$jml)/100;
	
		$insert=mysql_query("update master_ujian set Nilai='$Nilai',NilaiT='$Nilai',ST='F' where id_ujian='$id'");
		
		$insert2=mysql_query("update soal_mhsw set status='F' where id_ujian='$id'");
		
		$insert3=mysql_query("update jadwal_ujian set status='F' where id_jujian='$idj'");
		
		if($insert and $insert2 and $insert3){
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

	$mh = isset($_GET['mh']) ? htmlspecialchars($_GET['mh'],ENT_QUOTES) : '';
	$krs = isset($_GET['k']) ? htmlspecialchars($_GET['k'],ENT_QUOTES) : '';
	$ur = isset($_GET['ur']) ? htmlspecialchars($_GET['ur'],ENT_QUOTES) : '1';

echo "
<div class='clear'></div>
<table class='data'><tr class='data'><td class='data' width='97px'>";
$ff=mysql_query("select id_ujian from master_ujian where mhswid='$user_id'");
while($gg=mysql_fetch_array($ff)){
$id_ujian=$gg['id_ujian'];
}

$q1=mysql_query("select count(id_soalm) as idc from soal_mhsw where id_ujian='$id_ujian' and status='A'");
while($r1=mysql_fetch_array($q1)){
$urf=$r1['idc'];
}
if ($ur>$urf){
$ur=1;
}

$query1=mysql_query("select * from soal_mhsw where id_ujian='$id_ujian' and status='A' order by no_urut");
while($row1=mysql_fetch_array($query1)){

if (($row1['no_urut'])==$ur){
echo"<a href='index.php?m=kerjasoal&ur=$row1[no_urut]' title='Soal No $row1[no_urut]'><img src='css/img/pro.png'></a>&nbsp";
}else{
if(($row1['sj'])=="B"){
echo"<a href='index.php?m=kerjasoal&ur=$row1[no_urut]' title='Soal No $row1[no_urut]'><img src='css/img/belum.png'></a>&nbsp";
}else{
echo"<a href='index.php?m=kerjasoal&ur=$row1[no_urut]' title='Soal No $row1[no_urut]'><img src='css/img/sudah.png'></a>&nbsp";
}
}
}
echo"
</td>
<td class='data'>";


$query=mysql_query("SELECT id_soalm,no_urut,krsid,a.id_soal,a.ja AS jawa,a.jb AS jawb,a.jc AS jawc,a.jd AS jawd,a.je AS jawe,a.status,a.tgl_insert,a.id_jujian,a.id_ujian,a.sj,b.mkkode,b.judul,b.bobot,b.* FROM
(SELECT * FROM soal_mhsw WHERE id_ujian='$id_ujian' AND no_urut='$ur' and status='A')a LEFT JOIN
(SELECT * FROM soal WHERE STATUS='A')b ON a.id_soal=b.id_soal");
while($row=mysql_fetch_array($query)){

//timer--------------------------------------------------------------------------------------------------------------------
date_default_timezone_set("Asia/Jakarta");
 
// mencari mktime untuk tanggal 1 Januari 2011 00:00:00 WIB
$query2=mysql_query("SELECT YEAR(tgl_ujian) AS thn, MONTH(tgl_ujian) AS bln, DAY(tgl_ujian)AS hari,LEFT(jam_selesai,2) AS jam,RIGHT(jam_selesai,2)AS menit FROM jadwal_ujian where id_jujian='$row[id_jujian]'");
while($rowe=mysql_fetch_array($query2)){
$thn=$rowe['thn'];
$bln=$rowe['bln'];
$hari=$rowe['hari'];
$jam=$rowe['jam'];
$menit=$rowe['menit'];
$selisih1 =  mktime($jam, $menit, 0, $bln, $hari,$thn);
}
$selisih2 = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
$delta = $selisih1 - $selisih2;
$a = floor($delta / 86400);

// proses mencari jumlah jam
$sisa = $delta % 86400;
$b  = floor($sisa / 3600);

// proses mencari jumlah menit
$sisa = $sisa % 3600;
$c = floor($sisa / 60);

// proses mencari jumlah detik
$sisa = $sisa % 60;
$d = floor($sisa / 1);
?>
<script src="stuff/jquery.min.js"></script>
<script type="text/javascript" src="include/servertime.php"></script>
<script type="text/javascript">

// First thing, reference the variable.
var servertimeOBJ;

// Now check that it is set
if (servertimeOBJ != null){
	var myscriptTime = servertimeOBJ;
	myscriptTime.setHours(myscriptTime.getHours() + <?php echo"$b"; ?>, myscriptTime.getMinutes() +<?php echo"$c"; ?>, myscriptTime.getSeconds(), myscriptTime.getMilliseconds());
}

// If server time not passed, use client's time
else{
	var myscriptTime = new Date();
}
</script>
<script type="text/javascript">
	$(function(){
				Countdown(new Date('<?php echo $_SESSION["akhir_waktu"] ?>'));
	});
	function Countdown(then) {
	 
		this.then = then;
		
		function setElement(id, value) {
			if (value.length < 2) {
				value = "0" + value;
			}
		
			window.document.getElementById(id).innerHTML = value;
		}
		
		function countdown() {
			now  		  = myscriptTime;
			diff		  = new Date(this.then - now);
			
			seconds_left  = Math.floor(diff.valueOf() / 1000);
		
			seconds  = Math.floor(seconds_left / 1) % 60;
			if(seconds<0)seconds=0; 
			minutes  = Math.floor(seconds_left / 60) % 60;
			if(minutes<0)minutes=0; 
			hours    = Math.floor(seconds_left / 3600) ;
			if(hours<0)hours=0; 			

			setElement('timer-jam', hours);
			setElement('timer-menit', minutes);
			setElement('timer-detik', seconds);
			
			if(hours == 0 && minutes == 0 && seconds == 0){
				alert("Waktu Habis, Jawaban dari Soal yang sudah Anda kerjakan akan disimpan otomatis oleh sistem.");
				document.getElementById('form_soal').submit();
			}
			else{
				myscriptTime.setSeconds(myscriptTime.getSeconds()+1 ,0);
				countdown.timer = setTimeout(countdown, 1000);
			}
			
			
		}
		
			
		function start() {
			this.timer = setTimeout(countdown, 1000);
		}
		
		start(then);	
	 }
</script>

<?php
echo"
<form name='form_jawab' method='POST' action='' enctype='multipart/form-data'>
<table width='100%'>";
echo"<tr><td align='left' colspan='3'>";
	echo "Waktu saat ini: ".date("d-m-Y H:i:s")."<br>";
	echo "Masih: ".$a." hari ".$b." jam ".$c." menit ".$d." detik lagi, menuju waktu selesai ujian";

	echo "<hr>";
	echo"<br>";
	echo "Number : $ur  ID : $row[id_soal]";
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
	//if (($row['jawe'])=='S'){
	//"<tr><td align='left' width='30px'><input type='checkbox' name='check5' value='B'></td><td align='left' width='30px'>";echo "E."; echo "</td><td align='left'>"; echo html_entity_decode($row["je"]);
	//}else{
	//"<tr><td align='left' width='30px'><input type='checkbox' name='check5' value='B' checked='checked'></td><td align='left' width='30px'>";echo "E."; echo "</td><td align='left'>"; echo html_entity_decode($row["je"]);
	//}
	//"</td></tr>";
	echo "<hr>";
echo"</td></tr>";
echo"<tr><td>
<input type='hidden' name='act' value='simpan'>
<input type='hidden' name='ids' value='$row[id_soal]'>
<input type='hidden' name='ur' value='$ur'>
<input type='hidden' name='idso' value='$row[id_soalm]'>

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
<input type='hidden' name='idj' value='$row[id_jujian]'>
<input type='hidden' name='id' value='$row[id_ujian]'>
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