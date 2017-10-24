<?php
function encrypt_password($password){
	if (!empty($password)) $password = md5('8ifsvGkfGFj(DD)ghwNJHsdvj%!@'.md5($password).md5('Created By: awanxp 10511902 Unikom'));
	return $password;
}

function random_password($length){
	$password = "";
	$possible = "23456789abcdefghjkmnpqrstwxyzABDEFGLNT";	
	$i = 0;
	while ($i < $length) {
		// ambil sebuah karakter acak dari beberapa kemungkinan yang sudah ditentukan tadi
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		
		//jika char sudah ada di password skip
		if (!strstr($password, $char)) {
			$password .= $char;
			$i++;
		}
	}
	return $password;
}

function out($time,$url){
	exit("<meta http-equiv='Refresh' content='$time; URL=$url'/>");
}

function cek_login(){
	$siakad_user_kd = isset($_SESSION['siakad_user_kd']) ? $_SESSION['siakad_user_kd']:'';
	if(!empty($siakad_user_kd)) return TRUE; else return FALSE;
}

function cek_auth($menu){
	if(empty($menu)) $menu = isset($_GET['mn']) ? $_GET['mn']:'';	
	$r=mysql_query("SELECT role_kd FROM tsrole A, tsmenu B 
	WHERE A.menu_kd = B.menu_kd AND A.level_kd = '".get_siakad_user_level_kd()."' AND B.menu_slug = 'm-".$menu.".html'");
	$n=mysql_num_rows($r); 
	if($n==0)  return false;	
	else return true;	
}

function get_siakad_user_kd(){
	$siakad_user_kd = isset($_SESSION['siakad_user_kd']) ? $_SESSION['siakad_user_kd']:'';
	return $siakad_user_kd;
}

function get_siakad_user_nama(){
	$siakad_user_nama = isset($_SESSION['siakad_user_nama']) ? $_SESSION['siakad_user_nama']:'';
	return $siakad_user_nama;
}

function get_siakad_user_level_kd(){
	$siakad_user_level_kd = isset($_SESSION['siakad_user_level_kd']) ? $_SESSION['siakad_user_level_kd']:'';
	return $siakad_user_level_kd;
}

function get_siakad_user_level_nama(){
	$siakad_user_level_nama = isset($_SESSION['siakad_user_level_nama']) ? $_SESSION['siakad_user_level_nama']:'';
	return $siakad_user_level_nama;
}

function get_siakad_user_lastlogintime(){
	$siakad_user_lastlogintime = isset($_SESSION['siakad_user_lastlogintime']) ? $_SESSION['siakad_user_lastlogintime']:'';
	return format_tgl($siakad_user_lastlogintime,'fulldate');
}

function get_siakad_user_property($property){
	$r=mysql_query("SELECT * FROM tslevel WHERE level_kd='".get_siakad_user_level_kd()."'");
	$d = mysql_fetch_array($r);
	$r=mysql_query("SELECT ".$d['mastertabel_1'].",".$d['mastertabel_2']." FROM ".$d['mastertabel_nama']." WHERE ".$d['mastertabel_0']." = '".get_siakad_user_kd()."'");
	$dh=mysql_fetch_array($r);
	if($property == 'nama'){
		return $dh[0];
	}
	elseif($property == 'fotothumb'){
		$x=substr($d['mastertabel_nama'],2,(strlen($d['mastertabel_nama'])-2));
		return 'photo/'.$x.'/thumb/'.$dh[1];
	}
}

function validasi_cari(){
	$field = isset($_GET['field']) ? $_GET['field']:'f'; //$field=block_injection($field,'xss');
	$cari = isset($_GET['cari']) ? $_GET['cari']:''; //$cari=block_injection($cari,'htmlenc');
	$token = isset($_GET['token']) ? $_GET['token']:''; $token=block_injection($token,'xss');
	$token_key = get_token($field,$cari);
	//echo $cari.' - '.$token.' - '.$token_key;
	if(!empty($cari) && $token != $token_key) $cari="";
	return array ($field,$cari,$token_key);
}

function paging($dataPerPage){
	$hal=isset($_GET['halaman']) ? $_GET['halaman']:'1';
	$hal=block_injection($hal,'sql');
	if(isset($_GET['halaman']) && !empty($hal)){$noPage = $hal;} else {$noPage = 1;}	
	$offset = ($noPage - 1) * $dataPerPage;
	return $offset;
}

function echo_paging($jumData,$self,$dataPerPage){
	$hal=isset($_GET['halaman']) ? $_GET['halaman']:'';
	$hal=block_injection($hal,'sql');
	if(isset($_GET['halaman'])){$noPage = $hal;} else {$noPage = 1;}
	echo "<div class='paging'>";
	$jumPage = ceil($jumData/$dataPerPage);
	$self=$self."-";		
	if ($jumData!=0) echo "Halaman: ";		
	if ($noPage > 1) echo  "<a href='".$self.($noPage-1).".html'>◄ Prev</a>";	 // menampilkan link previous	
	$showPage=0;
	for($page = 1; $page <= $jumPage; $page++){ // memunculkan nomor halaman dan linknya
		if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)){   
			if (($showPage == 1) && ($page != 2))  echo "..."; 
			if (($showPage != ($jumPage - 1)) && ($page == $jumPage))  echo "...";
			if ($page == $noPage) echo " <b>".$page."</b>";
			else echo " <a href='".$self.$page.".html'>".$page."</a> ";
			$showPage = $page;          
		}
	}				
	if ($noPage < $jumPage) echo "<a href='".$self.($noPage+1).".html'>Next ►</a>";// menampilkan link next
	echo "</div><div class='clear'></div>";
}

