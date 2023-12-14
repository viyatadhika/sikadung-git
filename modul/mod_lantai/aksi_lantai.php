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

    if ($module=='lantai' AND $act=='hapus'){
      mysql_query("DELETE FROM lantai WHERE id_lantai='$_GET[id]'");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='lantai' AND $act=='input'){
      mysql_query("INSERT INTO lantai(nama_lantai, aktif) 
                             VALUES('$_POST[nama_lantai]',
                                    '$_POST[aktif]')");
      header('location:../../media.php?module='.$module);
    }

    elseif ($module=='lantai' AND $act=='update'){
      mysql_query("UPDATE lantai SET nama_lantai = '$_POST[nama_lantai]',
                                    aktif        = '$_POST[aktif]'
                               WHERE id_lantai   = '$_POST[id]'");
      header('location:../../media.php?module='.$module);
    }
  }
?>