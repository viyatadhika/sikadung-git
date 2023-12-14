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

// Hapus download
if ($module=='monitoring' AND $act=='hapus'){
  mysql_query("DELETE FROM kerusakan WHERE id_kerusakan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

//Pencarian
if ($module=='monitoring' AND $act=='cari'){
  //mysql_query("DELETE FROM kerusakan WHERE id_kerusakan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}



// Input download
elseif ($module=='kerusakan' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
  
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

  switch($file_extension){
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

  if ($file_extension=='php'){
   echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
        window.location=('../../media.php?module=download')</script>";
  }
  else{
    UploadFile($nama_file);
    mysql_query("INSERT INTO kerusakan(tgl_kerusakan, pelapor, id_jenis_kerusakan, lokasi_kerusakan, keterangan_kerusakan, nama_file, keterangan_foto) 
                            VALUES('$_POST[tgl_kerusakan]',
                                   '$_POST[pelapor]',
                                   '$_POST[id_jenis_kerusakan]',
                                   '$_POST[lokasi_kerusakan]',
                                   '$_POST[keterangan_kerusakan]',
                                   '$nama_file',
                                   '$_POST[keterangan_foto]')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO kerusakan(tgl_kerusakan, pelapor, id_jenis_kerusakan, lokasi_kerusakan, keterangan_kerusakan, nama_file, keterangan_foto) 
                            VALUES('$_POST[tgl_kerusakan]',
                                  '$_POST[pelapor]',
                                  '$_POST[id_jenis_kerusakan]',
                                  '$_POST[lokasi_kerusakan]',
                                  '$_POST[keterangan_kerusakan]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update donwload
elseif ($module=='kerusakan' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila file tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE kerusakan SET tgl_kerusakan       = '$_POST[tgl_kerusakan]',
                                pelapor     = '$_POST[pelapor]',
                                id_jenis_kerusakan   = '$_POST[id_jenis_kerusakan]',
                                lokasi_kerusakan       = '$_POST[lokasi_kerusakan]',
                                keterangan_kerusakan   = '$_POST[keterangan_kerusakan]'
                             WHERE id_kerusakan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

  switch($file_extension){
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

  if ($file_extension=='php'){
   echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
        window.location=('../../media.php?module=download')</script>";
  }
  else{
    UploadFile($nama_file);
                                mysql_query("UPDATE kerusakan SET tgl_kerusakan       = '$_POST[tgl_kerusakan]',
                                pelapor     = '$_POST[pelapor]',
                                id_jenis_kerusakan   = '$_POST[id_jenis_kerusakan]',
                                lokasi_kerusakan       = '$_POST[lokasi_kerusakan]',
                                keterangan_kerusakan   = '$_POST[keterangan_kerusakan]',
                                nama_file       = '$nama_file',   
                                keterangan_foto   = '$_POST[keterangan_foto]'
                             WHERE id_kerusakan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}
}
?>
