<?php

$server='localhost';
$user='root';
$password='';
$database='db_akun';

$koneksi=mysql_connect($server,$user,$password)
		or die('Koneksi ke MySQL GAGAL..!');
		
$bukadb=mysql_select_db($database)
		or die('Koneksi ke Database: '.$database.' GAGAL..!');
?>