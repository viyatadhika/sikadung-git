<?php
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";

if ($_GET['module'] == 'home') {
  if ($_SESSION['leveluser'] == 'admin') {
    $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
    $r    = mysql_fetch_array($sql);
    echo "
	<div class='content-wrapper'>
    <section class='content-header'>
  	  <h1>
  		Dashboard
  		<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
  	  </h1>
  	  <ol class='breadcrumb'>
    		<li><i class='fa fa-dashboard'></i> Home</a></li>
    		<li><a href='?module=home'>Dashboard</a></li>
  	  </ol>  
    </section>
    <section class='content'>
    <div class='callout callout-info pulse animated'>
		  <h4>Hai $_SESSION[namalengkap], Selamat datang di halaman administrator <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b>. Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten aplikasi anda.</h4>
    </div>";
    echo "
    <!--<div class='box box-default pulse animated'>
          <table class='table table-striped'>
          <tr>
            <td><b>Kementerian/Lembaga</b></td>
            <td><b>$r[kementerian]</b></td>
          </tr>
          <tr>
            <td><b>Instansi</b></td>
            <td><b>$r[satker]</b></td>
          </tr>
          <tr>
            <td><b>Satuan Kerja </b></td>
            <td><b>$r[instansi]</b></td>
          </tr>
          <tr>
            <td><b>Alamat Satker/Instansi</b></td>
            <td><b>$r[alamat_instansi]</b></td>
          </tr>
          <tr>
        </table>                            
    </div>-->
    <div class='row'>  
        <div class='col-md-4'>
          <div class='small-box bg-red bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_belum = count($data);
          echo"
              <h3>$count_belum</h3>
              <p>BELUM DIPERBAIKI</p>
            </div>
            <div class='icon'>
              <i class='ion ion-medkit'></i>
            </div>
            <a href='?module=belum_diperbaiki' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-green bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=2
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>SELESAI PERBAIKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-settings'></i>
            </div>
            <a href='?module=selesai_perbaikan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=4
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGECEKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-calendar'></i>
            </div>
            <a href='?module=dalam_pengecekan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
      </div>
      <div class='row'>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=1
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGERJAAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-clock'></i>
            </div>
            <a href='?module=dalam_pengerjaan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=6
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>USULAN PENGADAAN BARU</p>
            </div>
            <div class='icon'>
              <i class='ion ion-bag'></i>
            </div>
            <a href='?module=usulan_pengadaan_baru' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=5
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>USULAN KE PIHAK KETIGA</p>
            </div>
            <div class='icon'>
              <i class='ion ion-cube'></i>
            </div>
            <a href='?module=usulan_ke_pihak_ketiga' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>

        <div class='col-md-12'>
          <div class='small-box bg-gray bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>TOTAL KERUSAKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-wrench'></i>
            </div>
            <a href='?module=total_kerusakan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
      </div>  

    <div class='row'>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Grafik Total Kerusakan Per Gedung</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart' style='height:550px'></canvas>
          </div>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Rekapitulasi Jenis Kerusakan</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart1' style='height:550px'></canvas>
          </div>
        </div>
      </div>
    </div>

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
            </tr>
            </thead>
            <tbody>";
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3 OR k.id_status_perbaikan=1
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
              } else if ($r[id_status_perbaikan] == 1){
                echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";	
              } else {
                echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</center></td>";
              }
              echo"
            </tr>";
            $no++;
            }
    echo "
          </tbody>
          </table>
          </div>
        </div>
    </div>
  </div>";
    echo "<p align=right>Login : $hari_ini, ";
    echo tgl_indo(date("Y m d"));
    echo " | ";
    echo date("H:i:s");
    echo " WIB</p>
    </section>
  </div>";
  } elseif ($_SESSION['leveluser'] == 'teknisi') {
      $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
      $r    = mysql_fetch_array($sql);
      echo "
      <div class='content-wrapper'>
    <section class='content-header'>
  	  <h1>
  		Dashboard
  		<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
  	  </h1>
  	  <ol class='breadcrumb'>
    		<li><i class='fa fa-dashboard'></i> Home</a></li>
    		<li><a href='?module=home'>Dashboard</a></li>
  	  </ol>  
    </section>
    <section class='content'>
    <div class='callout callout-info pulse animated'>
		  <h4>Hai $_SESSION[namalengkap], Selamat datang di halaman teknisi <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b>. Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten aplikasi anda.</h4>
    </div>";
    echo "
    <!--<div class='box box-default pulse animated'>
          <table class='table table-striped'>
          <tr>
            <td><b>Kementerian/Lembaga</b></td>
            <td><b>$r[kementerian]</b></td>
          </tr>
          <tr>
            <td><b>Instansi</b></td>
            <td><b>$r[satker]</b></td>
          </tr>
          <tr>
            <td><b>Satuan Kerja </b></td>
            <td><b>$r[instansi]</b></td>
          </tr>
          <tr>
            <td><b>Alamat Satker/Instansi</b></td>
            <td><b>$r[alamat_instansi]</b></td>
          </tr>
          <tr>
        </table>                            
    </div>-->
    <div class='row'>  
        <div class='col-md-4'>
          <div class='small-box bg-red bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_belum = count($data);
          echo"
              <h3>$count_belum</h3>
              <p>BELUM DIPERBAIKI</p>
            </div>
            <div class='icon'>
              <i class='ion ion-medkit'></i>
            </div>
            <a href='?module=belum_diperbaiki' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-green bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=2
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>SELESAI PERBAIKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-settings'></i>
            </div>
            <a href='?module=selesai_perbaikan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=4
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGECEKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-calendar'></i>
            </div>
            <a href='?module=dalam_pengecekan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
      </div>
      <div class='row'>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=1
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGERJAAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-clock'></i>
            </div>
            <a href='?module=dalam_pengerjaan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=6
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>USULAN PENGADAAN BARU</p>
            </div>
            <div class='icon'>
              <i class='ion ion-bag'></i>
            </div>
            <a href='?module=usulan_pengadaan_baru' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=5
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>USULAN KE PIHAK KETIGA</p>
            </div>
            <div class='icon'>
              <i class='ion ion-cube'></i>
            </div>
            <a href='?module=usulan_ke_pihak_ketiga' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>

        <div class='col-md-12'>
          <div class='small-box bg-gray bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>TOTAL KERUSAKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-wrench'></i>
            </div>
            <a href='?module=total_kerusakan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
      </div>  

    <div class='row'>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Grafik Total Kerusakan Per Gedung</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart' style='height:550px'></canvas>
          </div>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Rekapitulasi Jenis Kerusakan</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart1' style='height:550px'></canvas>
          </div>
        </div>
      </div>
    </div>     
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
            </tr>
            </thead>
            <tbody>";
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3 OR k.id_status_perbaikan=1
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
              } else if ($r[id_status_perbaikan] == 1){
                echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";	
              } else {
                echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</center></td>";
              }
              echo"
            </tr>";
            $no++;
            }
    echo "
          </tbody>
          </table>
          </div>
        </div>
    </div>
  </div>";
      echo "<p align=right>Login : $hari_ini, ";
      echo tgl_indo(date("Y m d"));
      echo " | ";
      echo date("H:i:s");
      echo " WIB</p>
      </section>
    </div>";
  } elseif ($_SESSION['leveluser'] == 'supervisor') {
      $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
      $r    = mysql_fetch_array($sql);
      echo "
      <div class='content-wrapper'>
    <section class='content-header'>
  	  <h1>
  		Dashboard
  		<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
  	  </h1>
  	  <ol class='breadcrumb'>
    		<li><i class='fa fa-dashboard'></i> Home</a></li>
    		<li><a href='?module=home'>Dashboard</a></li>
  	  </ol>  
    </section>
    <section class='content'>
    <div class='callout callout-info pulse animated'>
		  <h4>Hai $_SESSION[namalengkap], Selamat datang di halaman supervisor <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b>. Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten aplikasi anda.</h4>
    </div>";
    echo "
    <!--<div class='box box-default pulse animated'>
          <table class='table table-striped'>
          <tr>
            <td><b>Kementerian/Lembaga</b></td>
            <td><b>$r[kementerian]</b></td>
          </tr>
          <tr>
            <td><b>Instansi</b></td>
            <td><b>$r[satker]</b></td>
          </tr>
          <tr>
            <td><b>Satuan Kerja </b></td>
            <td><b>$r[instansi]</b></td>
          </tr>
          <tr>
            <td><b>Alamat Satker/Instansi</b></td>
            <td><b>$r[alamat_instansi]</b></td>
          </tr>
          <tr>
        </table>                            
    </div>-->
    <div class='row'>  
        <div class='col-md-4'>
          <div class='small-box bg-red bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_belum = count($data);
          echo"
              <h3>$count_belum</h3>
              <p>BELUM DIPERBAIKI</p>
            </div>
            <div class='icon'>
              <i class='ion ion-medkit'></i>
            </div>
            <a href='?module=belum_diperbaiki' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-green bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=2
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>SELESAI PERBAIKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-settings'></i>
            </div>
            <a href='?module=selesai_perbaikan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=4
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGECEKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-calendar'></i>
            </div>
            <a href='?module=dalam_pengecekan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
      </div>
      <div class='row'>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=1
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGERJAAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-clock'></i>
            </div>
            <a href='?module=dalam_pengerjaan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=6
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>USULAN PENGADAAN BARU</p>
            </div>
            <div class='icon'>
              <i class='ion ion-bag'></i>
            </div>
            <a href='?module=usulan_pengadaan_baru' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=5
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>USULAN KE PIHAK KETIGA</p>
            </div>
            <div class='icon'>
              <i class='ion ion-cube'></i>
            </div>
            <a href='?module=usulan_ke_pihak_ketiga' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>

        <div class='col-md-12'>
          <div class='small-box bg-gray bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>TOTAL KERUSAKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-wrench'></i>
            </div>
            <a href='?module=total_kerusakan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
      </div>  

    <div class='row'>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Grafik Total Kerusakan Per Gedung</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart' style='height:550px'></canvas>
          </div>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Rekapitulasi Jenis Kerusakan</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart1' style='height:550px'></canvas>
          </div>
        </div>
      </div>
    </div>    
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
            </tr>
            </thead>
            <tbody>";
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3 OR k.id_status_perbaikan=1
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
              } else if ($r[id_status_perbaikan] == 1){
                echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";	
              } else {
                echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</center></td>";
              }
              echo"
            </tr>";
            $no++;
            }
    echo "
          </tbody>
          </table>
          </div>
        </div>
    </div>
  </div>";
      echo "<p align=right>Login : $hari_ini, ";
      echo tgl_indo(date("Y m d"));
      echo " | ";
      echo date("H:i:s");
      echo " WIB</p>
      </section>
    </div>";
  } elseif ($_SESSION['leveluser'] == 'pimpinan') {
      $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
      $r    = mysql_fetch_array($sql);
      echo "
      <div class='content-wrapper'>
    <section class='content-header'>
  	  <h1>
  		Dashboard
  		<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
  	  </h1>
  	  <ol class='breadcrumb'>
    		<li><i class='fa fa-dashboard'></i> Home</a></li>
    		<li><a href='?module=home'>Dashboard</a></li>
  	  </ol>  
    </section>
    <section class='content'>
    <div class='callout callout-info pulse animated'>
		  <h4>Hai $_SESSION[namalengkap], Selamat datang di halaman pimpinan <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b>. Silahkan klik menu pilihan yang berada di sebelah kiri untuk mengelola konten aplikasi anda.</h4>
    </div>";
    echo "
    <!--<div class='box box-default pulse animated'>
          <table class='table table-striped'>
          <tr>
            <td><b>Kementerian/Lembaga</b></td>
            <td><b>$r[kementerian]</b></td>
          </tr>
          <tr>
            <td><b>Instansi</b></td>
            <td><b>$r[satker]</b></td>
          </tr>
          <tr>
            <td><b>Satuan Kerja </b></td>
            <td><b>$r[instansi]</b></td>
          </tr>
          <tr>
            <td><b>Alamat Satker/Instansi</b></td>
            <td><b>$r[alamat_instansi]</b></td>
          </tr>
          <tr>
        </table>                            
    </div>-->
    <div class='row'>  
        <div class='col-md-4'>
          <div class='small-box bg-red bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=3
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_belum = count($data);
          echo"
              <h3>$count_belum</h3>
              <p>BELUM DIPERBAIKI</p>
            </div>
            <div class='icon'>
              <i class='ion ion-medkit'></i>
            </div>
            <a href='?module=belum_diperbaiki' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-green bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=2
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>SELESAI PERBAIKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-settings'></i>
            </div>
            <a href='?module=selesai_perbaikan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=4
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGECEKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-calendar'></i>
            </div>
            <a href='?module=dalam_pengecekan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>  
      </div>
      <div class='row'>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=1
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_pengerjaan = count($data);
          echo"
              <h3>$count_pengerjaan</h3>
              <p>DALAM PENGERJAAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-clock'></i>
            </div>
            <a href='?module=dalam_pengerjaan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=6
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>USULAN PENGADAAN BARU</p>
            </div>
            <div class='icon'>
              <i class='ion ion-bag'></i>
            </div>
            <a href='?module=usulan_pengadaan_baru' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
        <div class='col-md-4'>
          <div class='small-box bg-yellow bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    WHERE k.id_status_perbaikan=5
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_perbaikan = count($data);
          echo"
              <h3>$count_perbaikan</h3>
              <p>USULAN KE PIHAK KETIGA</p>
            </div>
            <div class='icon'>
              <i class='ion ion-cube'></i>
            </div>
            <a href='?module=usulan_ke_pihak_ketiga' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>

        <div class='col-md-12'>
          <div class='small-box bg-gray bounceIn animated'>
            <div class='inner'>";
            $data = array();
            $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                    k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                    FROM kerusakan k 
                                                    INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                    INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                    ORDER BY k.id_kerusakan DESC");
          while ($row = mysql_fetch_array($tampil)) {
            $data[] = $row;
          }
          $count_total = count($data);
          echo"
          <h3>$count_total</h3>
              <p>TOTAL KERUSAKAN</p>
            </div>
            <div class='icon'>
              <i class='ion ion-wrench'></i>
            </div>
            <a href='?module=total_kerusakan' class='small-box-footer'>More info <i class='fa fa-arrow-circle-right'></i></a>
          </div>
        </div>
      </div>  

    <div class='row'>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Grafik Total Kerusakan Per Gedung</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart' style='height:550px'></canvas>
          </div>
        </div>
      </div>
      <div class='col-md-6'>
        <div class='box'>
          <div class='box-header with-border'>
          <center><h3 class='box-title'>Rekapitulasi Jenis Kerusakan</h3></center>
          </div>
          <div class='box-body'>
            <canvas id='myChart1' style='height:550px'></canvas>
          </div>
        </div>
      </div>
    </div>    
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
              </tr>
              </thead>
              <tbody>";
              $tampil = mysql_query("SELECT k.id_kerusakan, k.tgl_kerusakan, k.pelapor, k.id_jenis_kerusakan, jk.nama_kerusakan, k.id_gedung, g.nama_gedung, k.lokasi_kerusakan, k.keterangan_kerusakan, 
                                                      k.nama_file, k.tgl_perbaikan, k.id_status_perbaikan, sp.nama_status_perbaikan, k.nama_file_perbaikan, k.keterangan_perbaikan
                                                      FROM kerusakan k 
                                                      INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan
                                                      INNER JOIN gedung g ON k.id_gedung = g.id_gedung
                                                      INNER JOIN status_perbaikan sp ON k.id_status_perbaikan = sp.id_status_perbaikan
                                                      WHERE k.id_status_perbaikan=3 OR k.id_status_perbaikan=1
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
                } else if ($r[id_status_perbaikan] == 1){
                  echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</center></td>";	
                } else {
                  echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</center></td>";
                }
                echo"
              </tr>";
              $no++;
              }
      echo "
            </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>";
      echo "<p align=right>Login : $hari_ini, ";
      echo tgl_indo(date("Y m d"));
      echo " | ";
      echo date("H:i:s");
      echo " WIB</p>
      </section>
    </div>";
  }
  } elseif ($_GET['module'] == 'user') {
    if ($_SESSION['leveluser'] == 'admin') {
      include "modul/mod_users/users.php";
    }
  } elseif ($_GET['module'] == 'identitas') {
    if ($_SESSION['leveluser'] == 'admin') {
      include "modul/mod_identitas/identitas.php";
    }
  } elseif ($_GET['module'] == 'gedung') {
    if ($_SESSION['leveluser'] == 'admin') {
      include "modul/mod_gedung/gedung.php";
    }
  } elseif ($_GET['module'] == 'lantai') {
    if ($_SESSION['leveluser'] == 'admin') {
      include "modul/mod_lantai/lantai.php";
    }
  } elseif ($_GET['module'] == 'ruangan') {
    if ($_SESSION['leveluser'] == 'admin') {
      include "modul/mod_ruangan/ruangan.php";
    }
  } elseif ($_GET['module'] == 'jenis_kerusakan') {
    if ($_SESSION['leveluser'] == 'admin') {
      include "modul/mod_jenis_kerusakan/jenis_kerusakan.php";
    }
  } elseif ($_GET['module'] == 'kerusakan') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor') {
      include "modul/mod_kerusakan/kerusakan.php";
    }
  } elseif ($_GET['module'] == 'perbaikan') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi') {
      include "modul/mod_perbaikan/perbaikan.php";
    }
  } elseif ($_GET['module'] == 'monitoring') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_monitoring/monitoring.php";
    }
  } elseif ($_GET['module'] == 'total_kerusakan') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_total_kerusakan/total_kerusakan.php";
    }
  } elseif ($_GET['module'] == 'belum_diperbaiki') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_belum_diperbaiki/belum_diperbaiki.php";
    }
  } elseif ($_GET['module'] == 'selesai_perbaikan') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_selesai_perbaikan/selesai_perbaikan.php";
    }
  } elseif ($_GET['module'] == 'dalam_pengecekan') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_dalam_pengecekan/dalam_pengecekan.php";
    }
  } elseif ($_GET['module'] == 'dalam_pengerjaan') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_dalam_pengerjaan/dalam_pengerjaan.php";
    }
  } elseif ($_GET['module'] == 'usulan_pengadaan_baru') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_usulan_pengadaan_baru/usulan_pengadaan_baru.php";
    }
  } elseif ($_GET['module'] == 'usulan_ke_pihak_ketiga') {
    if ($_SESSION['leveluser'] == 'admin' OR $_SESSION['leveluser'] == 'teknisi' OR $_SESSION['leveluser'] == 'supervisor' OR $_SESSION['leveluser'] == 'pimpinan') {
      include "modul/mod_usulan_ke_pihak_ketiga/usulan_ke_pihak_ketiga.php";
    }
  }