function get_token($str1,$str2){
	$key = md5(md5($str1).md5('awanxpanddhethief').md5($str2));
	$token_key = substr($key,9,3).substr($key,19,3).substr($key,29,3);
	return $token_key;
}

function list_box($l_name,$l_class,$l_tipe,$l_pilih,$l_val_selected){
	$str="<select name='$l_name' class='$l_class'>";
	if($l_pilih) $str .= "<option value=\"\">-Pilih-</option>";	
	$r_list = mysql_query("SELECT * FROM tspilihan WHERE pil_tipe = '$l_tipe' ORDER BY pil_order");
	if(mysql_num_rows($r_list) > 0){
		while($d_list=mysql_fetch_array($r_list)){
			$selected = ($d_list['pil_value'] == $l_val_selected) ? "selected='selected'" : "";
			$str.= "<option value=\"$d_list[pil_value]\" $selected >$d_list[pil_label]</option>";
		}
	}
	$str .= "</select>";
	return $str;	
}
function radio($name,$class,$tipe,$v_checked){
	$str="";
	$rl = mysql_query("SELECT * FROM tspilihan WHERE pil_tipe = '$tipe' ORDER BY pil_order");
	$num = mysql_num_rows($rl); $i=1;
	if($num > 0){
		while($dl=mysql_fetch_array($rl)){
			$checked = ($dl['pil_value'] == $v_checked) ? "checked='checked'" : "";
			$last=($i==$num) ? "id='$name'" : '';
		 $str.="<label $last><input type='radio' name='$name' value='$dl[pil_value]' class='$class' $checked/>$dl[pil_label]</label>&nbsp;";
			$i++;
		}
	}
	return $str;	
}

function format_tgl($date,$format){
	if (!(empty($date) || substr($date,0,10)=='0000-00-00' || substr($date,0,10)=='00-00-0000')){
		$bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni',
						  'Juli','Agustus','September','Oktober', 'November','Desember');
		switch($format){
			default: 
				return ''; 
			break;
			case 'fulldate':
				$i=(int)substr($date,5,2);		$jam = substr($date,11,8);
				if(!empty($jam)) {$wib=' WIB'; $sprt=' | ';} else {$wib='';$sprt='';}
				return substr($date,8,2).' '.$bulan[$i].' '.substr($date,0,4).$sprt.$jam.$wib;
			break;	
			case 'longdate':
				$i=(int)substr($date,5,2);		$jam = substr($date,11,5);
				if(!empty($jam)) {$wib=' WIB'; $sprt=' | ';} else {$wib='';$sprt='';}
				return substr($date,8,2).' '.substr($bulan[$i],0,3).' '.substr($date,0,4).$sprt.$jam.$wib;
			break;
			case 'detildate':
				$i=(int)substr($date,5,2);		$jam = substr($date,11,8);
				if(!empty($jam)) {$sprt=' | ';} else {$sprt='';}
				return substr($date,8,2).' '.substr($bulan[$i],0,3).' '.substr($date,0,4).$sprt.$jam;
			break;	
			case 'dd/mm/yyyy':
				return substr($date,8,2).'/'.substr($date,5,2).'/'.substr($date,0,4);
			break;		
			case 'yyyy-mm-dd':
				return substr($date,6,4).'-'.substr($date,3,2).'-'.substr($date,0,2); 				
			break;	
			case 'log':
				$i=(int)substr($date,5,2);		$jam = substr($date,11,5);
				if(!empty($jam)) $sprt=' | '; else $sprt='';
				return substr($date,8,2).' '.substr($bulan[$i],0,3).' '.substr($date,0,4).$sprt.$jam; 				
			break;
		}	
	}
	else return '';
}

