<?php
//mengambil session user_kd 
$user_level_kd = isset($_SESSION['user_level_kd']) ? $_SESSION['user_level_kd'] : '';

if($user_level_kd == '1'){ //Bagian Pendaftaran
	echo "<h3>Welcome</h3>
		<div class='quoteOfDay'>
			<b>".get_data_user('nama')."</b><br/>
			<i style='color: #5b5b5b;'>Login As $_SESSION[user_level]</i>
		</div>
		";
}
else if($user_level_kd == '2'){ //Bagian Pendaftaran
	echo "<h3>Welcome</h3>
		<div class='quoteOfDay'>
			<b>".get_data_user('nama')."</b><br/>
			<i style='color: #5b5b5b;'>Login As $_SESSION[user_level]</i>
			</div>
<br>
<br>
<br>
<br>
<br>
<br>
		<p><b class='sisip'>Computer Based Test STEI TAZKIA Bertujuan Untuk :</b>
		<ol>
		<li>Membantu efisiensi proses Ujian Masuk calon Mahasiswa baru</li>
		<li>Mempercepat Proses Penilaian dan penentuan Grade</li>
		<li>Randomisasi soal sehingga memungkinkan para peserta mengerjakan soal yg berbeda</li>		
		
		</ol>
		Selamat bekerja dan awali dengan <b class='sisip'>Bismillahirrahmaanirrahiim.</b>
		</p><div style='margin-bottom:10px; height:1px'/></div>
		";
}
else{
	echo "<h3>Selamat Datang</h3>

		<p><b class='sisip'>Peserta Computer Based Test STEI TAZKIA</b>
		<ol>
		<li>Peserta yang mengikuti Ujian Computer Based Test (CBT) adalah Mahasiswa Program Studi Akuntansi Islam Semester Delapan</li>
		<li>Soal terdiri dari 50 soal.</li>
		<li>Tidak ada pengurangan jika ada kesalahan dalam menjawab soal.</li>		
		<li>Waktu ujian adalah 1 jam.</li>
		<li>Jika telah menekan tombol <b class='sisip'>confirm</b> maka dianggap telah menjawab soal.</li>
		<li>Ujian dianggap selesai apabila peserta ujian menekan tombol <b class='sisip'>finish</b> di sebelah kanan bawah.</li>
		<li>Pengumuman Hasil ujian diumumkan melalui Website Prodi 3 hari kerja setelah pelaksanaan ujian.</li>
		
		</ol>
		Selamat melaksanakan ujian dan awali dengan <b class='sisip'>Bismillahirrahmaanirrahiim.</b>Semoga mendapatkan hasil yang terbaik.
		</p><div style='margin-bottom:10px; height:1px'/></div>";


}

?>