else {
  echo "
  <div class='content-wrapper'>
    <section class='content-header'>
      <h1>
        404 Error Page
      </h1>
      <ol class='breadcrumb'>
        <li><a href='#'><i class='fa fa-dashboard'></i> Home</a></li>
        <li class='active'>404 error</li>
      </ol>
    </section>
    <section class='content'>
      <div class='error-page'>
        <div class='error-content'>
          <h1 class='headline text-yellow' align='center'> 404</h1> 
          <h3><i class='fa fa-warning text-yellow'></i> Oops! Page not found.</h3>
          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href='?module=home'>return to dashboard</a>
          </p>
       </div> 
      </div>
    </section>
  </div>
  
  <!-- 
  == Menghitung total kerusakan per gedung ==
  SELECT k.id_jenis_kerusakan, jk.nama_kerusakan, COUNT(k.id_jenis_kerusakan) AS jumlah_kerusakan
  FROM kerusakan k
  INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan 
  GROUP BY id_jenis_kerusakan 

  == Menghitung rekapitulasi kerusakan per jenis kerusakan ==  
  SELECT k.id_gedung, g.nama_gedung, COUNT(k.id_gedung) AS jumlah_kerusakan
  FROM kerusakan k
  INNER JOIN gedung g ON k.id_gedung = g.id_gedung 
  GROUP BY id_gedung 
  
  -->

  ";
 
}

