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
mysql_select_db("pendataan_penduduk");

// query SQL untuk menampilkan nama dusun dan jumlah prianya pada tahun 1990

$querydusun = mysql_query("SELECT id_dusun, COUNT(*) FROM table_lbl_dusun") or die(mysql_error());

for($i=1; $i<=$querydusun; $i++){
		$query = mysql_query("SELECT id_jeniskelamin, COUNT(*) FROM table_penduduk where id_dusun = '$i'") or die(mysql_error());
		while($row = mysql_fetch_array($query)){
			
			
		}
		
}

//$has = mysql_query($query);

while ($data = mysql_fetch_array($hasil))
{
    // menambahkan data hasil query ke array
    array_unshift($dataDusun, $data['dusun']);
    array_unshift($dataPria, $data['jmlpria']);
    array_unshift($dataWanita, $data['jmlwanita']);	
}

// membuat image dengan ukuran 400x200 px
$graph = new Graph(400,200,"auto");    
$graph->SetScale("textlin");

// menampilkan diagram batang untuk data pria dengan warna orange
// pada diagram batang ditampilkan value data
$bplot1 = new BarPlot($dataPria);
$bplot1->SetFillColor("orange");
$bplot1->value->show();

// menampilkan diagram batang untuk data wanita dengan warna biru
// pada diagram batang ditampilkan value data
$bplot2 = new BarPlot($dataWanita);
$bplot2->SetFillColor("blue");
$bplot2->value->show();

// mengelompokkan grafik batang berdasarkan pria dan wanita
$gbplot = new GroupBarPlot(array($bplot1,$bplot2));
$graph->Add($gbplot);

// membuat legend untuk keterangan pria dan wanita
$bplot1->SetLegend("Pria");
$bplot2->SetLegend("Wanita");
$graph->legend->Pos(0.05,0.5,"right","center");

// mengatur margin image
$graph->img->SetMargin(40,110,20,40);

// menampilkan title grafik dan nama masing-masing sumbu
$graph->title->Set("Grafik Jumlah Penduduk Dusun Th 1990");
$graph->xaxis->title->Set("Dusun");
$graph->yaxis->title->Set("Jumlah");

// menampilkan nama negara ke sumbu x
$graph->xaxis->SetTickLabels($dataNegara);

// format font title grafik
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// menampilkan efek shadow pada image
$graph->SetShadow();

// menampilkan image ke browser
$graph->Stroke();
?>