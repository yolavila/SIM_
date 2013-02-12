<?php

if ($_POST['btnOK'])
	{
	include '../db_config.php';
	$filex_namex = strtolower($_FILES['datafile']['name']);

	//nek null
	if (empty($filex_namex))
		{
		//null-kan
		xclose($koneksi);

		//re-direct
		echo "<script>alert('Input Tidak Lengkap. Harap Diulangi...!!')</script>";
?>
		<meta http-equiv="refresh" content="0; url=home.php?page=modul/backup/restore">
<?php
		}
	else
		{
		//deteksi .sql
		$ext_filex = substr($filex_namex, -4);

		if ($ext_filex == ".sql")
			{
			//upload dahulu...
			move_uploaded_file($_FILES['datafile']['tmp_name'],"modul/backup/$filex_namex");


			//restore database //////////////////////////////////////////////////////////////////////////////////////////////////////////
			//require
			require("mysql_restore.php");

			//koneksi
			$link_db = @mysql_connect($server, $username, $password);


			//restore
			mysql_select_db($database);
			$query_db = fread(fopen("modul/backup/$filex_namex", "r"), filesize("modul/backup/$filex_namex"));
			$mqr = @get_magic_quotes_runtime();
			@set_magic_quotes_runtime(0);
			@set_magic_quotes_runtime($mqr);
			$pieces  = split_sql2($query_db);

			for ($i=0; $i<count($pieces); $i++)
				{
				$pieces[$i] = trim($pieces[$i]);

				if(!empty($pieces[$i]) && $pieces[$i] != "#")
					{
					$pieces[$i] = str_replace( "#__", '', $pieces[$i]);

					if (!$result = mysql_query ($pieces[$i]))
						{
						$errors[] = array ( mysql_error(), $pieces[$i] );
						}
					}
				}

			//hapus file yang telah di-upload dan di-restore
			$path1 = "modul/backup/$filex_namex";
			unlink ($path1);

			//re-direct
			echo "<script>alert('Import Berhasil Dilakukan. Silahkan Lakukan Penyalinan/Copy Folder FileBox ke Folder Web ini. Terima Kasih.')</script>";
?>
		<meta http-equiv="refresh" content="0; url=home.php?page=modul/backup/restore">
<?php
			}
		else
			{
			//salah
			echo "<script>alert('Bukan File .sql . Harap Diperhatikan...!!')</script>";	
?>
		<meta http-equiv="refresh" content="0; url=home.php?page=modul/backup/restore">
<?php
			}
		}
	}
 
echo "<h3>Restore Database klinik gigi</h3>";
 
//echo "DB Name: ".$dbName;
 
// form upload file dumo
echo "<br><br><form enctype='multipart/form-data' method='post' action='".$_SERVER['PHP_SELF']."?page=modul/backup/restore&action=view'>";
echo "<input name='datafile' type='file'>
      <input name='btnOK' type='submit' onClick=\"return confirm ('Apakah Anda yakin akan melakukan restore data ??')\" value='Restore'>";
echo "</form>";
 
 
?>