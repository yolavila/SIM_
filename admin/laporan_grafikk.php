<?php
include "f_connect.php";
include("class/FusionCharts_Gen.php");
$tanggal=$_POST['tanggal'];
$tanggal1=$_POST['tanggal1'];

?>
<html>
  <head>
    <title>First Chart Using FusionCharts PHP Class</title>
    <script language='javascript' src='js/FusionCharts.js'></script>
  </head>
  <body>

  <?php
  # Include FusionCharts PHP Class
  # Create object for Column 3D chart
  $FC = new FusionCharts("Column3D","800","350");

  # Setting Relative Path of chart swf file.
  $FC->setSwfPath("Charts/");

  # Store chart attributes in a variable
  $strParam="caption=Applicant Fulfillment Graph; xAxisName=Status ;yAxisName=Jumlah Applicant;decimalPrecision=0; formatNumberScale=0";

  # Set chart attributes
  $FC->setChartParams($strParam);
  
  $kategori = mysql_query("SELECT id_status, status FROM status");
  //$tracking = mysql_query("SELECT Nama_Karyawan FROM master_karyawan WHERE Kode_Nama_Cabang='SRJ' AND Category_Tracking='sales'");
while ($r_kat = mysql_fetch_array($kategori)){
	
	$id_kat = $r_kat['id_status'];
	$kat = $r_kat['status'];

	$counter1 = 0;


	    	
			 //$total = mysql_num_rows(mysql_query("SELECT IdKat,TglTerjual FROM penjualan_buku WHERE IdKat='$kat' AND LEFT(TglTerjual,4)='2012' AND  MID(TglTerjual,6,2)='02'"));
			 $total = mysql_query("SELECT status FROM applicant WHERE status='$id_kat' and tanggal between '$tanggal' AND '$tanggal1'");
			 
			 $counter1++;
    		

	//$persentase = ($total!=0 || $review !=0)?($review / $total) *100:0;
	$total = mysql_num_rows($total);
	

  # add chart values and category names
  $FC->addChartData("$total","name=$kat");
 
}
    # Render Chart
    $FC->renderChart();
  ?>
	<h3>Dari <?php echo $tanggal; ?> sampai <?php echo $tanggal1; ?></h3>
  </body>
</html>