<?php
session_start();
if(!isset($_SESSION['npa'])){
	echo "Apakah anda Sudah Login??";
	}
	else {
	
		include("db_config.php");
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Koperasi Multiguna</title>
<meta name="keywords" content="mini social, free download, website templates, CSS, HTML" />
<meta name="description" content="Mini Social is a free website template from templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/coda-slider.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery-1.2.6.js" type="text/javascript"></script>
</head>
<body>

<div id="slider">

	<?php
		if($_SESSION['level']==0){
			$levelx = "Admin";
		}else if ($_SESSION['level']==1){
			$levelx = "ketua";
		}else if ($_SESSION['level']==2){
			$levelx = "usp";
		}else if ($_SESSION['level']==3){
			$levelx = "toko";
		}else{
			$levelx = "anggota";
		}
?>
    <div id="templatemo_sidebar">
    <div id="templatemo_header">
	<h1><b><img src="images/images.jpg" width="200px" height="100px"></b></h1>
        	<!--<a href="http://www.templatemo.com" target="_parent"><img src="images/templatemo_logo.png" alt="Mini Social" /></a>-->
        </div> <!-- end of header -->
        
        <ul class="navigation">
<?php
		$userxxx = $_SESSION['npa'];
		$sql = mysql_query("SELECT * FROM user WHERE username = '$userxxx' LIMIT 0, 1") or die(mysql_error());
		$rsql = mysql_fetch_array($sql);
		//echo $rsql['admin'];
		if ($rsql['admin'] == 1)
{
		echo "<li><a href='admin.php?menu=setup_utility'>Admin<span class='ui_icon admin'></span></a></li>";
}
		if ($rsql['ketua'] == 1)
{
		echo "<li><a href='admin.php?menu=ketua'>Ketua<span class='ui_icon ketua'></span></a></li>";
}
		if ($rsql['usp'] == 1)
{
		echo "<li><a href='admin.php?menu=usp'>USP<span class='ui_icon usp'></span></a></li>";
}
		if ($rsql['toko'] == 1)
{
		echo "<li><a href='admin.php?menu=toko'>Toko<span class='ui_icon gallery'></span></a></li>";
}
		if ($rsql['anggota'] == 1)
{
		echo "<li><a href='admin.php?menu=anggota'>Anggota<span class='ui_icon gallery'></span></a></li>";
}
		echo "<li><a href='logout.php'>Logout<span class='ui_icon logout'></span></a></li>";
?>
  </ul>
		
    </div> <!-- end of sidebar -->
			
			
	
	<div id="templatemo_main">
    	<ul id="social_box">
            <h1><b><center>Selamat Datang <?php echo $_SESSION['nama'];?></b></h1></center>
			<h4><center>Jangan lupa mengubah password Anda, Demi keamanan data Anda !!!</center></h4>

			</ul>
        
        <div id="content">
        
        <!-- scroll -->
        
        	
            <div class="scroll">
                <div class="scrollContainer">
				
				<div class="panel" id="home">
					<?php
					$page=$_GET['menu'];
						if ($page==""){
							if($_SESSION['level']==0){
								$halxx = "setup_utility";
							}else if ($_SESSION['level']==1){
								$halxx = "ketua";
							}else if ($_SESSION['level']==2){
								$halxx = "usp";
							}else if ($_SESSION['level']==3){
								$halxx = "toko";
							}else{
								$halxx = "anggota";
							}
							include "admin/$halxx.php";
						}else{
							include "admin/".$page.".php";
						}
					?>
				</div> <!-- end of home -->            
        </div> <!-- end of content -->
        
        <div id="templatemo_footer">
           Sistem Informasi Koperasi Multiguna
		</div> <!-- end of templatemo_footer -->
    
    </div> <!-- end of main -->
</div>

</body>
</html>
<?php
			};
			?>