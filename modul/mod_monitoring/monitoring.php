<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_monitoring/aksi_monitoring.php";
$excel="modul/mod_monitoring/excelmonitoring.php";
$bast="modul/mod_monitoring/bast_kerusakan.php";
switch ($_GET[act]) {
  default:
  echo "
  <div class='content-wrapper'>
  <section class='content-header'>
    <h1>
      Monitoring Kerusakan
      <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
    </h1>
    <ol class='breadcrumb'>
      <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
      <li>Monitoring Kerusakan</li>
    </ol>  
  </section>
  <section class='content'>
  <div class='row pulse animated'>
    <div class='col-xs-12'>
      <div class='box'>
        <div class='box-header with-border''>
          <h3 class='box-title'>Pencarian Daftar Kerusakan</h3>
        </div>
        <div class='box-body'>
          <div class='row'>
            <div class='col-md-6'>
            <form method=get action='$_SERVER[PHP_SELF]'>
            <input type=hidden name=module value=monitoring>
              <label>Mulai Tanggal</label>
              <div class='form-group'>
                <div class='input-group'>
                  <input placeholder='' type='text' class='form-control pull-right' id='datepicker1' name='tgl_mulai'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
                </div>
              </div>
              <label>Sampai Tanggal</label>
              <div class='form-group'>
                <div class='input-group'>
                  <input placeholder='' type='text' class='form-control pull-right' id='datepicker2' name='tgl_sampai'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
                </div>
              </div>
            </div>
            <div class='col-md-6'>
              <div class='form-group'>
                <label>Status Perbaikan</label>
                <select name='status_perbaikan' class='form-control' onchange='changeValue1(this.value)'>
                  <option value=0 selected>Semua Status Perbaikan</option>";
                  $tampil=mysql_query("SELECT * FROM status_perbaikan ORDER BY id_status_perbaikan");
                        while($r=mysql_fetch_array($tampil)){
                    if ($r[nama_status_perbaikan]==$_GET[nama_status_perbaikan]) {
                              echo "<option value=$r[id_status_perbaikan] selected>$r[nama_status_perbaikan]</option>";
                          }
                          else{
                      echo "<option value=$r[id_status_perbaikan]>$r[nama_status_perbaikan]</option>";
                    }
                  }
              echo "
                </select>
              </div>
            </div>
          </div>
          </div>
          <div class='box-footer'>
            <input type=submit value=Cari class='btn btn-primary'>                 
          </div>
      </div>
    </div>
  </div>
  <div class='row pulse animated'>
        <div class='col-xs-12'>
          <div class='box'>
            <div class='box-header with-border'>
              <center><h3 class='box-title'>Riwayat Daftar Kerusakan</h3></center>
            </div>
            <div class='box-body'>";
            $tglmulai=tgl_indo($_GET[tgl_mulai]);
            $tglsampai=tgl_indo($_GET[tgl_sampai]);
            echo"
            <table class='table table-bordered'>
            <tr>
              <td><b>Mulai Tanggal</b></td>";
              if ($_GET[tgl_mulai] == null) {
                echo "<td><span class='label label-danger'> Data Belum Diisi </b></td>";
              } else {
                echo "<td><b>$tglmulai</b></td>";	
              }
            echo"  
            </tr>
            <tr>
              <td><b>Sampai Tanggal</b></td>";
              if ($_GET[tgl_sampai] == null) {
                echo "<td><span class='label label-danger'> Data Belum Diisi </b></td>";
              } else {
                echo "<td><b>$tglsampai</b></td>";	
              }
            echo"      
            </tr>
            <tr>
              <td><b>Status Perbaikan</b></td>";
              if ($_GET[status_perbaikan] == 3) {
                echo "<td><span class='label label-danger'>Belum Diperbaiki</span></td>";
              } else if ($_GET[status_perbaikan] == 1){
                echo "<td><span class='label label-warning'>Dalam Pengerjaan</td>";	
              } else if ($_GET[status_perbaikan] == 4){
                echo "<td><span class='label label-warning'>Dalam Pengecekan</td>";	
              } else if ($_GET[status_perbaikan] == 5){
                echo "<td><span class='label label-warning'>Usulan ke Pihak Ketiga</td>";	
              } else if ($_GET[status_perbaikan] == 6){
                echo "<td><span class='label label-warning'>Usulan Pengadaan Baru</td>";	
              } else if ($_GET[status_perbaikan] == 2) {
                echo "<td><span class='label label-success'>Selesai Perbaikan</td>";
              } else {
                echo "<td><span class='label label-info'> Semua Status Perbaikan </b></td>";
              }
              echo"
            </tr>
            <tr>
              <td><b>Total Kerusakan</b></td>";
              if ($_GET[tgl_sampai] == null AND $_GET[tgl_sampai] == null AND $_GET[status_perbaikan] == 0){
                echo "<td><span class='label label-danger'> Data Belum Diisi </b></td>";
              } else {
                $tgl_mulai = $_GET[tgl_mulai];
                $tgl_sampai = $_GET[tgl_sampai];
                $status_perbaikan = $_GET[status_perbaikan];
                if($_GET[status_perbaikan] == 0){
                  $data = array();
                  $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                        INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                        WHERE k.tgl_kerusakan BETWEEN '$tgl_mulai' AND '$tgl_sampai'
                                        ORDER BY k.id_kerusakan DESC");
                }else{
                  $data = array();
                  $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
                                        FROM kerusakan k 
                                        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                        INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                        WHERE k.tgl_kerusakan BETWEEN '$tgl_mulai' AND '$tgl_sampai' AND k.id_status_perbaikan = '$status_perbaikan'
                                        ORDER BY k.id_kerusakan DESC");
                }
                while ($row = mysql_fetch_array($tampil)) {
                $data[] = $row;	
                }
                $count_total = count($data);
                echo "<td><b>$count_total Kerusakan</b></td>";
              }
            echo"      
            </tr>
          </table>
              <table id='example5' class='table table-striped table-hover table-bordered'>
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
              
              $tgl_mulai = $_GET[tgl_mulai];
              $tgl_sampai = $_GET[tgl_sampai];
              $status_perbaikan = $_GET[status_perbaikan];
              if($_GET[status_perbaikan] == 0){
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
                } else if ($r[id_status_perbaikan] == 2){
                  echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</center></td>";	
                } else {
                  echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";
                }
                echo"   
                <td align='center'>
                  <a href=\"$bast?module=monitoring&act=cetakbastkerusakan&id=$r[id_kerusakan]\" target='_BLANK' class='btn btn-info'><i class='fa fa-print'></i></a>
                  <a href='?module=monitoring&act=detilkerusakan&id=$r[id_kerusakan]' class='btn btn-info'><i class='fa fa-info-circle'></i></a>
                  </td>
              </tr>";
              $no++;
              }
      echo "
        </tbody>
        </table>
      </div>
      <!-- <div class='box-footer'>
       <a href='?module=monitoring&act=excelmonitoring' class='btn btn-success'><i class='fa fa-file-excel-o'></i> Export Excel</a> 
        <a href=\"$excel\" class='btn btn-success'><i class='fa fa-file-excel-o'></i> Export Excel</a> 
        <a href= 'cetak_riwayat_kerusakan.php' target='_BLANK' class='btn btn-danger'><i class='fa fa-file-pdf-o'></i> Cetak Laporan Kerusakan</a> 	
      </div> -->
      </div>
    </div>
  </div>
  </section>
  </div>";
  break;

  case "detilkerusakan":
    $detil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                        k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan,
                                        k.volume, k.nama_file_perbaikan, k.nama_file_data_dukung, k.keterangan_perbaikan
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
          Monitoring Kerusakan
          <small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
        </h1>
        <ol class='breadcrumb'>
          <li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
          <li>Monitoring Kerusakan</li>
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

  case "excelmonitoring":
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Monitoring Kerusakan.xls");

  echo "
  <table id='example5' class='table table-striped table-hover table-bordered'>
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
      if (empty($_GET['tgl_mulai'] AND $_GET['tgl_sampai'] AND $_GET['status_perbaikan'])){
        $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
        FROM kerusakan k 
        INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
        INNER JOIN gedung g ON k.id_gedung = g.id_gedung
        INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
        ORDER BY k.id_kerusakan DESC");
      } else {
        $tgl_mulai = $_GET['tgl_mulai'];
        $tgl_sampai = $_GET['tgl_sampai'];
        $status_perbaikan = $_GET['status_perbaikan'];
        $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.id_status_perbaikan, sp.nama_status_perbaikan
                                              FROM kerusakan k 
                                              INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                              INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                              INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                              WHERE k.tgl_kerusakan BETWEEN '$tgl_mulai' AND '$tgl_sampai' AND k.id_status_perbaikan = '$status_perbaikan'
                                              ORDER BY k.id_kerusakan DESC");
      }
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
      } else if ($r[id_status_perbaikan] == 1){
        echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";	
      } else {
        echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</center></td>";
      }
      echo"   
      <td align='center'>
        <a href=?module=monitoring&act=detilkerusakan&id=$r[id_kerusakan] class='btn btn-info'><i class='fa fa-info-circle'></i></a>
        </td>
    </tr>";
    $no++;
    }
echo "
    </tbody>
  </table>";
  break;
}
}

?>

