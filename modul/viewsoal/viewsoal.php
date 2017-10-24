<?php
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';

// mengatur time zone untuk WIB.
if($user_level_kd == '21' || $user_level_kd == '22' || $user_level_kd == '23'){

	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$menu = isset($_GET['mn']) ? htmlspecialchars($_GET['mn'],ENT_QUOTES) : '';
	$kd = isset($_GET['kd']) ? htmlspecialchars($_GET['kd'],ENT_QUOTES) : '';
	$nm = isset($_GET['nm']) ? htmlspecialchars($_GET['nm'],ENT_QUOTES) : '';
echo "
<div class='clear'></div>
<table class='data'><tr class='data'><td class='data' width='97px'>";


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

$query=mysql_query("SELECT * from soal where id_soal='$id'");
while($row=mysql_fetch_array($query)){
echo"
<form name='form_jawab' method='POST' action='' enctype='multipart/form-data'>
<table width='100%'>";
echo"<tr><td align='left' colspan='3'>";
	//echo "Number : 1";
	//echo "<br>";
	echo "Grade :"; echo $row["bobot"]; 
	echo "<br>";
	echo"</td></tr>";
	echo"<tr><td align='left' colspan='3'>";
	echo html_entity_decode($row["soal"]);
	echo"</td></tr>";
	echo"<tr><td align='left' colspan='3'>";
	echo "<br>";
	echo "<hr>";
	echo"</td></tr>";
	
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check1' value='B'></td><td align='left' width='30px'>";echo "A."; echo "</td><td align='left'>"; echo 
	html_entity_decode($row["ja"]);
	
	
	echo"</td></tr>";
	
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check2' value='B'></td><td align='left width='30px''>";echo "B."; echo "</td><td align='left'>"; echo html_entity_decode($row["jb"]);
	
	echo"</td></tr>";
	
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check3' value='B'></td><td align='left' width='30px'>";echo "C."; echo "</td><td align='left'>"; echo html_entity_decode($row["jc"]);
	
	echo"</td></tr>";
	if (($row["jd"])==""){
	
	}else{
	echo"<tr><td align='left' width='30px'><input type='checkbox' name='check4' value='B'></td><td align='left' width='30px'>";echo "D."; echo "</td><td align='left'>"; echo html_entity_decode($row["jd"]);
	}
	echo"</td></tr>";
	
	//echo"<tr><td align='left' width='30px'><input type='checkbox' name='check5' value='B'></td><td align='left' width='30px'>";echo "E."; echo "</td><td align='left'>"; echo html_entity_decode($row["je"]);
	
	echo"</td></tr>";
	echo "<hr>";
echo"</td></tr>";
echo"<tr><td>

</rd></tr>";
			
echo "</table>";


echo "<hr>";
echo"
<table>
<tr><td></td><td></td><td align='center'>
<input type='button' class='button' value='Back' onclick=\"location.href='index.php?m=$menu&kd=$kd&nm=$nm'\">
<input type='button' class='button' value='Edit' onclick=\"location.href='index.php?m=$menu&s=edit&id=$id'\">
<input type='button' class='button' value='Delete' onclick=\"location.href='modul/$menu/act_$menu.php?act=hapus&id=$id&mkkode=$kd&nm=$nm'\"></td></tr>
</td></tr></table>
			
</form>";


}


echo"
</td>
</tr>


</table>";

}else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>