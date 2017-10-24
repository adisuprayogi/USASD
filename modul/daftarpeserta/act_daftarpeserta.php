<?php
include '../../include/connection.php';
include '../../include/function.php';
include '../../include/reader.php';

$menu = 'daftarpeserta';
$act = isset($_GET['act']) ? $_GET['act'] : '';
$status = '';

switch($act){
/////////////////////////// kode simpan //////////////////
case 'simpan':

	//$tahun = isset($_POST['tahun']) ? htmlspecialchars($_POST['tahun'],ENT_QUOTES) : '';
	$rn = isset($_POST['rn']) ? htmlspecialchars($_POST['rn'],ENT_QUOTES) : '';
	//$tempat = isset($_POST['tempat']) ? htmlspecialchars($_POST['tempat'],ENT_QUOTES) : '';
	$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama'],ENT_QUOTES) : '';
	//$tgl_lahir = isset($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir'],ENT_QUOTES) : '';
	//$tgl_lahir = format_tgl($tgl_lahir,'yyyy-mm-dd');
	//$agama = isset($_POST['agama']) ? htmlspecialchars($_POST['agama'],ENT_QUOTES) : '';
	//$jk = isset($_POST['jk']) ? htmlspecialchars($_POST['jk'],ENT_QUOTES) : '';
	$jadwal = isset($_POST['jadwal']) ? htmlspecialchars($_POST['jadwal'],ENT_QUOTES) : '';
	$pass = isset($_POST['pass']) ? htmlspecialchars($_POST['pass'],ENT_QUOTES) : '';
	
	if(empty($rn) || empty($nama) || empty($jadwal)){
		echo "<script>alert('data tidak lengkap');window.history.back();</script>";
	}
	else{
		$insert=mysql_query("INSERT INTO tbl_cmb (cmb_kd,gel_kd,cmb_nama,cmb_status,id_jujian)values('$rn','$rn','$nama','A','$jadwal')");
		
		$insert2=mysql_query("INSERT INTO master_ujian (mhswid,krsid,id_jujian,PASSWORD,STATUS,utsuas,st)values('$rn','-','$jadwal','-','N','P','N')");
		
		$pass_en = encrypt_password($pass);
			$insert3=mysql_query("insert into tbl_user (user_name,user_password,level_kd,cmb_kd)values('$rn','$pass_en','26','$rn')");
			
		if($insert || $insert2 || $insert3){
			$status = '11';
		}
		else{
			$status = '10';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
	}
break;

/////////////////////////// kode update //////////////////
case 'update':
	
	$idj = isset($_POST['idj']) ? htmlspecialchars($_POST['idj'],ENT_QUOTES) : '';
	$idju = isset($_POST['idju']) ? htmlspecialchars($_POST['idju'],ENT_QUOTES) : '';
	$idju = isset($_POST['idu']) ? htmlspecialchars($_POST['idu'],ENT_QUOTES) : '';
	$rn = isset($_POST['rn']) ? htmlspecialchars($_POST['rn'],ENT_QUOTES) : '';
	//$tempat = isset($_POST['tempat']) ? htmlspecialchars($_POST['tempat'],ENT_QUOTES) : '';
	$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama'],ENT_QUOTES) : '';
	//$tgl_lahir = isset($_POST['tgl_lahir']) ? htmlspecialchars($_POST['tgl_lahir'],ENT_QUOTES) : '';
	//$tgl_lahir = format_tgl($tgl_lahir,'yyyy-mm-dd');
	//$agama = isset($_POST['agama']) ? htmlspecialchars($_POST['agama'],ENT_QUOTES) : '';
	//$jk = isset($_POST['jk']) ? htmlspecialchars($_POST['jk'],ENT_QUOTES) : '';
	$jadwal = isset($_POST['jadwal']) ? htmlspecialchars($_POST['jadwal'],ENT_QUOTES) : '';
	$pass = isset($_POST['pass']) ? htmlspecialchars($_POST['pass'],ENT_QUOTES) : '';
	
	if(empty($rn) || empty($nama) || empty($jadwal)){
		echo "<script>alert('data tidak lengkap');window.history.back();</script>";
	}
	else{
		$update=mysql_query("update tbl_cmb set cmb_kd='$rn',gel_kd='$rn',cmb_nama='$nama' ,id_jujian='$jadwal' where cmb_kd='$idj' and id_ujian='$idu'");
		
		$update2=mysql_query("update master_ujian set mhswid='$rn',krsid='-',id_jujian='$jadwal',PASSWORD='-' where mhswid='$idj' and id_jujian='$idju'");
		
		if (empty($pass)){
		$update3=mysql_query("update tbl_user set user_name='$rn',cmb_kd='$rn' where cmd_kd='$idj'");
		}else{
		$pass_en = encrypt_password($pass);
			$update3=mysql_query("update tbl_user set user_name='$rn',user_password='$pass_en',cmb_kd='$rn' where cmd_kd='$idj'");
		}
			
		if($update || $update2 || $update3){
			$status = '31';
		}
		else{
			$status = '30';
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
	}
break;

/////////////////////////// kode hapus //////////////////
case 'hapus':
	$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'],ENT_QUOTES) : '';
	$idu = isset($_GET['idu']) ? htmlspecialchars($_GET['idu'],ENT_QUOTES) : '';
	
	$update=mysql_query("update tbl_cmb set cmb_status='D' where cmb_kd='$id' and id_ujian='$idu'");
		
		$update2=mysql_query("update master_ujian set status='D' where mhswid='$id' and id_ujian='$idu'");
		
			$update3=mysql_query("delete from tbl_user where cmb_kd='$id'");
			
		if($update || $update2 || $update3){
			$status = '21';
		}
		else{
			$status = '20';
		}
	echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
break;

case 'import':
$jadwal = isset($_POST['jadwal']) ? htmlspecialchars($_POST['jadwal'],ENT_QUOTES) : '';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');

// Ambil Value Dari Inputan Form
$fileexcel = $_FILES['userfile']['tmp_name'];
$data->read($fileexcel);
 
for ($x=2; $x <= count($data->sheets[0]["cells"]); $x++) {
    // Mendefinisikan Shell dalam File Excel Sejumlah Field yang ada di tabel
    $nim = $data->sheets[0]["cells"][$x][2];
 $nama = $data->sheets[0]["cells"][$x][3];
    $pass = $data->sheets[0]["cells"][$x][4];
 //$alamat = $data->sheets[0]["cells"][$x][4];
 // Simpan Ke Tabel
   $insert=mysql_query("INSERT INTO tbl_cmb (cmb_kd,gel_kd,cmb_nama,cmb_status,id_jujian)values('$nim','$nim','$nama','A','$jadwal')");
		
		$insert2=mysql_query("INSERT INTO master_ujian (mhswid,krsid,id_jujian,PASSWORD,STATUS,utsuas,st)values('$nim','-','$jadwal','-','N','P','N')");
		
		$pass_en = encrypt_password($pass);
			$insert3=mysql_query("insert into tbl_user (user_name,user_password,level_kd,cmb_kd)values('$nim','$pass_en','26','$nim')");
			
		if(!$insert || !$insert2 || !$insert3){
 echo "Data Ke ".$x." GAGAL disimpan!";
 }
}
echo "<script>alert('Data Berhasil di Import!'); history.go(-1);</script>";
break;


case 'import2':
// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
$jadwal = isset($_POST['jadwal']) ? htmlspecialchars($_POST['jadwal'],ENT_QUOTES) : '';
// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);
// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
for ($i=2; $i<=$baris; $i++)
{
// membaca data nim (kolom ke-1)
$nim = $data->val($i, 1);
// membaca data nama (kolom ke-2)
$nama = $data->val($i, 2);
// membaca data alamat (kolom ke-3)
$pass = $data->val($i, 3);
// setelah data dibaca, sisipkan ke dalam tabel mhs
//$query = "INSERT INTO mhs VALUES ('$nim', '$nama', '$alamat')";

$insert=mysql_query("INSERT INTO tbl_cmb (cmb_kd,gel_kd,cmb_nama,cmb_status,id_jujian)values('$nim','$nim','$nama','A','$jadwal')");
		
		$insert2=mysql_query("INSERT INTO master_ujian (mhswid,krsid,id_jujian,PASSWORD,STATUS,utsuas,st)values('$nim','-','$jadwal','-','N','P','N')");
		
		$pass_en = encrypt_password($pass);
			$insert3=mysql_query("insert into tbl_user (user_name,user_password,level_kd,cmb_kd)values('$nim','$pass_en','26','$rn')");
			
		if($insert || $insert2 || $insert3){
			$sukses++;
		}
		else{
			$gagal++;
		}
		echo "<meta http-equiv='Refresh' content='0; URL=../../index.php?m=$menu&status=$status'/>";
		
//$hasil = mysql_query($query);
// jika proses insert data sukses, maka counter $sukses bertambah
// jika gagal, maka counter $gagal yang bertambah
//if ($hasil) $sukses++;
//else $gagal++;
}
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
break;

////////////// lainnya /////////////
default:
echo "--------------";
break;	
}

?>