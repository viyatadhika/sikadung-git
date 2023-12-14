<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_kerusakan/aksi_kerusakan.php";
$bast="modul/mod_kerusakan/cetak_bast_kerusakan.php";
switch ($_GET[act]) {
  default:
  echo "
  <div class='content-wrapper'>
  <section class='content-header'>
    <h1>
      Form Kerusakan
      <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
    </h1>
    <ol class='breadcrumb'>
      <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
      <li>Form Kerusakan</li>
    </ol>  
  </section>
  <section class='content'>
  <div class='row pulse animated'>
        <div class='col-xs-12'>
          <div class='box'>
            <div class='box-header with-border'>
              <center><h3 class='box-title'>Daftar Kerusakan</h3></center>
            </div>
            <div class='box-body'>
              <div class='form-group'>
                <input type=button value='Tambah Laporan Kerusakan' onclick=location.href='?module=kerusakan&act=tambahkerusakan' class='btn btn-warning'><br>
              </div>
                <table id='example3' class='table table-striped table-hover table-bordered'>
                <thead>
                <tr>
                  <th width='1%'>No.</th>
                  <th><center>Tanggal Kerusakan</center></th>
                  <th><center>Gedung</center></th>
                  <th><center>Lokasi Kerusakan</center></th>
                  <th><center>Jenis Kerusakan</center></th>
                  <th width='11%'><center>Aksi</center></th>
                </tr>
                </thead>
                <tbody>";
                $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan
                                                        FROM kerusakan k 
                                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                        ORDER BY k.id_kerusakan DESC");
                $no = 1;
                while ($r = mysql_fetch_array($tampil)) {
                $tgl=tgl_indo($r[tgl_kerusakan]);
                echo "
                <tr>
                  <td align='center'>$no</td>
                  <td align='center'>$tgl</td>  
                  <td align='center'>$r[nama_gedung]</td>
                  <td align='center'>$r[lokasi_kerusakan]</td>   
                  <td align='center'>$r[nama_kerusakan]</td>
                  <td align='center'>
                    <!-- <a href=\"$bast?module=kerusakan&act=cetakbastkerusakan&id=$r[id_kerusakan]\" target='_BLANK' class='btn btn-info'><i class='fa fa-print'></i></a> -->
                    <a href=?module=kerusakan&act=detilkerusakan&id=$r[id_kerusakan] class='btn btn-info'><i class='fa fa-info-circle'></i></a> 
                    <a href=?module=kerusakan&act=editkerusakan&id=$r[id_kerusakan] class='btn btn-info'><i class='fa fa-pencil'></i></a>
                    <a href=\"$aksi?module=kerusakan&act=hapus&id=$r[id_kerusakan]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\" class='btn btn-info' ><i class='fa fa-close'></i></a>
                    </td>
                </tr>";
                $no++;
                }
              echo "
                </tbody>
                </table>
      </div>
      </div>
    </div>
  </div>
  </section>
  </div>";
  break;

  
  case "tambahkerusakan":
    $bulan = date('n');
    $tahun = date ('Y');
    $nomor = "/Bld.1/S.Umum/LK/".$bulan."/".$tahun;
    
    // membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
    $query = "SELECT max(nomor_kerusakan) as maxKode FROM kerusakan WHERE month(tgl_kerusakan)='$bulan'";
    $hasil = mysql_query($query);
    $data  = mysql_fetch_array($hasil);
    $no= $data['maxKode'];
    $noUrut= $no + 1;
    
    //membuat Nomor Surat Otomatis dengan awalan depan 0 misalnya , 01,02 
    //jika ingin 003 ,tinggal ganti %03
    $kode =  sprintf("%03s", $noUrut);
    $nomorbaru = $kode.$nomor;

    echo "
    <div class='content-wrapper'>
    <section class='content-header'>
      <h1>
        Form Kerusakan
        <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
      </h1>
      <ol class='breadcrumb'>
        <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
        <li>Form Kerusakan</li>
      </ol>  
    </section>
    <section class='content'>
      <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Tambah Laporan Kerusakan</h3>
        </div>
        <div class='box-body'>  
          <div class='row'>
            <div class='col-md-6'>
            <form method=POST action='$aksi?module=kerusakan&act=input' enctype='multipart/form-data'>
              <input type=hidden name='nomor_kerusakan' class='form-control' placeholder='' value='$nomorbaru'>
              <div class='form-group'>
                <label>Tanggal Kerusakan</label>
                <div class='input-group'>
                  <input placeholder='' type='text' class='form-control pull-right' id='datepicker' name='tgl_kerusakan'>
                  <div class='input-group-addon'>
                      <i class='fa fa-calendar'></i>
                  </div>
                </div>
              </div>
              <div class='form-group'>
                <label>Pelapor</label>
                <input type=text name='pelapor' class='form-control' placeholder='' required>
              </div>
              <div class='form-group'>
                  <label>Gedung</label>
                  <select name='gedung' class='form-control' onchange='changeValue1(this.value)'>
                    <option value=0 selected>- Pilih Gedung -</option>";
                    $tampil=mysql_query("SELECT * FROM gedung WHERE aktif='Ya' ORDER BY id_gedung");
                          while($r=mysql_fetch_array($tampil)){
                      if ($r[nama_gedung]==$_GET[nama_gedung]) {
                                echo "<option value=$r[id_gedung] selected>$r[nama_gedung]</option>";
                            }
                            else{
                        echo "<option value=$r[id_gedung]>$r[nama_gedung]</option>";
                      }
                    }
                echo "
                  </select>
              </div>
              <div class='form-group'>
                <label>Lokasi Kerusakan</label>
                <input type=text name='lokasi_kerusakan' class='form-control' placeholder='' required>
              </div>
            </div>
            <div class='col-md-6'>  
              <div class='form-group'>
                  <label>Jenis Kerusakan</label>
                  <select name='jenis_kerusakan' class='form-control' onchange='changeValue1(this.value)'>
                    <option value=0 selected>- Pilih Jenis Kerusakan -</option>";
                    $tampil=mysql_query("SELECT * FROM jenis_kerusakan WHERE aktif='Ya' ORDER BY id_jenis_kerusakan");
                          while($r=mysql_fetch_array($tampil)){
                      if ($r[nama_kerusakan]==$_GET[nama_kerusakan]) {
                                echo "<option value=$r[id_jenis_kerusakan] selected>$r[nama_kerusakan]</option>";
                            }
                            else{
                        echo "<option value=$r[id_jenis_kerusakan]>$r[nama_kerusakan]</option>";
                      }
                    }
                echo "
                  </select>
              </div>
              <div class='form-group'>
                <label>Upload Foto Kerusakan</label>
                <input type=file name='fupload'/>
              </div>
              <div class='form-group'>
                <label>Keterangan Kerusakan</label>
                <textarea name='keterangan_kerusakan' class='form-control' rows='3' placeholder=''></textarea>
              </div>
            </div>
          </div>
        <div class='box-footer'>
          <input type=submit value=Simpan class='btn btn-primary'> 
          <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
        </div>
      </div>
    </section>  
    </div>";
  break;
    
  case "editkerusakan":
    $edit = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_gedung, g.nama_gedung, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, k.nama_file
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                        WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "
    <div class='content-wrapper'>
      <section class='content-header'>
        <h1>
          Form Kerusakan
          <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
        </h1>
        <ol class='breadcrumb'>
          <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
          <li>Form Kerusakan</li>
        </ol>  
      </section>
      <section class='content'>
      <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Laporan Kerusakan</h3>
        </div>
        <div class='box-body'>  
          <div class='row'>
            <div class='col-md-6'>
              <form method=POST enctype='multipart/form-data' action=$aksi?module=kerusakan&act=update>
              <input type=hidden name=id value='$r[id_kerusakan]'>
              <div class='form-group'>
                <label>Tanggal Kerusakan</label>
                <div class='input-group'>
                  <input placeholder='' type='text' class='form-control pull-right' id='datepicker' name='tgl_kerusakan' value='$r[tgl_kerusakan]'>
                  <div class='input-group-addon'>
                      <i class='fa fa-calendar'></i>
                  </div>
                </div>
              </div>
              <div class='form-group'>
                <label>Pelapor</label>
                <input type=text name='pelapor' class='form-control' placeholder='' value='$r[pelapor]'>
              </div>               
              <div class='form-group'>
                <label>Gedung</label>
                <select name='gedung' class='form-control' onchange='changeValue1(this.value)'>";
                  $tampil=mysql_query("SELECT * FROM gedung WHERE aktif='Ya' ORDER BY id_gedung");
                  if ($r['id_gedung']==null){
                    echo "<option value=0 selected>- Pilih Gedung -</option>";
                  } 
                        while($v=mysql_fetch_array($tampil)){
                    if ($r[nama_gedung]==$v[nama_gedung]) {
                              echo "<option value=$v[id_gedung] selected>$v[nama_gedung]</option>";
                          }
                          else{
                      echo "<option value=$v[id_gedung]>$v[nama_gedung]</option>";
                    }
                  }
              echo "
                </select>
              </div>
              <div class='form-group'>
                <label>Lokasi Kerusakan</label>
                <input type=text name='lokasi_kerusakan' class='form-control' placeholder='' value='$r[lokasi_kerusakan]'>
              </div> 
            </div>         
            <div class='col-md-6'> 
              <div class='form-group'>
                <label>Jenis Kerusakan</label>
                <select name='jenis_kerusakan' class='form-control' onchange='changeValue1(this.value)'>";
                  $tampil=mysql_query("SELECT * FROM jenis_kerusakan WHERE aktif='Ya' ORDER BY id_jenis_kerusakan");
                  if ($r['id_jenis_kerusakan']==null){
                    echo "<option value=0 selected>- Pilih Jenis Kerusakan -</option>";
                  } 
                        while($v=mysql_fetch_array($tampil)){
                    if ($r[nama_kerusakan]==$v[nama_kerusakan]) {
                              echo "<option value=$v[id_jenis_kerusakan] selected>$v[nama_kerusakan]</option>";
                          }
                          else{
                      echo "<option value=$v[id_jenis_kerusakan]>$v[nama_kerusakan]</option>";
                    }
                  }
              echo "
                </select>
              </div>
              <div class='form-group'>
                <label>Foto Kerusakan Lama: $r[nama_file]</label>
                <br>
                <label>Ganti Foto Kerusakan</label>
                <input type=file name='fupload'/>
              </div>
              <div class='form-group'>
                <label>*) Apabila file tidak diubah, dikosongkan saja.</label>
              </div>
              <div class='form-group'>
                <label>Keterangan Kerusakan</label>
                <textarea name='keterangan_kerusakan' class='form-control' rows='3' placeholder='' >$r[keterangan_kerusakan]</textarea>
              </div>
            </div>
          </div>  
        <div class='box-footer'>
          <input type=submit value=Update class='btn btn-primary'> 
          <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
        </div>
      </div>
      </section>  
    </div>";
  break;

  case "detilkerusakan":
    $detil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_gedung, g.nama_gedung, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, k.nama_file
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                        WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($detil);
    $tgl=tgl_indo($r[tgl_kerusakan]);
    echo "
    <div class='content-wrapper'>
      <section class='content-header'>
        <h1>
          Form Kerusakan
          <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
        </h1>
        <ol class='breadcrumb'>
          <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
          <li>Form Kerusakan</li>
          <li>Informasi Laporan Kerusakan</li>
        </ol>  
      </section>
      <section class='content'>
      <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Informasi Laporan Kerusakan</h3>
        </div>
        <table class='table table-striped'>
          <tr>
            <td><b>Tanggal Kerusakan</b></td>
            <td>$tgl</td>
          </tr>
          <tr>
            <td><b>Pelapor</b></td>
            <td>$r[pelapor]</td>
          </tr>
          <tr>
            <td><b>Gedung</b></td>
            <td>$r[nama_gedung]</td>
          </tr>
          <tr>
            <td><b>Lokasi Kerusakan</b></td>
            <td>$r[lokasi_kerusakan]</td>
          </tr>
          <tr>
            <td><b>Jenis Kerusakan</b></td>
            <td>$r[nama_kerusakan]</td>
          </tr>
          <tr>
            <td><b>Foto Kerusakan</b></td>
            <td><img src='files/$r[nama_file]' width='250px' height='250px'></td>
          </tr>
          <tr>
            <td><b>Keterangan Kerusakan</b></td>
            <td>$r[keterangan_kerusakan]</td>
          </tr>
        </table>  
        <div class='box-footer'>
          <input type=button value=Kembali onclick=self.history.back() class='btn btn-danger'>
        </div>
      </div>
      </section>  
    </div>";
  break;

  case "cetakkerusakan":
    $cetak = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, k.nama_file, k.keterangan_foto
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($cetak);
    $tgl=tgl_indo($r[tgl_kerusakan]);
    echo"
    <div class='content-wrapper'>
      <section class='content'>
        <div class='box box-default'>
