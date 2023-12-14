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

    if ($module=='ruangan' AND $act=='hapus'){
      mysql_query("DELETE FROM ruangan WHERE id_ruangan='$_GET[id]'");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='ruangan' AND $act=='input'){
      mysql_query("INSERT INTO ruangan (nama_ruangan, id_gedung, id_lantai, aktif) 
    	                       VALUES('$_POST[nama_ruangan]',
                                    '$_POST[id_gedung]',
                                    '$_POST[id_lantai]',
                                    '$_POST[aktif]')");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='ruangan' AND $act=='update'){
      mysql_query("UPDATE ruangan SET nama_ruangan = '$_POST[nama_ruangan]',
                                      id_gedung    = '$_POST[id_gedung]',
                                      id_lantai    = '$_POST[id_lantai]',
                                      aktif        = '$_POST[aktif]'
                               WHERE id_ruangan   = '$_POST[id]'");
      header('location:../../media.php?module='.$module);
    }
  }
?>