<?php
session_start();
require_once "db_config.php";

$passwordlama = md5($_POST['passwordlama']);
$passwordbaru = md5($_POST['passwordbaru']);
$konfirmasipassword = md5($_POST['konfirmasipassword']);

$npa = $_SESSION['npa'];

if ($passwordbaru == $konfirmasipassword){
$cekuser = "select * from anggota where npa = '$npa' and password = '$passwordlama'";

$querycekuser = mysql_query($cekuser) or die(mysql_error());

$count = mysql_num_rows($querycekuser);
echo "$count";
if ($count >= 1){

$updatepassword = "update anggota set password = '$passwordbaru' where npa = '$npa'";

$updatequery = mysql_query($updatepassword) or die(mysql_error());

if($updatequery){
echo "Password telah diganti";
echo "<meta http-equiv='refresh' content='2;url=http://localhost/skripsi/admin.php'>"; 

}

}
}else{
	echo "password baru dan konfirmasi password baru tidak sama!!";
	echo "<meta http-equiv='refresh' content='2;url=http://localhost/skripsi/admin.php'>"; 
}

?>