<table align='center'>
  <tbody>
    <tr>
        <th rowspan='5'><center><img src='images/kop_ma.png' width='106px' height='133px'/></center></th>
        <th><center><b>MAHKAMAH AGUNG RI</b></center></th>
    </tr>
    <tr>
      <td><center><b>BADAN LITBANG DIKLAT HUKUM DAN PERADILAN</b></center></td>
    </tr>
    <tr>
      <td><center>Jl.Cikopo Selatan, Desa Sukamaju, Kec. Megamendung Bogor - Jabar,18570</center></td>
    </tr>
    <tr>
      <td><center>Telp.(0251) 8249520, 8249537, 8249526,8249529, Fax.(0251) 8249532,8249531</center></td>
    </tr>
    <tr>
      <td><center>email: setbldk@mahkamahagung.go.id website: http://bldk.mahkamahagung.go.id</center></td>
    </tr>
  </tbody>
</table>
<p style='margin-top: 0px;' align='center'>================================================
</p>
<p style='margin-top: 20px; font-size:18px;' align='center' font-family='Times New Roman'>
<b>LAPORAN KERUSAKAN</b></p>

<p style='margin-top: 30px; font-size:14px;' align='center'>Pada hari $hari_ini tanggal $tgl, melaporkan kerusakan $r[nama_kerusakan] pada $r[lokasi_kerusakan] Badan Litbang Diklat Kumdil MA RI dengan rincian sebagai berikut:
<br>
$r[keterangan_kerusakan]</p>

