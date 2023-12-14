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

    if ($module=='identitas' AND $act=='update'){
      mysql_query("UPDATE identitas SET kementerian       = '$_POST[kementerian]',
  									                    satker            = '$_POST[satker]',
                                        instansi          = '$_POST[instansi]',
                                        alamat_instansi   = '$_POST[alamat_instansi]',
  									                    sumber_dana       = '$_POST[sumber_dana]',
                                        nomor_dipa        = '$_POST[nomor_dipa]',
                                        tanggal_dipa      = '$_POST[tanggal_dipa]',
                                        id_tahun          = '$_POST[tahun_anggaran]',
                                        id_pejabat        = '$_POST[id_pejabat]'
                                  WHERE id_identitas   = '$_POST[id]'");
    }
    header('location:../../media.php?module='.$module);
  }
?>