function get_ext($filename){
	if(!empty($filename)){
		$pecah = explode('.',strtolower($filename)); // Select the extension from the file.
		for($i=0;$i<=count($pecah)-1;$i++){$ext = $pecah[$i];}		
	}
	else{
		$ext='';
	}
	return $ext;	
}

function upload_resize_image($name,$tmp,$maxwidth,$maxheight,$filename){
	ini_set("memory_limit","50M"); $ext = get_ext($name);	
	if($ext == "jpg" || $ext == "jpeg")	$image = imagecreatefromjpeg($tmp);
	else if($ext == "gif") $image = imagecreatefromgif($tmp);
	else if($ext == "png") $image = imagecreatefrompng($tmp);		
	list($width,$height) = getimagesize($tmp);
	if($width > $height){ 	//landscape
		$newwidth = $maxwidth; 		$newheight = ($newwidth / $width) * $height;
	}
	else { 																															//potrait
		$newheight = $maxheight;	$newwidth = ($newheight / $height) * $width;
	}			
	$tmp = imagecreatetruecolor($newwidth,$newheight); //Create temporary image file.			
	imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height); //Copy the image to one with new width n height	
	imagejpeg($tmp,$filename,95); // Create image file with 95% quality.
	imagedestroy($image);
	imagedestroy($tmp);
}

function remove_file($path){
	if(file_exists($path)) unlink($path);
}

function permalink($realname,$ext){
	$seoname = strip_tags($realname);
	$seoname = preg_replace('/\%/',' persen',$seoname);
	$seoname = preg_replace('/\@/',' at ',$seoname);
	$seoname = preg_replace('/\&/',' dan ',$seoname);
	$seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces
	$seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric
	$seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens
	$seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens
	$seoname = strtolower($seoname); 
	return $seoname.$ext; 
}

function block_injection($str, $tipe){
	$str = trim($str);
	$str = stripcslashes($str);
	switch($tipe){
		default: 
		case'sql':	//untuk get id
			//$str = htmlspecialchars($str,ENT_QUOTES);		
			$str = preg_replace('/[^A-Za-z0-9]/','',$str);				
			return intval($str);
		break;
		case'xss':
			$str = strtolower($str);
			//$str = htmlspecialchars($str,ENT_QUOTES);			
			$str = preg_replace('/[\W]/','', $str); // Strip off spaces and non-alpha-numeric 
			return $str;
		break;
		case 'stripquotes':
			$str=str_replace("'", "\'", $str);
			$str=str_replace("script", "scropt", $str);
			return $str;
		break;
		case'htmlenc':
			$str = strip_tags($str);
			$str = htmlspecialchars($str,ENT_QUOTES);
			return $str;
		break;
		case'htmldec':
			$str = htmlspecialchars_decode($str,ENT_QUOTES);
			return $str;
		break;		
	}
}

function cuplik($str,$max_words){
	if(!empty($str)){
		$str = strip_tags($str);
		$pecah = explode(" ",$str);
		$count_words = count($pecah);
		if($count_words > $max_words ){
			$str='';
			for($i=0;$i <= ($max_words-1);$i++) {
			$str .= $pecah[$i].' ';
			}
			$str.='...';
		}
		return trim($str);			
	}
	else return '';	
}

function catat_log($ket){
	$now=date("Y-m-d H:i:s");
	$user_name = get_siakad_user_nama();
	if(!empty($ket)){
		mysql_query("INSERT INTO tslog(user_name,log_ket,log_time) VALUES('$user_name','$ket','$now')");// or die("Gagal catat log");
	}
}
























function get_email_support(){
	$res=mysql_query("SELECT statis_isi FROM pak_statis WHERE statis_kategori = 'emailsupport'");
	if(mysql_num_rows($res)>0) return mysql_result($res,0); else return '';
}

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'mail.denisetiawan.com';
	$mail->Port = 25; 
	$mail->Username = "sender@denisetiawan.com";  
	$mail->Password = "gara2aceng";           
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->isHTML(true);
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		return true;
	}
}

function get_buku_tamu_unread(){
	$res=mysql_query("SELECT count(id_buku_tamu) FROM pak_buku_tamu WHERE id_replied=0 AND status_baca= 'unread'");
	if(mysql_num_rows($res)>0) return mysql_result($res,0); else return '0';
}

?>