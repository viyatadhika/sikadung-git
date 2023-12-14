<?php
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb.php";
include "../../config/fungsi_indotgl.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='monitoring' AND $act=='cetakbastkerusakan'){
$cetak = mysql_query("SELECT k.id_kerusakan, k.nomor_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_gedung, g.nama_gedung, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, 
                      k.keterangan_kerusakan, k.nama_file, k.volume, k.nama_teknisi, k.keterangan_perbaikan, k.nama_file
                                    FROM kerusakan k 
                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                    INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                    WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($cetak);
    $tgl=tgl_indo($r['tgl_kerusakan']);

    //header("Content-type: application/msword");
    //header("Content-disposition: inline; filename=BAST Laporan Kerusakan.doc");
    echo"
    <div class='content-wrapper'>
      <section class='content'>
        <div class='box box-default'>
        <table class='kop'>
        <tbody>
          <tr>
              <th rowspan='6'><center><img src='../../images/kop_ma.png' width='106px' height='133px'/></center></th>
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
      <table class='garis' style='margin-top: 0px;' align='center'>
          <tr>
            <td>==================================================================</td>
          </tr>
        </table>

          <p class='nomor' style='margin-top: 15px;' align='center'>
          <u><b>LAPORAN KERUSAKAN</b></u>
          <br>Nomor: $r[nomor_kerusakan] 
          </p>

          <p style='margin-top: 15px;' align='justify'>
          &emsp;&emsp;    Pada hari $hari_ini tanggal $tgl, melaporkan kerusakan pada Gedung $r[nama_gedung] Ruangan $r[lokasi_kerusakan] Badan Litbang Diklat Kumdil MA RI 
          dengan rincian sebagai berikut:

          <table style='margin-left: 30px;'>
          <tr>
            <td>Jenis Kerusakan</td>
            <td>: $r[nama_kerusakan]</td>
          </tr>
          <tr>
            <td>Volume</td>
            <td>: $r[volume]</td>
          </tr>
          <tr>
            <td>Keterangan Kerusakan</td>
            <td>: $r[keterangan_kerusakan]</td>
          </tr>
          <tr>
            <td>Foto Kerusakan</td>
            <td> <img src='../../files/$r[nama_file]' width='250px' height='250px'></td>
          </tr>
          <tr>
            <td>Masukan dari Teknisi</b></td>
            <td>: $r[keterangan_perbaikan]</td>
          </tr>
          <tr>
        </table>
        

          <p align ='justify'>
          &emsp;&emsp;    Demikian laporan kerusakan ini dibuat, untuk dipergunakan sebagaimana mestinya.
          </p>

          <p align ='center'>
          <table style='height: 302px; width: 735px; align='center''>
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
              <td style='height: 23px; width: 243.867px;'><center>$r[nama_teknisi]</center></td>
              <td style='height: 23px; width: 229.217px;'><center>$r[pelapor]</center></td>
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
        </table>
</p>";
  
}

   
?>