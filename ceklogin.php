<?php
include_once "db_config.php";
session_start();

$npa= $_POST['myusername'];
$pass = md5($_POST['mypassword']);

$query = "SELECT * FROM anggota WHERE npa = '$npa' && password = '$pass'";
$hasil = mysql_query($query);
$num = mysql_num_rows($hasil);

if ($num==1){
	$data = mysql_fetch_array($hasil);
    $_SESSION['npa'] = $data['npa'];
	$_SESSION['nama'] = $data['nama'];
	$_SESSION['npa'] = $data['npa'];
	$_SESSION['level'] = $data['level'];
	if($_SESSION['level'] == 4)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/admin.php?menu=anggota\"> ";
	}
	if($_SESSION['level'] == 3)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/admin.php?menu=toko\"> ";
	}
	if($_SESSION['level'] == 2)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/admin.php?menu=usp\"> ";
	}
	if($_SESSION['level'] == 1)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/admin.php?menu=ketua\"> ";
	}
	if($_SESSION['level'] == 0)
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=http://localhost/skripsi/admin.php?menu=setup_utility\"> ";
	}
	//header('Location:admin.php');


}else{ 
?><script language="Javascript">
	alert('npa/Password anda salah');
	document.location='index.php';
</script>
<?php
};

?>