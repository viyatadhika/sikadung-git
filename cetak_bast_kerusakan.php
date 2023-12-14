<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='kerusakan' AND $act=='cetakbastkerusakan'){
    $cetak = mysql_query("SELECT k.id_kerusakan, k.nomor_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_gedung, g.nama_gedung, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, k.nama_file, k.keterangan_foto
    FROM kerusakan k 
    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
    INNER JOIN gedung g ON k.id_gedung = g.id_gedung
    WHERE id_kerusakan='$_GET[id]'");
$r    = mysql_fetch_array($cetak);
$nomor = $r[nomor_kerusakan];
$tgl = tgl_indo($r[tgl_kerusakan]);
$kerusakan = $r[nama_kerusakan];
$gedung = $r[nama_gedung];
$ruangan = $r[lokasi_kerusakan];
$rincian_kerusakan = $r[keterangan_kerusakan];
//$volume = $r[volume];
$keterangan_perbaikan = $r[keterangan_perbaikan];
// $teknisi = $r[teknisi];
$pelapor = $r[pelapor];


// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("BAST_Laporan_Kerusakan.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#No", $nomor, $document);
$document = str_replace("#Hari", $hari_ini, $document);
$document = str_replace("#Tanggal", $tgl, $document);
$document = str_replace("#Kerusakan", $kerusakan, $document);
$document = str_replace("#Gedung", $gedung, $document);
$document = str_replace("#Ruangan", $ruangan, $document);
$document = str_replace("#RincianKerusakan", $rincian_kerusakan, $document);
//$document = str_replace("#Volume", $volume, $document);
$document = str_replace("#KeteranganPerbaikan", $keterangan_perbaikan, $document);
//$document = str_replace("#Teknisi", $teknisi, $document);
$document = str_replace("#Pelapor", $pelapor, $document);
// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=BAST Laporan Kerusakan.doc");
header("Content-length: ".strlen($document));
echo $document; 
  
}
}
   
?>