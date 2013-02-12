<?php
$namabarang = $_GET['nama'];
$namabrg= "";
$id_barang = "";
$harga	= "";
$diskon	= "";

include "../../db_config.php";

$getdata = mysql_query("SELECT nama, id_barang, harga_jual, diskon FROM master_barang WHERE nama like '%$namabarang%'");
$data = mysql_fetch_array($getdata);

$namabrg = $data['nama'];
$id_barang  = $data['id_barang'];
$harga	 = $data['harga_jual'];
$diskon	 = $data['diskon'];

header("content-type: text/xml");
echo "
<xmlresponse>
<data>$namabrg</data>
<data>$id_barang</data>
<data>$harga</data>
<data>$diskon</data>
</xmlresponse>
";

?>