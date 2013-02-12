<?php
require('fpdf.php');
require("../../db_config.php");

class PDF extends FPDF
{

function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}


// Page header
function Header()
{
	$jdlLaporan = $_POST['jdlLaporan'];
	$blnLaporan = $_POST['bulan'];
	$thnLaporan = $_POST['tahun'];
	$cetak = $_POST['tglCetak'];
	if($blnLaporan != "")
	{
		$periodeLaporan = $blnLaporan." ".$thnLaporan;
	} else
	{
		$periodeLaporan = $thnLaporan;
	}
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(150);
    // Title
    $this->Cell(30,10,'Laporan Penjualan Barang',0,0,'C');
	
	$this->Ln(3);
	
	$this->Cell(150);
	$this->Cell(30,20,'KOPERASI MULTIGUNA KECAMATAN PANEKAN',0,0,'C');
	$this->Cell(-30,35,"PERIODE : ".$periodeLaporan,0,0,'C');
	$this->Cell(300,5,"Cetak : ".$cetak,0,0,'C');

    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	  //$this->Cell(0,5,'Panekan, '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
}

//Create new pdf file
$pdf=new PDF('L','mm','Legal');;

//Open file
//$pdf->Open();

//$pdf->AliasNbPages();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
//$pdf->AddPage();

//$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$y_axis_initial = 40;
$row_height = 12;

//print column titles for the actual page
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetY($y_axis_initial);
$pdf->SetX(40);
//$a = $pdf->WriteHTML('Nomer<br>Simpanan');
$pdf->Cell(30, 12, 'NJB', 1, 0, 'C', 1);
$pdf->Cell(30, 12, 'NPA', 1, 0, 'C', 1);
$pdf->Cell(30, 12, 'NAMA', 1, 0, 'C', 1);
$pdf->Cell(30, 12, 'ID BARANG', 1, 0, 'C', 1);
$pdf->Cell(60, 12, 'NAMA BARANG', 1, 0, 'C', 1);
$pdf->Cell(30, 12, 'QUATITY', 1, 0, 'C', 1);
$pdf->Cell(30, 12, 'STATUS', 1, 0, 'C', 1);
$pdf->Cell(30, 12, 'TANGGAL JUAL', 1, 0, 'C', 1);

//Select the Products you want to show in your PDF file
$table = $_POST['nmTabel'];
$blnLaporan = $_POST['bulan'];
if($blnLaporan == 1){
		$blnLaporan = "Januari";
	}
	if($blnLaporan == 2){
		$blnLaporan = "Februari";
	}
	if($blnLaporan == 3){
		$blnLaporan = "Maret";
	}
	if($blnLaporan == 4){
		$blnLaporan = "April";
	}
	if($blnLaporan == 5){
		$blnLaporan = "Mei";
	}
	if($blnLaporan == 6){
		$blnLaporan = "Juni";
	}
	if($blnLaporan == 7){
		$blnLaporan = "Juli";
	}
	if($blnLaporan == 8){
		$blnLaporan = "Agustus";
	}
	if($blnLaporan == 9){
		$blnLaporan = "September";
	}
	if($blnLaporan == 10){
		$blnLaporan = "Oktober";
	}
	if($blnLaporan == 11){
		$blnLaporan = "November";
	}
	if($blnLaporan == 12){
		$blnLaporan = "Desember";
	}
$thnLaporan = $_POST['tahun'];
if($blnLaporan != "")
{
$result=mysql_query("select njb, id_barang, nama_barang, quatity, status, tgl_jual from ".$table."  where month(tgl_jual) = ".$_POST['bulan']." AND year(tgl_jual) = '$thnLaporan'  ORDER BY njb");
}
else
{
//echo "SELECT m.nama as nambar, m.harga_jual, p.nama as namsup, s.* FROM ".$table." s Left Join master_barang m  on s.id_barang=m.id_barang left join anggota p  on p.npa=s.npa where year(tgl) = '$thnLaporan' ORDER BY njb";
$result=mysql_query("SELECT m.nama as nambar, m.harga_jual, p.nama as namang, s.* FROM ".$table." s Left Join master_barang m on s.id_barang=m.id_barang left join anggota p on p.npa=s.npa where year(tgl_jual) = '$thnLaporan' ORDER BY njb");
}
//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
//$row_height = 6;

