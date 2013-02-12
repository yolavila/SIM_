<link rel="stylesheet" href="css/Envision.css" type="text/css">
<?php
// membaca file koneksi.php
	include "../db_config.php";
//	include 'include/opendb.php';
	
	//echo "<h3>Database: ".$dbname."</h3>";
	//echo "<h3>Daftar Tabel</h3>";
	// query untuk menampilkan semua tabel dalam database
	$query = "SHOW TABLES";
	$hasil = mysql_query($query);
	// menampilkan semua tabel dalam form
	echo "<form method='post' action='backup_proses.php'>";
	echo "<table><tr>";
	while ($data = mysql_fetch_row($hasil)){
			echo "<tr><td><input type='checkbox' name='tabel[]' value='".$data[0]."' checked></td><td>".$data[0]."</td></tr>";
		}
	echo "</table><br>";
	echo "<input type='submit' name='submit' value='Backup Data'>";
	echo "<a href='../admin.php'  onclick='self.history.back()'><input type='button' name='exit' value='Exit'></a>";
	echo "</form>";
?>