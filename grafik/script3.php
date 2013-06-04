<?php
include ("modul/jpgraph.php");
include ("modul/jpgraph_line.php");
include ("modul/jpgraph_bar.php");

// inisialisasi array untuk jumlah pria, wanita dan dusun

$dataPria = array();
$dataWanita = array();
$dataDusun = array();

// koneksi ke mysql

mysql_connect("localhost","root","");
mysql_select_db("sim");

// query SQL untuk menampilkan nama dusun, jumlah pria dan wanita

	$dusun = mysql_query("SELECT * FROM table_lbl_dusun") or die(mysql_error());
	$jmldusun = mysql_num_rows($dusun);
	
	$kelamin = mysql_query("SELECT * FROM table_jenis_kelamin") or die(mysql_error());
	$jmlkelamin = mysql_num_rows($kelamin);
	
	for($i=1; $i<=$jmldusun; $i++){ 
		$dusun = mysql_query("SELECT * FROM table_lbl_dusun WHERE id_dusun = '$i' ") or die(mysql_error());
		while($namadusun = mysql_fetch_array($dusun)){
			array_unshift($dataDusun, $namadusun['dusun']);
			//echo $namadusun['dusun'];
		}
			for($j=1; $j<=$jmlkelamin; $j++){
				$kelamin = mysql_query("SELECT id_jeniskelamin FROM table_penduduk WHERE id_dusun = '$i' AND id_jeniskelamin = '$j'") or die(mysql_error());
				if($j == 1){
					$jml = mysql_num_rows($kelamin);
					array_unshift($dataPria, $jml);
				} else {
					$jml = mysql_num_rows($kelamin);
					array_unshift($dataWanita, $jml);	
				}
				//echo $jml;
			}
	}
/*
$query = "SELECT dusun, jmlpria, jmlwanita FROM table_penduduk WHERE tahun = '1986' ORDER BY dusun DESC";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
    // menambahkan data hasil query ke array
    array_unshift($dataDusun, $data['dusun']);
    array_unshift($dataPria, $data['jmlpria']);
    array_unshift($dataWanita, $data['jmlwanita']);	
}
*/
// membuat image dengan ukuran 400x200 px
$graph = new Graph(450,300,"auto");    
$graph->SetScale("textlin");

// menampilkan diagram batang untuk data pria dengan warna blue
// pada diagram batang ditampilkan value data
$bplot1 = new BarPlot($dataPria);
$bplot1->SetFillColor("blue");
$bplot1->value->show();

// menampilkan diagram batang untuk data wanita dengan warna violet
// pada diagram batang ditampilkan value data
$bplot2 = new BarPlot($dataWanita);
$bplot2->SetFillColor("violet");
$bplot2->value->show();

// mengelompokkan grafik batang berdasarkan pria dan wanita
$gbplot = new GroupBarPlot(array($bplot1,$bplot2));
$graph->Add($gbplot);

// membuat legend untuk keterangan pria dan wanita
$bplot1->SetLegend("Pria");
$bplot2->SetLegend("Wanita");
$graph->legend->Pos(0.05,0.5,"right","center");

// mengatur margin image
$graph->img->SetMargin(40,110,40,50);

// menampilkan title grafik dan nama masing-masing sumbu
$graph->title->Set("Grafik Jumlah Penduduk PerDusun");
$graph->xaxis->title->Set("Dusun");
$graph->yaxis->title->Set("Jumlah");

// menampilkan nama dusun ke sumbu x
$graph->xaxis->SetTickLabels($dataDusun);

// format font title grafik
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// menampilkan efek shadow pada image
$graph->SetShadow();

// menampilkan image ke browser
$graph->Stroke();
?>