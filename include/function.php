<?php
function encrypt_password($password){
	$pass_en = (!empty($password)) ? md5($password.'!*%#&@%#&') : '';
	return $pass_en;
}

function get_data_user($property){
	$r=mysql_query("SELECT * FROM tbl_level WHERE level_kd='".$_SESSION['user_level_kd']."'");
	$d = mysql_fetch_array($r);
	$r = mysql_query("SELECT ".$d['mastertabel_1'].",".$d['mastertabel_2']." FROM ".$d['mastertabel_nama']." WHERE ".$d['mastertabel_0']." = '".$_SESSION['user_kd']."'");
	$dh=mysql_fetch_array($r);
	if($property == 'nama'){
		return $dh[0];
	}
	elseif($property == 'fotothumb'){
		$x=substr($d['mastertabel_nama'],2,(strlen($d['mastertabel_nama'])-2));
		return 'photo/'.$x.'/thumb/'.$dh[1];
	}
}

function format_tgl($date,$format){
	if (!(empty($date) || substr($date,0,10)=='0000-00-00' || substr($date,0,10)=='00-00-0000')){
		$bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni',
						  'Juli','Agustus','September','Oktober', 'November','Desember');
		switch($format){
			default: 
				return ''; 
			break;
			case 'dd-mmmm-yyyy his':
				$i=(int)substr($date,5,2);		$jam = substr($date,11,8);
				return substr($date,8,2).' '.$bulan[$i].' '.substr($date,0,4).' '.substr($date,11,8);
			break;	
			case 'dd-mmmm-yyyy':
				$i=(int)substr($date,5,2);		$jam = substr($date,11,8);
				return substr($date,8,2).' '.$bulan[$i].' '.substr($date,0,4);
			break;			
			case 'dd-mm-yyyy':
				return substr($date,8,2).'-'.substr($date,5,2).'-'.substr($date,0,4);
			break;		
			case 'yyyy-mm-dd':
				return substr($date,6,4).'-'.substr($date,3,2).'-'.substr($date,0,2); 				
			break;				
		}	
	}
	else return '';
}

function get_gelombang_aktif(){
	$tgl_sekarang = date('Y-m-d');
	$gel_kd = '';
	$r=mysql_query("SELECT gel_kd FROM tbl_gelombang 
					WHERE gel_tgl_dari <= '$tgl_sekarang' AND gel_tgl_sampai >= '$tgl_sekarang' 
					ORDER BY gel_tgl_dari LIMIT 1");
	if(mysql_num_rows($r) == 1){
		$d=mysql_fetch_array($r);
		$gel_kd = $d['gel_kd'];
	}
	
	return $gel_kd;
}

function cmb_kd_baru($gel_kd,$via_kd){
	//pembuatan kode baru untuk CMB otomatis sesuai dengan gelombang
	$cmb_kd_prefix = "$gel_kd.$via_kd.";
	$rc=mysql_query("SELECT cmb_kd FROM tbl_cmb WHERE cmb_kd like '$cmb_kd_prefix%' ORDER BY RIGHT(cmb_kd,4) DESC LIMIT 1");
	if(mysql_num_rows($rc) == 0){
		$cmb_kd = $cmb_kd_prefix.'0001';
	}
	else{
		$dc = mysql_fetch_array($rc);
		$cmb_kd_last = substr($dc['cmb_kd'],10,4);
		$cmb_kd = ((int) $cmb_kd_last) + 10001;
		$cmb_kd = $cmb_kd_prefix.substr($cmb_kd,1,4);
	}
	return $cmb_kd;
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
	ini_set("memory_limit","500M"); $ext = get_ext($name);	
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

function terbilang($angka) {
    $angka = (float)$angka;
    $bilangan = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh','sebelas');
 
    if ($angka < 12) {
			return $bilangan[$angka];
    } 
		else if ($angka < 20) {
    	return $bilangan[$angka - 10] . ' belas';
    } 
		else if ($angka < 100) {
      $hasil_bagi = (int)($angka / 10);
      $hasil_mod = $angka % 10;
      return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } 
		else if ($angka < 200) {
    	return sprintf('seratus %s', terbilang($angka - 100));
    } 
		else if ($angka < 1000) {
      $hasil_bagi = (int)($angka / 100);
      $hasil_mod = $angka % 100;
      return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
    } 
		else if ($angka < 2000) {
      return trim(sprintf('seribu %s', terbilang($angka - 1000)));
    } 
		else if ($angka < 1000000) {
      $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
      $hasil_mod = $angka % 1000;
      return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
    } 
		else if ($angka < 1000000000) {
      // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
      $hasil_bagi = (int)($angka / 1000000);
      $hasil_mod = $angka % 1000000;
      return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } 
		else if ($angka < 1000000000000) {
      // bilangan 'milyaran'
      $hasil_bagi = (int)($angka / 1000000000);
      $hasil_mod = fmod($angka, 1000000000);
      return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } 
		else if ($angka < 1000000000000000) {                          
			// bilangan 'triliun'                           
			$hasil_bagi = $angka / 1000000000000;                           
			$hasil_mod = fmod($angka, 1000000000000);                           
			return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
		} 
		else {
			return 'Wow...'; 
		}
}  

function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'adimulya.com';
	$mail->Port = 25; 
	$mail->Username = "sender@adimulya.com";  
	$mail->Password = "sender123$";           
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

?>