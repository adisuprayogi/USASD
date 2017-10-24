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
break;

///////////////////////////////////////////// list ///////////////////////////////////////////
default:
/* jika page default nya 1 */

$hal = isset($_GET['hal']) ? $_GET['hal'] : '';

if(($hal)==''){
$page = 1;
} else {
$page = $hal;
}

$max_results = 15;
$from=$page * $max_results - $max_results;

echo "<h3 align='center'>List Of Course for Mid Exam</h3>";

echo"
<form name='cari' method='POST' action='index.php?m=soaluts' enctype='multipart/form-data'>
";

echo "Searching : <input type='text' name='cari2' value='$car' size='30' maxlength='25'>";
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
	
break;
}

}
else{
	echo "<h3>Anda dilarang mengakses halaman ini</h3>";
}
?>