<p style='margin-top: 30px; font-size:14px;' align='center'>Demikian laporan kerusakan ini dibuat, untuk dipergunakan sebagaimana mestinya.</p>

<p class='ttd' align='center'>
Yang Melapor <br>
<br>
<br>
<br>
<br>
<br>
$r[pelapor] 
</p>
<div class='box-footer'>
<input type=submit value=Print class='btn btn-primary'>
    <input type=button value=Kembali onclick=self.history.back() class='btn btn-danger'>
  </div>
</div>
  
</section>
</div>";  
  
  break;

  case "cetakbastkerusakan":
    $cetak = mysql_query("SELECT k.id_kerusakan, k.nomor, k.tgl_kerusakan, k.pelapor, k.id_gedung, g.nama_gedung, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, k.nama_file, k.keterangan_foto
                                          FROM kerusakan k 
                                          INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                          INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                          WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($cetak);
    $nomor = $r[nomor];
    $tgl=tgl_indo($r[tgl_kerusakan]);
    $kerusakan = $r[nama_kerusakan];
    $gedung = $r[nama_gedung];
    $ruangan = $r[lokasi_kerusakan];
    $rincian_kerusakan = $r[keterangan_kerusakan];
   //$volume = $r[volume];
    $keterangan_perbaikan = $r[keterangan_perbaikan];
   // $teknisi = $r[teknisi];
    $pelapor = $r[pelapor];


    // memanggil dan membaca template dokumen yang telah kita buat
    $document = file_get_contents("BAST_Laporan_Kerusakan.rtf");
    // isi dokumen dinyatakan dalam bentuk string
    $document = str_replace("#No", $nomor, $document);
    $document = str_replace("#Hari", $hari_ini, $document);
    $document = str_replace("#Tanggal", $tgl, $document);
    $document = str_replace("#Kerusakan", $kerusakan, $document);
    $document = str_replace("#Gedung", $gedung, $document);
    $document = str_replace("#Ruangan", $ruangan, $document);
    $document = str_replace("#RincianKerusakan", $rincian_kerusakan, $document);
    //$document = str_replace("#Volume", $volume, $document);
    $document = str_replace("#KeteranganPerbaikan", $keterangan_perbaikan, $document);
    //$document = str_replace("#Teknisi", $teknisi, $document);
    $document = str_replace("#Pelapor", $pelapor, $document);
    // header untuk membuka file output RTF dengan MS. Word
    header("Content-type: application/msword");
    header("Content-disposition: inline; filename=BAST Laporan Kerusakan.doc");
    header("Content-length: ".strlen($document));
    echo $document; 
  
  break;
}
}

?>

