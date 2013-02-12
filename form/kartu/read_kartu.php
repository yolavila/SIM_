<?php

// membaca isi dokumen tempate surat.rtf
// isi dokumen dinyatakan dalam bentuk string
$document = file_get_contents("kartu.rtf");
// mereplace tanda %%%NAMA% dengan data nama dari form
$document = str_replace("%%NAMA%%", $nama, $document);
// mereplace tanda %%%ALAMAT% dengan data alamat dari form, dst
$document = str_replace("%%ALAMAT%%", $alamat, $document);
$document = str_replace("%%instansi%%", $instansi, $document);
$document = str_replace("%%npa%%", $npa, $document);
// header untuk membuka file output RTF dengan MS. Word
// nama file output adalah undangan.rtf
header("Content-type: application/msword");
header("Content-disposition: inline; filename=anggota.rtf");
header("Content-length: " . strlen($document));
echo $document;

?>