<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Kerusakan Yang Dalam Pengerjaan.xls");


include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";

echo"
<table>
    <tr>
        <td colspan='13'><center><b>MAHKAMAH AGUNG RI</b></center></td>
    </tr>
    <tr>
        <td colspan='13'><center><b>BADAN LITBANG DIKLAT HUKUM DAN PERADILAN</b></center></td>
    </tr>
    <tr>
        <td colspan='13'><center>Jl.Cikopo Selatan, Desa Sukamaju, Kec. Megamendung Bogor - Jabar,18570</center></td>
    </tr>
    <tr>
        <td colspan='13'><center>Telp.(0251) 8249520, 8249537, 8249526,8249529, Fax.(0251) 8249532,8249531</center></td>
    </tr>
    <tr>
        <td colspan='13'><center>email: setbldk@mahkamahagung.go.id website: http://bldk.mahkamahagung.go.id</center></td>
    </tr>
    <tr>
        <td colspan='13'></td>
    </tr>
</table>
<table style: border=1px>
    <thead>
    <tr>
    <th width='1%'>No.</th>
    <th><center>Nomor Kerusakan</center></th>
    <th><center>Tanggal Kerusakan</center></th>
    <th><center>Pelapor</center></th>
    <th><center>Gedung</center></th>
    <th><center>Lokasi Kerusakan</center></th>
    <th><center>Jenis Kerusakan</center></th>
    <th><center>Keterangan Kerusakan</center></th>
    <!-- <th><center>Foto Kerusakan</center></th> -->
    <th><center>Tanggal Perbaikan</center></th>
    <th><center>Nama Teknisi</center></th>
    <th><center>Volume</center></th>
    <th><center>Keterangan Perbaikan</center></th>
    <th><center>Status Perbaikan</center></th>
    </tr>
    </thead>
    <tbody>";
    $tampil = mysql_query("SELECT k.id_kerusakan, k.nomor_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                        k.nama_file, k.nama_teknisi, k.tgl_perbaikan, k.volume, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                        FROM kerusakan k 
                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                        INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                        WHERE k.id_status_perbaikan=1
                        ORDER BY k.id_kerusakan DESC");
    $no = 1;
    while ($r = mysql_fetch_array($tampil)) {
    $tgl_kerusakan=tgl_indo($r['tgl_kerusakan']);
    $tgl_perbaikan=tgl_indo($r['tgl_perbaikan']);
    echo "
    <tr>
    <td align='center'>$no</td>
    <td align='center'>$r[nomor_kerusakan]</td>
    <td align='center'>$tgl_kerusakan</td>
    <td align='center'>$r[pelapor]</td>
    <td align='center'>$r[nama_gedung]</td> 
    <td align='center'>$r[lokasi_kerusakan]</td>
    <td align='center'>$r[nama_kerusakan]</td>
    <td align='center'>$r[keterangan_kerusakan]</td> 
    <!-- <td align='center'><img src='../../files/$r[nama_file]' width='250px' height='250px'></td> -->
    <td align='center'>$tgl_perbaikan</td>
    <td align='center'>$r[nama_teknisi]</td>
    <td align='center'>$r[volume]</td>
    <td align='center'>$r[keterangan_perbaikan]</td>
    <td align='center'>$r[nama_status_perbaikan]</td>
    </tr>";
    $no++;
    }
echo "
    </tbody>
</table>";

?>