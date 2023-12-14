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
<p style='margin-top: 0px;' align='center'>==================================================================
</p>";
                $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
                                      FROM kerusakan k 
                                      INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                      INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                      INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                      ORDER BY k.id_kerusakan DESC");
                $r = mysql_fetch_array($tampil);
                echo "
<p style='margin-top: 30px; font-size:22px;' align='center'>
<u><b>LAPORAN KERUSAKAN</b></u>
<br>002/Bld.1/S.Umum/LK/1/2021</p>

<p style='margin-top:30px;' align='justify'>&emsp; Pada hari  tanggal , melaporkan kerusakan $r[nama_kerusakan] pada Badan Litbang Diklat Kumdil Mahkamah Agung RI dengan rincian sebagai berikut:</p>

<p style='margin-top:30px;' align='justify'>Masukan perbaikan dari teknisi:</p>

<p style='margin-top:30px;' align='justify'>&emsp; Demikian laporan kerusakan ini dibuat, untuk dipergunakan sebagaimana mestinya.</p>";
echo"


<table style='height: 302px; width: 602px; align='center''>
          <tbody>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'><center>Mengetahui</center></td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'><center>Koordinator</center></td>
              <td style='height: 23px; width: 243.867px;'><center>Teknisi</center></td>
              <td style='height: 23px; width: 229.217px;'><center>Yang Melapor</center></td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'><center>Randy Viyatadhika</center></td>
              <td style='height: 23px; width: 243.867px;'><center>Umar</center></td>
              <td style='height: 23px; width: 229.217px;'><center>$r[pelapor]</center></td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'><center>Kasubbag Perlengkapan</center></td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'>&nbsp;</td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
            <tr style='height: 23px;'>
              <td style='height: 23px; width: 231.917px;'>&nbsp;</td>
              <td style='height: 23px; width: 243.867px;'><center>Faruq Indrakusumah</center></td>
              <td style='height: 23px; width: 229.217px;'>&nbsp;</td>
            </tr>
          </tbody>
        </table>";
}
