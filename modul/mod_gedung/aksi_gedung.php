<?php
session_start();
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
    echo "
      <link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
  }
  else{
    include "../../config/koneksi.php";

    $module = $_GET[module];
    $act = $_GET[act];

    if ($module=='gedung' AND $act=='hapus'){
      mysql_query("DELETE FROM gedung WHERE id_gedung='$_GET[id]'");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='gedung' AND $act=='input'){
      mysql_query("INSERT INTO gedung(nama_gedung, aktif) 
    	                       VALUES('$_POST[nama_gedung]',
                                    '$_POST[aktif]')");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='gedung' AND $act=='update'){
      mysql_query("UPDATE gedung SET nama_gedung = '$_POST[nama_gedung]',
                                    aktif        = '$_POST[aktif]'
                               WHERE id_gedung   = '$_POST[id]'");
      header('location:../../media.php?module='.$module);
    }
  }
?>