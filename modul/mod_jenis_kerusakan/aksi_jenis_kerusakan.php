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

    if ($module=='jenis_kerusakan' AND $act=='hapus'){
      mysql_query("DELETE FROM jenis_kerusakan WHERE id_jenis_kerusakan='$_GET[id]'");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='jenis_kerusakan' AND $act=='input'){
      mysql_query("INSERT INTO jenis_kerusakan(nama_kerusakan, aktif) 
    	                       VALUES('$_POST[nama_kerusakan]',
                                    '$_POST[aktif]')");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='jenis_kerusakan' AND $act=='update'){
      mysql_query("UPDATE jenis_kerusakan SET nama_kerusakan = '$_POST[nama_kerusakan]',
                                    aktif        = '$_POST[aktif]'
                               WHERE id_jenis_kerusakan   = '$_POST[id]'");
      header('location:../../media.php?module='.$module);
    }
  }
?>