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
<table class='kop'>
  <tbody>
    <tr>
        <th rowspan='5'><center><img src='images/kop_ma.png' width='106px' height='133px'/></center></th>
        <th class='kop'><b>MAHKAMAH AGUNG RI</b></th>
    </tr>
    <tr>
      <td class='kop'><b>BADAN LITBANG DIKLAT HUKUM DAN PERADILAN</b></td>
    </tr>
    <tr>
      <td>Jl.Cikopo Selatan, Desa Sukamaju, Kec. Megamendung Bogor - Jabar,18570</td>
    </tr>
    <tr>
      <td>Telp.(0251) 8249520, 8249537, 8249526,8249529, Fax.(0251) 8249532,8249531</td>
    </tr>
    <tr>
      <td>email: setbldk@mahkamahagung.go.id website: http://bldk.mahkamahagung.go.id</td>
    </tr>
  </tbody>
</table>
<p style='margin-top: 0px;' align='center'>=============================================================================
</p>

<p style='margin-top: 50px; font-size:28px;' align='center'>
<b>DOKUMEN KONTRAK</b></p>
<p style='margin-top: 0px;' align='center'>
NOMOR SURAT PERINTAH KERJA (SPK): <br>
002/Bld.1/PPK/PJ/SPK/1/2020 <br>
Tgl 02 Januari 2020</p>

<p style='margin-top: 50px; font-size:23px;' align='center'>
<b>SEKRETARIAT</b><br>
<b>BADAN LITBANG DIKLAT HUKUM DAN PERADILAN</b></p>

<p style='margin-top: 50px; font-size:18px;' align='center'>
PENYEDIA<br>
<b>PT. SYADARINDO BERKAH UTAMA</b></p>

<table style='margin-top: 250px; class='tabel'>
  <tbody>
    <tr>
    <td>Instansi</td>
    <td>MAHKAMAH AGUNG RI</td>
  </tr>
  <tr>
    <td>Nama Paket</td>
    <td>Biaya Maintenance Lift Tahun 2020</td>
  </tr>
  <tr>
    <td>Nilai Kontrak</td>
    <td>Rp. 114,946,040.00</td>
  </tr>
  <tr>
    <td>Terbilang</td>
    <td> </td>
  </tr>
  <tr>
    <td>Waktu Pelaksanaan</td>
    <td>02 Januari 2020 s/d 31 Desember 2020</td>
  </tr>
  </tbody>
</table>

<p style='margin-top: 50px;' align='center'>=============================================================================
</p>

<p style='margin-top: 30px; font-size:14px;' align='center'>
<b>SUMBER DANA APBN MURNI</b><br>
<b>TAHUN ANGGARAN 2020</b></p>";
}