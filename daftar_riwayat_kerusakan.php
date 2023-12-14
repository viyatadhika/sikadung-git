<?php
include "config/koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=excel-pemantauan-badan.xls");

echo "
<table id='example1' class='table table-striped table-hover table-bordered'>
    <thead>
        <tr>
        <th width='1%'>No.</th>
        <th><center>Tanggal Kerusakan</center></th>
        <th><center>Gedung</center></th>
        <th><center>Lokasi Kerusakan</center></th>
        <th><center>Jenis Kerusakan</center></th>
        <th><center>Status Perbaikan</center></th>
        </tr>
    </thead>";
$tampil = mysql_query("SELECT p.id_perkegiatan, p.tahun_anggaran, esi.kode_esi, esi.pagu_anggaran_esi, esii.kode_esii,
                  esii.pagu_anggaran_esii, n.kode_kegiatan, n.nama_nomenklatur_kegiatan,
                  p.pagu_anggaran_kegiatan, p.realisasi_anggaran_kegiatan, p.sisa_anggaran_kegiatan
                  FROM per_kegiatan p
                  INNER JOIN eseloni esi ON p.kode_esi = esi.kode_esi
                  INNER JOIN eselonii esii ON p.kode_esii = esii.kode_esii
                  INNER JOIN nomenklatur n ON p.kode_kegiatan = n.kode_kegiatan");
$no = 1;
while ($r = mysql_fetch_array($tampil)) {
    echo "
    <tr>
        <td><center>$no</center></td>
        <td><center>$r[tahun_anggaran]</center></td>
        <td><center>$r[kode_esi]</center></td>";
        $pagu_esi = number_format($r['pagu_anggaran_esi'], 2);
      echo"
        <td><center>Rp. $pagu_esi</center></td>
        <td><center>$r[kode_esii]</center></td>";
        $pagu_esii = number_format($r['pagu_anggaran_esii'], 2);
      echo"
        <td><center>Rp. $pagu_esii</center></td>
        <td><center>$r[kode_kegiatan]</center></td>
        <td>$r[nama_nomenklatur_kegiatan]</td>";
      $pagu = number_format($r['pagu_anggaran_kegiatan'], 2);
      echo"
        <td><center>Rp. $pagu</center></td>";
      $realisasi = number_format($r['realisasi_anggaran_kegiatan'], 2);
      echo"
        <td><center>Rp. $realisasi</center></td>";
      $sisa = number_format($r['sisa_anggaran_kegiatan'], 2);
      echo"
        <td><center>Rp. $sisa</center></td>
        <td><center><span class='label label-success'>100%</span></center></td>
    </tr>";
    $no++;
}

echo "
</table>";
