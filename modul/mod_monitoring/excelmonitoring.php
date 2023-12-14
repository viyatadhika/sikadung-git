<?php
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";


header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Monitoring Kerusakan.xls");


echo"
<table id='example5' class='table table-striped table-hover table-bordered'>
    <thead>
    <tr>
    <th width='1%'>No.</th>
    <th><center>Tanggal Kerusakan</center></th>
    <th><center>Gedung</center></th>
    <th><center>Lokasi Kerusakan</center></th>
    <th><center>Jenis Kerusakan</center></th>
    <th><center>Status Perbaikan</center></th>
    </tr>
    </thead>
    <tbody>";
    $tgl_mulai = $_POST['tgl_mulai'];
    $tgl_sampai = $_POST['tgl_sampai'];
    $status_perbaikan = $_POST['status_perbaikan'];
    if(!empty($status_perbaikan)){
        $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
                            FROM kerusakan k 
                            INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                            INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                            INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                            WHERE k.tgl_kerusakan BETWEEN '$tgl_mulai' AND '$tgl_sampai'
                            ORDER BY k.id_kerusakan DESC");
    }else{
        $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
                            FROM kerusakan k 
                            INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                            INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                            INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                            WHERE k.tgl_kerusakan BETWEEN '$tgl_mulai' AND '$tgl_sampai' AND k.id_status_perbaikan = '$status_perbaikan'
                            ORDER BY k.id_kerusakan DESC");
    }
    if($tampil=== FALSE) { 
    die(mysql_error()); 
    }
    $no = 1;
    while ($r = mysql_fetch_array($tampil)) {
    $tgl=tgl_indo($r['tgl_kerusakan']);
    echo "
    <tr>
    <td align='center'>$no</td>
    <td align='center'>$tgl</td>
    <td align='center'>$r[nama_gedung]</td> 
    <td align='center'>$r[lokasi_kerusakan]</td>
    <td align='center'>$r[nama_kerusakan]</td>
    <td align='center'>$r[nama_status_perbaikan]</td> 
    </tr>";
    $no++;
}
echo "
    </tbody>
</table>";

?>