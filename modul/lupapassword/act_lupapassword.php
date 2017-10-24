<?php
session_start();

include '../../include/connection.php';
include '../../include/function.php';

$menu = 'pendaftarancmb';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

$type_ok = array('image/jpg','image/jpeg','image/pjpeg','image/gif','image/png');
$dir = '../../photo/cmb/';

switch($act){

/////////////////////////// kode update //////////////////
case 'update':
	$cmb_kd = $_POST['cmb_kd'];
	$cmb_nama = isset($_POST['cmb_nama']) ? htmlspecialchars($_POST['cmb_nama'],ENT_QUOTES) : '';
	$cmb_tmptlahir = isset($_POST['cmb_tmptlahir']) ? htmlspecialchars($_POST['cmb_tmptlahir'],ENT_QUOTES) : '';
	$cmb_tgllahir = isset($_POST['cmb_tgllahir']) ? htmlspecialchars($_POST['cmb_tgllahir'],ENT_QUOTES) : ''; 
	$cmb_tgllahir = format_tgl($cmb_tgllahir,'yyyy-mm-dd');
	$cmb_agama = isset($_POST['cmb_agama']) ? htmlspecialchars($_POST['cmb_agama'],ENT_QUOTES) : '';
	$cmb_jnskelamin = isset($_POST['cmb_jnskelamin']) ? htmlspecialchars($_POST['cmb_jnskelamin'],ENT_QUOTES) : '';
	$cmb_alamatasal = isset($_POST['cmb_alamatasal']) ? htmlspecialchars($_POST['cmb_alamatasal'],ENT_QUOTES) : '';
	$cmb_alamatasal_telp = isset($_POST['cmb_alamatasal_telp']) ? htmlspecialchars($_POST['cmb_alamatasal_telp'],ENT_QUOTES) : '';
	$cmb_alamatbdg = isset($_POST['cmb_alamatbdg']) ? htmlspecialchars($_POST['cmb_alamatbdg'],ENT_QUOTES) : '';
	$cmb_alamatbdg_telp = isset($_POST['cmb_alamatbdg_telp']) ? htmlspecialchars($_POST['cmb_alamatbdg_telp'],ENT_QUOTES) : '';
	$cmb_email = isset($_POST['cmb_email']) ? htmlspecialchars($_POST['cmb_email'],ENT_QUOTES) : '';
	$cmb_ortu_nama = isset($_POST['cmb_ortu_nama']) ? htmlspecialchars($_POST['cmb_ortu_nama'],ENT_QUOTES) : '';
	$cmb_ortu_pekerjaan = isset($_POST['cmb_ortu_pekerjaan']) ? htmlspecialchars($_POST['cmb_ortu_pekerjaan'],ENT_QUOTES) : '';
	$cmb_ortu_alamat = isset($_POST['cmb_ortu_alamat']) ? htmlspecialchars($_POST['cmb_ortu_alamat'],ENT_QUOTES) : '';
	$cmb_ortu_alamat_telp = isset($_POST['cmb_ortu_alamat_telp']) ? htmlspecialchars($_POST['cmb_ortu_alamat_telp'],ENT_QUOTES) : '';
	$cmb_pekerjaan_perusahaan = isset($_POST['cmb_pekerjaan_perusahaan']) ? htmlspecialchars($_POST['cmb_pekerjaan_perusahaan'],ENT_QUOTES) : '';
	$cmb_pekerjaan_jabatan = isset($_POST['cmb_pekerjaan_jabatan']) ? htmlspecialchars($_POST['cmb_pekerjaan_jabatan'],ENT_QUOTES) : '';
	$cmb_pekerjaan_alamat = isset($_POST['cmb_pekerjaan_alamat']) ? htmlspecialchars($_POST['cmb_pekerjaan_alamat'],ENT_QUOTES) : '';
	$cmb_pekerjaan_alamat_telp = isset($_POST['cmb_pekerjaan_alamat_telp']) ? htmlspecialchars($_POST['cmb_pekerjaan_alamat_telp'],ENT_QUOTES) : '';
	$cmb_sekolah = isset($_POST['cmb_sekolah']) ? htmlspecialchars($_POST['cmb_sekolah'],ENT_QUOTES) : '';
	$cmb_sekolah_tahun = isset($_POST['cmb_sekolah_tahun']) ? htmlspecialchars($_POST['cmb_sekolah_tahun'],ENT_QUOTES) : '';
	$cmb_sekolah_jurusan = isset($_POST['cmb_sekolah_jurusan']) ? htmlspecialchars($_POST['cmb_sekolah_jurusan'],ENT_QUOTES) : '';
	$cmb_sekolah_alamat = isset($_POST['cmb_sekolah_alamat']) ? htmlspecialchars($_POST['cmb_sekolah_alamat'],ENT_QUOTES) : '';
	$cmb_sekolah_alamat_telp = isset($_POST['cmb_sekolah_alamat_telp']) ? htmlspecialchars($_POST['cmb_sekolah_alamat_telp'],ENT_QUOTES) : '';
	$cmb_kursus = isset($_POST['cmb_kursus']) ? htmlspecialchars($_POST['cmb_kursus'],ENT_QUOTES) : '';
	$cmb_kursus_jurusan = isset($_POST['cmb_kursus_jurusan']) ? htmlspecialchars($_POST['cmb_kursus_jurusan'],ENT_QUOTES) : '';
	$jur_kd = isset($_POST['jur_kd']) ? htmlspecialchars($_POST['jur_kd'],ENT_QUOTES) : '';
	
	
	
	if(empty($cmb_nama) || empty($cmb_tmptlahir) || empty($cmb_tgllahir) || empty($cmb_agama) || empty($cmb_jnskelamin) || empty($cmb_alamatasal) || empty($cmb_alamatasal_telp) || empty($cmb_email) || empty($jur_kd)){
		echo "<script>alert('Semua Field Mandatory (*) Harus Diisi..!!');history.back();</script>";
	}
	else{
		$qu = '';
		if(!empty($ijazah_name)) {
			$ijazah_name_db=date("Ymdhis").'_i_'.substr(permalink($cmb_nama,''),0,40).'.'.get_ext($ijazah_name);
			$qu .= ", cmb_ijazah = '$ijazah_name_db'";
		}
		if(!empty($daftar_nilai_uan_name)) {
			$daftar_nilai_uan_name_db=date("Ymdhis").'_n_'.substr(permalink($cmb_nama,''),0,40).'.'.get_ext($daftar_nilai_uan_name);
			$qu .= ", cmb_daftar_nilai_uan = '$daftar_nilai_uan_name_db'";
		}
		if(!empty($foto_name)) {
			$foto_name_db=date("Ymdhis").'_f_'.substr(permalink($cmb_nama,''),0,40).'.'.get_ext($foto_name);
			$qu .= ", cmb_foto = '$foto_name_db'";
		}
		
		$r=mysql_query("SELECT cmb_ijazah, cmb_daftar_nilai_uan, cmb_foto FROM tbl_cmb WHERE cmb_kd = '$cmb_kd'");
		$d=mysql_fetch_array($r);
		$db = array('cmb_ijazah' => $d['cmb_ijazah'], 'cmb_daftar_nilai_uan' => $d['cmb_daftar_nilai_uan'], 'cmb_foto' => $d['cmb_foto']);
		
		$q="UPDATE tbl_cmb SET cmb_nama='$cmb_nama', cmb_tmptlahir = '$cmb_tmptlahir', cmb_tgllahir = '$cmb_tgllahir', cmb_agama = '$cmb_agama', cmb_jnskelamin = '$cmb_jnskelamin', cmb_alamatasal = '$cmb_alamatasal', cmb_alamatasal_telp = '$cmb_alamatasal_telp', cmb_alamatbdg = '$cmb_alamatbdg', cmb_alamatbdg_telp = '$cmb_alamatbdg_telp', cmb_email='$cmb_email', cmb_ortu_nama ='$cmb_ortu_nama', cmb_ortu_pekerjaan ='$cmb_ortu_pekerjaan', cmb_ortu_alamat = '$cmb_ortu_alamat', cmb_ortu_alamat_telp = '$cmb_ortu_alamat_telp', cmb_pekerjaan_perusahaan = '$cmb_pekerjaan_perusahaan', cmb_pekerjaan_jabatan = '$cmb_pekerjaan_jabatan', cmb_pekerjaan_alamat = '$cmb_pekerjaan_alamat', cmb_pekerjaan_alamat_telp = '$cmb_pekerjaan_alamat_telp', cmb_sekolah = '$cmb_sekolah', cmb_sekolah_tahun = '$cmb_sekolah_tahun', cmb_sekolah_jurusan = '$cmb_sekolah_jurusan', cmb_sekolah_alamat = '$cmb_sekolah_alamat', cmb_sekolah_alamat_telp = '$cmb_sekolah_alamat_telp', cmb_kursus = '$cmb_kursus', cmb_kursus_jurusan = '$cmb_kursus_jurusan', jur_kd = '$jur_kd' $qu WHERE cmb_kd = '$cmb_kd'";
		//echo $q; exit;
		$update=mysql_query($q);
		if($update){
			$status = '21';
			
			//jika ada ijazah, nilai atau foto yang di ganti, maka hapus yang lama dan upload yg baru
			if(!empty($ijazah_name) || !empty($daftar_nilai_uan_name) || !empty($foto_name)) {									
				if(!empty($ijazah_name)) {
					remove_file($dir.$db['cmb_ijazah']);
					upload_resize_image($ijazah_name,$ijazah_path,600,800,$dir.$ijazah_name_db);
				}
				if(!empty($daftar_nilai_uan_name)) {
					remove_file($dir.$db['cmb_daftar_nilai_uan']);
					upload_resize_image($daftar_nilai_uan_name,$daftar_nilai_uan_path,600,800,$dir.$daftar_nilai_uan_name_db);
				}
				if(!empty($foto_name)) {
					remove_file($dir.$db['cmb_foto']);
					upload_resize_image($foto_name,$foto_path,600,800,$dir.$foto_name_db);
				}
			}
			
			//update infos
			mysql_query("DELETE FROM tbl_infos_detail WHERE cmb_kd = '$cmb_kd'");
			$r=mysql_query("SELECT * FROM tbl_infos");
			while($d=mysql_fetch_array($r)){				
				$infos_kd = isset($_POST["infos_$d[infos_kd]"]) ? $_POST["infos_$d[infos_kd]"] : '';
				if(!empty($infos_kd)){
					mysql_query("INSERT INTO tbl_infos_detail(infos_kd,cmb_kd) VALUES('$infos_kd','$cmb_kd')");
				}
			}
			
		}
		else{
			$status = '20';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
	}
break;

/////////////////////////// kode hapus //////////////////
case 'hapus':
	$cmb_kd = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$r=mysql_query("SELECT cmb_ijazah, cmb_daftar_nilai_uan, cmb_foto FROM tbl_cmb WHERE cmb_kd = '$cmb_kd'");
	$d=mysql_fetch_array($r);
	$db = array('cmb_ijazah' => $d['cmb_ijazah'], 'cmb_daftar_nilai_uan' => $d['cmb_daftar_nilai_uan'], 'cmb_foto' => $d['cmb_foto']);
		
	$delete=mysql_query("DELETE FROM tbl_cmb WHERE cmb_kd = '$cmb_kd'");
	if($delete){
		$status = '31';
		remove_file($dir.$db['cmb_ijazah']);
		remove_file($dir.$db['cmb_daftar_nilai_uan']);
		remove_file($dir.$db['cmb_foto']);
	}
	else{
		$status = '30';
	}
	echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
break;

/////////////////////////// kode bayar //////////////////
case 'bayar':
	$cmb_kd = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';		
	$update=mysql_query("UPDATE tbl_cmb SET cmb_status = 'SUDAH BAYAR' WHERE cmb_kd = '$cmb_kd'");
	if($update){
		$status = '41';	
		
		//tambahkan user akun untuk login di tbl_user
		$pass = random_password(7);
		$pass_en = encrypt_password($pass);
		mysql_query("INSERT INTO tbl_user(user_name, user_password, user_defpassword, level_kd, cmb_kd) 
					VALUES('$cmb_kd','$pass_en','$pass','4','$cmb_kd')");	
		
		//kirimkan email data login ke email CMB
		//BELUM	
	}
	else{
		$status = '40';
	}
	echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>