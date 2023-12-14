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

// Update Perbaikan
if ($module=='perbaikan' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];
  $lokasi_file2 = $_FILES['fupload2']['tmp_name'];
  $nama_file2   = $_FILES['fupload2']['name'];

  // Apabila file tidak diganti
  if (empty($lokasi_file) AND empty($lokasi_file2) ){
    mysql_query("UPDATE kerusakan SET nama_teknisi      = '$_SESSION[namalengkap]',
                                tgl_perbaikan           = '$_POST[tgl_perbaikan]',
                                id_status_perbaikan     = '$_POST[id_status_perbaikan]',
                                volume                  = '$_POST[volume]',
                                keterangan_perbaikan    = '$_POST[keterangan_perbaikan]'
                                WHERE id_kerusakan      = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));
  $file_extension2 = strtolower(substr(strrchr($nama_file2,"."),1));

  switch($file_extension AND $file_extension2){
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "rar": $ctype="application/rar"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg": $ctype="image/jpeg"; break;
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/proses";
  }

  if ($file_extension=='php' AND $file_extension2=='php'){
   echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
        window.location=('../../media.php?module=download')</script>";
  }
  else{
    UploadFile($nama_file);
    UploadFileDukung($nama_file2);
      mysql_query("UPDATE kerusakan SET nama_teknisi        = '$_SESSION[namalengkap]',
                                      tgl_perbaikan         = '$_POST[tgl_perbaikan]',
                                      id_status_perbaikan   = '$_POST[id_status_perbaikan]',
                                      volume                = '$_POST[volume]',
                                      keterangan_perbaikan  = '$_POST[keterangan_kerusakan]',
                                      nama_file_perbaikan   = '$nama_file', 
                                      nama_file_data_dukung = '$nama_file2',  
                                      keterangan_perbaikan  = '$_POST[keterangan_perbaikan]'
                                      WHERE id_kerusakan    = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}
}
?>
