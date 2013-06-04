<?php
include ("modul/jpgraph.php");
include ("modul/jpgraph_line.php");

// membuat array inisial untuk jumlah penduduk dan tahunnya
$dataJum = array();
$dataTh = array();

// koneksi ke db
mysql_connect("localhost","root","");
mysql_select_db("pendataan_penduduk");

// query SQL untuk mencari jumlah total penduduk untuk setiap tahun pada Dusun A
$query = "SELECT tahun, jmlpria + jmlwanita as jum FROM table_penduduk WHERE dusun = 'id_dusun'";
$hasil = mysql_query($query);
while ($data = mysql_fetch_array($hasil))
{
    // hasil data query ditambahkan ke dalam array jumlah pendudukan dan tahun
    array_unshift($dataJum, $data['jum']);
    array_unshift($dataTh, $data['tahun']);
}

// membuat grafik dengan size 300x200 px
$graph = new Graph(300,200,"auto");    
$graph->SetScale("textlin");

// menampilkan data jumlah penduduk ke dalam plot garis
$lineplot=new LinePlot($dataJum);
$graph->Add($lineplot);

// mengatur margin plot
$graph->img->SetMargin(40,20,20,40);

// menampilkan title dari grafik
$graph->title->Set("Grafik Jumlah Penduduk Dusun A");

// menampilkan label pada sumbu x grafik
$graph->xaxis->title->Set("Tahun");

// menampilkan label pada sumbu y grafik
$graph->yaxis->title->Set("Jumlah");

// menampilkan titik data pada sumbu x (tahun)
$graph->xaxis->SetTickLabels($dataTh);

// mengatur jenis font pada title grafik
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// memberi warna biru pada plot garis
$lineplot->SetColor("blue");

// memberikan efek shadow pada image
$graph->SetShadow();

// tampilkan grafik ke browser
$graph->Stroke();
?>