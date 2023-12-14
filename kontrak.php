<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
echo"
<h1>RINGKASAN KONTRAK</h1>
<p>Untuk Kegiatan yang dananya berasal dari Rupiah Murni :</p>
<table class='table'>
  <tbody>";
  $tampil = mysql_query("SELECT * FROM spk ORDER BY id_spk DESC");
  while ($r = mysql_fetch_array($tampil)) {
  echo"
  <tr>
    <td>Nomor dan Tanggal DIPA</td>
    <td>SP DIPA-005.06.1.610378/2020 | 12 Nopember 2019</td>
  </tr>
  <tr>
    <td>Kode Kegiatan/Sub Kegiatan/MAK</td>
    <td>1075.994.001.002.C.523121</td>
  </tr>
  <tr>
    <td>Nomor dan Tanggal SPK</td>
    <td>$r[no_spk] | $r[tgl_spk] </td>
  </tr>
  <tr>
    <td>Nomor dan Tanggal BAST</td>
    <td>$r[no_spk] | $r[tgl_spk] </td>
  </tr>
  <tr>
    <td>Nomor dan Tanggal BAP</td>
    <td>$r[no_spk] | $r[tgl_spk] </td>
  </tr>
  <tr>
  <tr>
    <td>Nama Penyedia</td>
    <td> </td>
  </tr>
  <tr>
    <td>Nomor dan Tanggal Kwitansi</td>
    <td> </td>
  </tr>
  <tr>
    <td>Nomor Rekening</td>
    <td> </td>
  </tr>
  <tr>
    <td>Nama Bank</td>
    <td> </td>
  </tr>
  <tr>
    <td>Alamat Bank</td>
    <td> </td>
  </tr>
  <tr>
    <td>Email Penyedia</td>
    <td> </td>
  </tr>
  <tr>
    <td>NPWP Penyedia</td>
    <td> </td>
  </tr>
  <tr>
    <td>Alamat Penyedia</td>
    <td> </td>
  <tr>
    <td>Nilai Kontrak/SPK</td>";
    $nilai_spk = number_format($r['nilai_spk'], 2);
    echo"
    <td>Rp. $nilai_spk</td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td>$r[terbilang_spk]</td>
  </tr>
  <tr>
    <td>Uraian dan Volume Pekerjaan</td>
    <td> </td>
  </tr>
    </tr>
    <td>Cara Pembayaran</td>
    <td>$r[cara_pembayaran]</td>
  </tr>
  <tr>
    <td>Termin</td>
    <td>$r[termin] Kali</td>
  </tr>
  <tr>
    <td>Nilai Pertermin</td>";
    $nilai_termin = number_format($r['nilai_termin'], 2);
    echo"
    <td>Rp. $nilai_termin</td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td>$r[terbilang_termin]</td>
  </tr>
  <tr>
    <td>Jangka Waktu Pelaksanaan</td>
    <td>$r[waktu_pelaksanaan] Hari Kalender</td>
  </tr>
  <tr>
    <td>Tanggal Penyelesaian</td>
    <td>Mulai Tanggal: $r[tgl_mulai_pekerjaan] s/d $r[tgl_selesai_pekerjaan]</td>
  </tr>
  <tr>
    <td>Jangka Waktu Pemeliharaan</td>
    <td>$r[waktu_pemeliharaan] Hari Kalender</td>
  </tr>
  <tr>
    <td>Ketentuan Sanksi</td>
    <td>Dikenakan denda sebesar 1‰ (seperseribu) setiap hari keterlambatan dari jumlah harga pekerjaan</td>
  </tr>";
  }
  echo"
  </tbody>
</table>

<p class='ttd'>
Bogor, 2 Januari 2020 <br>
a.n. Kuasa Pengguna Anggaran <br>
Pejabat Pembuat Komitmen Sekretariat <br>
<br>
<br>
<br>
<br>
<br>
Maulana Aulia <br>
NIP. 198410012006041001
</p>";
}