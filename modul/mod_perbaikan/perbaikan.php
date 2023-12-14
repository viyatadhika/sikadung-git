<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_perbaikan/aksi_perbaikan.php";
switch ($_GET[act]) {
  default:
  echo "
  <div class='content-wrapper'>
  <section class='content-header'>
    <h1>
      Perbaikan Kerusakan
      <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
    </h1>
    <ol class='breadcrumb'>
      <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
      <li>Perbaikan Kerusakan</li>
    </ol>  
  </section>
  <section class='content'>
  <div class='row pulse animated'>
        <div class='col-xs-12'>
          <div class='box'>
          <div class='box-header with-border'>
            <center><h3 class='box-title'>Laporan Kerusakan Terkini</h3></center>
        </div>
            <div class='box-body'>
              <table id='example3' class='table table-striped table-hover table-bordered'>
              <thead>
              <tr>
                <th width='1%'>No.</th>
                <th><center>Tanggal Kerusakan</center></th>
                <th><center>Gedung</center></th>
                <th><center>Lokasi Kerusakan</center></th>
                <th><center>Jenis Kerusakan</center></th>
                <th><center>Status Perbaikan</center></th>
                <th><center>Aksi</center></th>
              </tr>
              </thead>
              <tbody>";
              $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                      k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                      FROM kerusakan k 
                                                      INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                      INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                      INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                      WHERE k.id_status_perbaikan=3 OR k.id_status_perbaikan=1 OR k.id_status_perbaikan=4 OR k.id_status_perbaikan=5 OR k.id_status_perbaikan=6
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
                <td align='center'>$r[nama_kerusakan]</td>";
                if ($r[id_status_perbaikan] == 3) {
                  echo "<td><center><span class='label label-danger'>$r[nama_status_perbaikan]</span></center></td>";
                } else {
                  echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";	
                } 
                echo"
                <td align='center'>
                  <a href=?module=perbaikan&act=detilperbaikan&id=$r[id_kerusakan] class='btn btn-info'><i class='fa fa-info-circle'></i></a>
                  <a href=?module=perbaikan&act=editperbaikan&id=$r[id_kerusakan] class='btn btn-info'><i class='fa fa-pencil'></i></a>
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
  <div class='row pulse animated'>
    <div class='col-xs-12'>
      <div class='box'>
      <div class='box-header with-border'>
        <center><h3 class='box-title'>Selesai Perbaikan Kerusakan</h3></center>
      </div>
        <div class='box-body'>
          <table id='example4' class='table table-striped table-hover table-bordered'>
          <thead>
          <tr>
            <th width='1%'>No.</th>
            <th><center>Tanggal Perbaikan</center></th>
            <th><center>Gedung</center></th>
            <th><center>Lokasi Kerusakan</center></th>
            <th><center>Jenis Kerusakan</center></th>
            <th><center>Aksi</center></th>
          </tr>
          </thead>
          <tbody>";
          $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                  k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                  FROM kerusakan k 
                                                  INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                  INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                  INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                  WHERE k.id_status_perbaikan=2
                                                  ORDER BY k.id_kerusakan DESC");
          $no = 1;
          while ($r = mysql_fetch_array($tampil)) {
          $tgl1=tgl_indo($r[tgl_perbaikan]);
          echo "
          <tr>
            <td align='center'>$no</td>
            <td align='center'>$tgl1</td>
            <td align='center'>$r[nama_gedung]</td>
            <td align='center'>$r[lokasi_kerusakan]</td>
            <td align='center'>$r[nama_kerusakan]</td>    
            <td align='center'>
              <a href=?module=perbaikan&act=detilselesaiperbaikan&id=$r[id_kerusakan] class='btn btn-info'><i class='fa fa-info-circle'></i></a>
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
    
  case "editperbaikan":
    $edit = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                        k.nama_file, k.tgl_perbaikan, sp.nama_status_perbaikan, k.volume, k.nama_file_perbaikan, k.nama_file_data_dukung, k.keterangan_perbaikan
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                        INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                        WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "
    <div class='content-wrapper'>
      <section class='content-header'>
        <h1>
          Perbaikan Kerusakan
          <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
        </h1>
        <ol class='breadcrumb'>
          <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
          <li>Perbaikan Kerusakan</li>
        </ol>  
      </section>
      <section class='content'>
      <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Perbaikan Kerusakan</h3>
        </div>
        <div class='box-body'>  
          <div class='row'>
            <div class='col-md-6'>
              <form method=POST enctype='multipart/form-data' action=$aksi?module=perbaikan&act=update>
              <input type=hidden name=id value='$r[id_kerusakan]'>
              <div class='form-group'>
                <label>Tanggal Kerusakan</label>
                <div class='input-group'>
                  <input placeholder='' type='text' class='form-control pull-right' id='datepicker' name='tgl_kerusakan' value='$r[tgl_kerusakan]' disabled>
                  <div class='input-group-addon'>
                      <i class='fa fa-calendar'></i>
                  </div>
                </div>
              </div>
              <div class='form-group'>
                <label>Pelapor</label>
                <input type=text name='pelapor' class='form-control' placeholder='' value='$r[pelapor]' disabled>
              </div>
              <div class='form-group'>
                <label>Gedung</label>
                <select name='gedung' class='form-control' onchange='changeValue1(this.value)' disabled>";
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
                <input type=text name='lokasi_kerusakan' class='form-control' placeholder='' value='$r[lokasi_kerusakan]' disabled>
              </div>
              <div class='form-group'>
                <label>Jenis Kerusakan</label>
                <select name='id_jenis_kerusakan' class='form-control' onchange='changeValue1(this.value)' disabled>";
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
                <label>Keterangan Kerusakan</label>
                <textarea name='keterangan_kerusakan' class='form-control' rows='3' placeholder='' disabled>$r[keterangan_kerusakan]</textarea>
              </div>
            </div>         
            <div class='col-md-6'> 
              <div class='form-group'>
                <label>Tanggal Perbaikan</label>
                <div class='input-group'>
                  <input placeholder='' type='text' class='form-control pull-right' id='datepicker1' name='tgl_perbaikan' value='$r[tgl_perbaikan]'>
                  <div class='input-group-addon'>
                      <i class='fa fa-calendar'></i>
                  </div>
                </div>
              </div>
              <div class='form-group'>
                <label>Status Perbaikan</label>
                <select name='id_status_perbaikan' class='form-control' onchange='changeValue1(this.value)'>";
                  $tampil=mysql_query("SELECT * FROM status_perbaikan ORDER BY id_status_perbaikan");
                  if ($r['id_status_perbaikan']==null){
                    echo "<option value=0 selected>- Pilih Status Perbaikan -</option>";
                  } 
                        while($v=mysql_fetch_array($tampil)){
                    if ($r[nama_status_perbaikan]==$v[nama_status_perbaikan]) {
                              echo "<option value=$v[id_status_perbaikan] selected>$v[nama_status_perbaikan]</option>";
                          }
                          else{
                      echo "<option value=$v[id_status_perbaikan]>$v[nama_status_perbaikan]</option>";
                    }
                  }
              echo "
                </select>
              </div>
              <div class='form-group'>
                <label>Volume</label>
                <input type=text name='volume' class='form-control' placeholder='' value='$r[volume]'>
              </div>
              <div class='form-group'>
                <label>Foto Perbaikan Lama: $r[nama_file_perbaikan]</label>
                <br>
                <label>Upload Foto Setelah Perbaikan</label>
                <input type=file name='fupload'/>
              </div>
              <div class='form-group'>
                <label>*) Apabila file tidak diubah, dikosongkan saja.</label>
              </div>
              <div class='form-group'>
                <label>File Data Dukung Lama: $r[nama_file_data_dukung]</label>
                <br>
                <label>Upload File Data Dukung</label>
                <input type=file name='fupload2'/>
              </div>
              <div class='form-group'>
                <label>*) Apabila file tidak diubah, dikosongkan saja.</label>
              </div>
              <div class='form-group'>
                <label>Keterangan Perbaikan</label>
                <textarea name='keterangan_perbaikan' class='form-control' rows='3' placeholder=''>$r[keterangan_perbaikan]</textarea>
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

  case "detilperbaikan":
    $detil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                          k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.volume, 
                          k.nama_file_perbaikan, k.nama_file_data_dukung, k.keterangan_perbaikan
                          FROM kerusakan k 
                          INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                          INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                          INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                          WHERE id_kerusakan='$_GET[id]'");
    $r    = mysql_fetch_array($detil);
    $tgl=tgl_indo($r[tgl_kerusakan]);
    $tgl1=tgl_indo($r[tgl_perbaikan]);
    echo "
    <div class='content-wrapper'>
      <section class='content-header'>
        <h1>
          Perbaikan Kerusakan
          <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
        </h1>
        <ol class='breadcrumb'>
          <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
          <li>Perbaikan Kerusakan</li>
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
          <tr>
            <td><b>Tanggal Perbaikan</b></td>";
            if ($r[tgl_perbaikan]==null){
              echo"<td>-</td>";
            }else {
              echo"<td>$tgl1</td>";
            }
          echo"      
          </tr>
          <tr>
            <td><b>Status Perbaikan</b></td>";
            if ($r[id_status_perbaikan] == 3) {
              echo "<td><span class='label label-danger'>$r[nama_status_perbaikan]</span></td>";
            } else if ($r[id_status_perbaikan] == 2){
              echo "<td><span class='label label-success'>$r[nama_status_perbaikan]</td>";	
            } else {
              echo "<td><span class='label label-warning'>$r[nama_status_perbaikan]</td>";
            }
            echo"
          </tr>
          <tr>
            <td><b>Volume</b></td>";
            if ($r[volume]==null){
              echo"<td>-</td>";
            }else {
              echo"<td>$r[volume]</td>";
            }
          echo"
          </tr>
          <tr>
            <td><b>Foto Perbaikan</b></td>";
            if ($r[nama_file_perbaikan]==null){
              echo"<td><span class='label label-info'>Foto Perbaikan Belum Ada</span></td>";
            }else {
              echo"<td><img src='files/$r[nama_file_perbaikan]' width='250px' height='250px'></td>";
            }
          echo"
          </tr>
          <tr>
            <td><b>File Data Dukung</b></td>";
            if ($r[nama_file_data_dukung]==null){
              echo"<td>-</td></td>";
            }else {
              echo"<td><a href='downlot.php?filedukung=$r[nama_file_data_dukung]'><i class='fa fa-file-o'></i> $r[nama_file_data_dukung]</a></td>";
            }
          echo"
          </tr>
          <tr>
            <td><b>Keterangan Perbaikan</b></td>";
            if ($r[keterangan_perbaikan]==null){
              echo"<td>-</td>";
            }else {
              echo"<td>$r[keterangan_perbaikan]</td>";
            }
          echo"
          </tr>
        </table>  
        <div class='box-footer'>
          <input type=button value=Kembali onclick=self.history.back() class='btn btn-danger'>
        </div>
      </div>
      </section>  
    </div>";
  break;

  case "detilselesaiperbaikan":
    $detil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                        k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.volume, k.nama_file_perbaikan, k.nama_file_data_dukung,
                                         k.keterangan_perbaikan
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                        INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                        WHERE k.id_kerusakan='$_GET[id]' AND k.id_status_perbaikan=2");
    $r    = mysql_fetch_array($detil);
    $tgl=tgl_indo($r[tgl_kerusakan]);
    $tgl1=tgl_indo($r[tgl_perbaikan]);
    echo "
    <div class='content-wrapper'>
      <section class='content-header'>
        <h1>
          Perbaikan Kerusakan
          <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
        </h1>
        <ol class='breadcrumb'>
          <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
          <li>Perbaikan Kerusakan</li>
          <li>Informasi Selesai Perbaikan Kerusakan</li>
        </ol>  
      </section>
      <section class='content'>
      <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Informasi Selesai Perbaikan Kerusakan</h3>
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
          <tr>
            <td><b>Tanggal Perbaikan</b></td>";
            if ($r[tgl_perbaikan]==null){
              echo"<td>-</td>";
            }else {
              echo"<td>$tgl1</td>";
            }
          echo"      
          </tr>
          <tr>
            <td><b>Status Perbaikan</b></td>";
            if ($r[id_status_perbaikan] == 3) {
              echo "<td><span class='label label-danger'>$r[nama_status_perbaikan]</span></td>";
            } else if ($r[id_status_perbaikan] == 2){
              echo "<td><span class='label label-success'>$r[nama_status_perbaikan]</td>";	
            } else {
              echo "<td><span class='label label-warning'>$r[nama_status_perbaikan]</td>";
            }
            echo"
          </tr>
          <tr>
            <td><b>Volume</b></td>";
            if ($r[volume]==null){
              echo"<td>-</td>";
            }else {
              echo"<td>$r[volume]</td>";
            }
          echo"
          </tr>
          <tr>
            <td><b>Foto Perbaikan</b></td>";
            if ($r[nama_file_perbaikan]==null){
              echo"<td><span class='label label-info'>Foto Perbaikan Belum Ada</span></td>";
            }else {
              echo"<td><img src='files/$r[nama_file_perbaikan]' width='250px' height='250px'></td>";
            }
          echo"
          </tr>
          <tr>
            <td><b>File Data Dukung</b></td>";
            if ($r[nama_file_data_dukung]==null){
              echo"<td>-</td></td>";
            }else {
              echo"<td><a href='downlot.php?filedukung=$r[nama_file_data_dukung]'><i class='fa fa-file-o'></i> $r[nama_file_data_dukung]</a></td>";
            }
          echo"
          </tr>
          <tr>
            <td><b>Keterangan Perbaikan</b></td>";
            if ($r[keterangan_perbaikan]==null){
              echo"<td>-</td>";
            }else {
              echo"<td>$r[keterangan_perbaikan]</td>";
            }
          echo"
          </tr>
        </table>  
        <div class='box-footer'>
          <input type=button value=Kembali onclick=self.history.back() class='btn btn-danger'>
        </div>
      </div>
      </section>  
    </div>";
  break;
}
}

?>

