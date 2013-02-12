<?php

/**
 * @author ADMIN
 * @copyright 2011
 */
 include "f_connect.php";
 if (isset($_POST['submit'])){
$id_mhs = $_POST['id_mhs'];
$bayar_mhs = $_POST['bayar_mhs'];
$nama_mhs = $_POST['nama_mhs'];
$nim_mhs = $_POST['nim_mhs'];
$fk_mhs = $_POST['fk_mhs'];
$jrs_mhs = $_POST['jrs_mhs'];
$password = $_POST['password'];
$ang	=$_POST['angkatan'];
$email = $_POST['email'];
$tgl = date("d M Y");
if(trim($password)== "") {
	echo "<script language='javascript'>
	alert('Password Tidak boleh kosong !');
	onclick=history.back();
	</script>";
	
} else if (trim($email)== "") {
	echo "<script language='javascript'>
	alert('Email Tidak boleh kosong !');
	onclick=history.back();
	</script>";

} else {
    $check=mysql_query("select * from mahasiswa where nim_mhs='$nim_mhs'");
    $row = mysql_fetch_array($check);
    if (!mysql_num_rows($check) == 1){
    $simpan = mysql_query("insert into mahasiswa Set
    nim_mhs = '$nim_mhs',
    bayar_mhs = '$bayar_mhs',
    nama_mhs = '$nama_mhs',
    fk_mhs = '$fk_mhs',
    jrs_mhs = '$jrs_mhs',
	angkatan ='$ang',
    username = '$nim_mhs',
    password = '$password',
    email = '$email',
    tgl_daftar = '$tgl'");
	echo "<script language='javascript'>
	alert('Selamat $nama_mhs, Anda telah terdaftar dengan ID. System akan mengarahkan anda pada menu login.');
	document.location='?menu=masuk';
	</script>";
	
    } else {
    echo "<script language='javascript'>
	alert('Anda telah terdaftar dengan ID $row[id_mhs] pada tanggal $row[tgl_daftar]. System akan mengarahkan anda pada menu login');
	document.location='?menu=masuk';
	</script>";
    }
}
}
?>