//$y_axis = 50;
$y_axis = $y_axis_initial + $row_height;
$jmlBaris = mysql_num_rows($result);
$brs = 1;
while($row = mysql_fetch_array($result))
{
	$row_height = 6;
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();

        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(40);
        $pdf->Cell(30, 12, 'NJB', 1, 0, 'C', 1);
		$pdf->Cell(30, 12, 'NPA', 1, 0, 'C', 1);
		$pdf->Cell(30, 12, 'NAMA', 1, 0, 'C', 1);
		$pdf->Cell(30, 12, 'ID BARANG', 1, 0, 'C', 1);
		$pdf->Cell(60, 12, 'NAMA BARANG', 1, 0, 'C', 1);
		$pdf->Cell(30, 12, 'QUATITY', 1, 0, 'C', 1);
		$pdf->Cell(30, 12, 'STATUS', 1, 0, 'C', 1);
		$pdf->Cell(30, 12, 'TANGGAL JUAL', 1, 0, 'C', 1);

				
        //Go to next row
		$y_axis_initial = 40;
		$row_height_ = 12;
        $y_axis = $y_axis_initial + $row_height_;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }
	
    $njb = $row['njb'];
	$npa = $row['npa'];
	$nama = $row['namang'];
    $id_barang = $row['id_barang'];
	$nama_barang = $row['nambar'];
	$quatity = $row['quatity'];
    $status = $row['status'];
	$tgl_jual = $row['tgl_jual'];
		
	
    $pdf->SetY($y_axis);
    $pdf->SetX(40);
    $pdf->Cell(30, 6, $njb, 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $npa, 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $nama, 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $id_barang, 1, 0, 'L', 1);
	$pdf->Cell(60, 6, $nama_barang, 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $quatity, 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $status, 1, 0, 'L', 1);
	$pdf->Cell(30, 6, $tgl_jual, 1, 0, 'L', 1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
	$brs = $brs + 1;
	
	if($brs > $jmlBaris)
	{
		if($y_axis > 140)
		{
			$pdf->AddPage();
			$y_axis = 40;
		}
		$cetak = $_POST['tglCetak'];
		$y_axis = $y_axis+5;
		$pdf->SetY($y_axis);
		$pdf->SetX(250);
		$pdf->Cell(30,10,"Panekan,".$cetak,0,0,'C');
		
		$y_axis = $y_axis+5;
		$pdf->SetY($y_axis);
		$pdf->SetX(250);
		$pdf->Cell(30,10,"Petugas Toko",0,0,'C');
		$pdf->SetX(70);
		$pdf->Cell(30,10,"Ketua",0,0,'C');
		
		$str="select a.nama from pengurus p inner join anggota a on a.npa = p.npa AND p.jabatan='toko'";
		$nm = mysql_query($str) or die(mysql_error());
		$nama = mysql_fetch_row($nm);
		
		$y_axis = $y_axis+25;
		$pdf->SetY($y_axis);
		$pdf->SetX(250);
		$pdf->Cell(30,10,$nama[0],0,0,'C');


		$str="select a.nama from pengurus p inner join anggota a on a.npa = p.npa AND p.jabatan='ketua'";
		$nm = mysql_query($str) or die(mysql_error());
		$nama = mysql_fetch_row($nm);
		
		$y_axis = $y_axis+1;
		$pdf->SetY($y_axis);
		$pdf->SetX(70);
		$pdf->Cell(30,10,$nama[0],0,0,'C');
	}	
	
}
$pdf->Output();

?>