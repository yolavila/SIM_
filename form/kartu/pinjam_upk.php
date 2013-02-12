<?php
// isi dokumen dinyatakan dalam bentuk string
$document = file_get_contents("pinjam_upk.rtf");
// header untuk membuka file output RTF dengan MS. Word
// nama file output adalah undangan.rtf
header("Content-type: application/msword");
header("Content-disposition: inline; filename=UPK.rtf");
header("Content-length: " . strlen($document));
echo $document;

?>