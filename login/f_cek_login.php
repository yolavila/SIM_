<?php

/**
 * @author ADMIN
 * @copyright 2011
 */

session_start();
include "f_connect.php";

if (isset($_POST['l_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

$query = "SELECT * FROM admin WHERE username='$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
if(trim($username)== "") {
	echo "<script language='javascript'>
	alert('username Tidak boleh kosong !');
	document.location='?menu=login_admin';
	</script>";
}
else if(trim($password)== "") {
	echo "<script language='javascript'>
	alert('Password Tidak boleh kosong !');
	document.location='?menu=login_admin';
	</script>";
}
 
else if ($password == $data['password'])
{ 
    $_SESSION['level'] = $data['level'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['status'] = $data['status'];
	$_SESSION['nama'] = $data['nama_adm'];
    echo("<meta http-equiv='refresh' content='0;index.php'>");
}
else echo "<script language='javascript'>
	alert('Invalid Username / Password')
	document.location='?menu=login_admin';
	</script>";
	
} else if (isset($_POST['l_dosen'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

$query = "SELECT * FROM dosen WHERE nip_dsn='$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

if(trim($username)== "") {
	echo "<script language='javascript'>
	alert('username Tidak boleh kosong !');
	document.location='?menu=login_dosen';
	</script>";
}
else if(trim($password)== "") {
	echo "<script language='javascript'>
	alert('Password Tidak boleh kosong !');
	document.location='?menu=login_dosen';
	</script>";
}
 
else if ($password == $data['password'])
{ 
    $_SESSION['level'] = $data['level'];
    $_SESSION['username'] = $data['nip_dsn'];
    $_SESSION['status'] = $data['status'];
	$_SESSION['nama'] = $data['nama_dsn'];
    echo("<meta http-equiv='refresh' content='0;index.php'>");
}
else echo "<script language='javascript'>
	alert('Invalid Username / Password')
	document.location='?menu=login_admin';
	</script>";
}else if (isset($_POST['l_mahasiswa'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

$query = "SELECT * FROM mahasiswa WHERE username='$username'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);

if(trim($username)== "") {
	echo "<script language='javascript'>
	alert('username Tidak boleh kosong !');
	document.location='?menu=login_mahasiswa';
	</script>";
}
else if(trim($password)== "") {
	echo "<script language='javascript'>
	alert('Password Tidak boleh kosong !');
	document.location='?menu=login_mahasiswa';
	</script>";
}
 
else if ($password == $data['password'])
{ 
    $_SESSION['level'] = $data['level'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['status'] = $data['status'];
	$_SESSION['nama'] = $data['nama_mhs'];
    echo("<meta http-equiv='refresh' content='0;index.php'>");
}

else echo "<script language='javascript'>
	alert('Invalid Username / Password')
	document.location='?menu=login_mahasiswa';
	</script>";
}
?>