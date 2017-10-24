<?php
session_start();

include 'include/connection.php';
include 'include/function.php';

$menu = isset($_GET['m']) ? $_GET['m']:'home';
$submenu = isset($_GET['s']) ? $_GET['s']:'d';

?>
<html>
<head>
<title>Ujian Akuntansi Syariah Dasar (UASD)</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Online Examp STEI TAZKIA">

<link rel="shortcut icon" href="css/img/detail.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="css/global.css"> <!--pemanggilan file css-->
<link rel="stylesheet" type="text/css" href="stuff/calendar/calendar.css"> <!--pemanggilan file css-->
<script type="text/javascript" src="stuff/calendar/calendar.js"></script>
<script type="text/javascript" src="stuff/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="stuff/ckeditor/ckfinder.js"></script>
	
<script type="text/javascript">
function pilih_semua(source) {
  checkboxes = document.getElementsByName('soal_kd[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<?php if($menu=='usm' && ($submenu=='listtipe' || $submenu=='kkkk')) { ?>
<!-- timer begin -->

<!-- timer end -->
<?php } ?>
</head>

<body>
<div id="header">
	<div class="inHeader">
		<div class="inHeaderText">
		Ujian Akuntansi Syariah Dasar (UASD)
		</div>
		<div class="userLogin">
		<?php 
			if(isset($_SESSION['user_name'])){ 
				echo "Assalamualaikum, ".get_data_user('nama')."<br>";
				
				if($_SESSION['user_level_kd'] == '21'){
				echo"
				<a href='index.php'>Home</a> | <a href='index.php?m=inputsoal'>Bank Soal</a> | <a href='index.php?m=jadwal'>Test Schedule</a> | <a href='index.php?m=listujian'>List Test</a> | <a href='index.php?m=daftarpeserta'>Daftar Peserta</a> | <a href='index.php?m=gantipassword'>Change Password</a> | <a href='logout.php'>Logout</a>";
				}else if($_SESSION['user_level_kd'] == '26'){
				echo"
				<a href='index.php?m=kerjasoal'>Mulai Test</a> | <a href='logout.php'>Logout</a>";
				}else if($_SESSION['user_level_kd'] == '22'){
				echo"
				<a href='index.php'>Home</a> | <a href='index.php?m=inputsoal'>Bank Soal</a> | <a href='index.php?m=gantipassword'>Change Password</a> | <a href='logout.php'>Logout</a>";
				}
				
				
			}
			else{
				echo "Hallo, Visitor<br>"  ;
			}
		?>
			</div>
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper">

	
	
	<div id="rightContent">
    
    <?php 
	if(isset($_SESSION['user_name'])){
		$file_modul = 'modul/'.$menu.'/'.$menu.'.php';
		if(file_exists($file_modul)) include $file_modul;
		else echo "<h3>Page Not Found</h3>"; 
	}
	else{
	?>
		
		<form name="form_login" action="login.php" method="POST" enctype="multipart/form-data">
        <br>
        <br>
		<table width="250px" align="center" bgcolor="#f2f4fe" style="border: 1px solid #253ac6;">
		<tr><td align="center" colspan="2"><font size="5px" face="bauhaus 93">LOGIN</font></td></tr>
		<tr></tr><tr></tr>
		<tr>
			<td align="center"><font size="2px">Username :</font></td>
		</tr>
		<tr>
			<td width="210px" align="center"><input type="text" width="200px" name="username" maxlength="14"/></td>
		</tr>
		<tr>
			<td align="center">Password :</td>
		</tr>
		<tr>	
			<td width="210px" align="center"><input type="password" width="200px" name="password" maxlength="20"/></td>
		</tr>
		<tr>
			<td align="center"><input align="middle" type="submit" name="submit" class="button" value="Login"/>
			<input align="middle" type="reset" name="clear" class="button" value="Clear"/></td>
		</tr>
		<tr height="40">
			<td align="center"><a href="index.php?m=lupapassword">Forgot Password ?</a></td>
		</tr>
		</table>
        <br>
        <br>
		</form>	
        	
        <?php    
		//<h3 style="margin:20px 0px 5px 0px">Additional Link</h3>
		//<ul style="margin-top:0px">
		//<li><a href="http://www.tazkia.ac.id" target="_blank">Yayasan Pend. STIE Tazkia </a></li>
		//<li><a href="http://www.tazkia.ac.id" target="_blank">STEI Tazkia</a></li>
		//<li><a href="http://www.untaz.com/simak" target="_blank" title="Sistem Informasi Akademik">SIMAK STEI Tazkia</a></li>
		//</ul>
		?>
	
	<?php } ?>
    

			
		
		<div class="clear"></div>		
	</div>
<div class="clear"></div>
<div id="footer">
	&copy; 2017 | <a href="#">www.tazkia.ac.id</a> | designed by : <a href="http://tazkia.ac.id/" rel="nofollow" target="_blank">STEI TAZKIA</a><br> 
</div>
</div>
</body>
</html>

<?php mysql_close($koneksi); ?>