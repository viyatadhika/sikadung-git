<?php
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
 echo "<link href='style.css' rel='stylesheet' type='text/css'>
<center>Untuk mengakses modul, Anda harus login <br>";
 echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
  $excel="modul/mod_usulan_ke_pihak_ketiga/excelusulankepihakketiga.php";
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
        <li>Usulan Ke Pihak Ketiga</li>
  	  </ol>  
    </section>
    <section class='content'>
    <div class='row pulse animated'>
        <div class='col-xs-12'>
          <div class='box'>
          <div class='box-header with-border'>
            <center><h3 class='box-title'>Daftar Kerusakan Yang Usulan Ke Pihak Ketiga</h3></center>
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
                                                  WHERE k.id_status_perbaikan=5
                                                  ORDER BY k.id_kerusakan DESC");
          $no = 1;
          while ($r = mysql_fetch_array($tampil)) {
          $tgl=tgl_indo($r['tgl_kerusakan']);
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
              echo "<td><center><span class='label label-success'>$r[nama_status_perbaikan]</span></center></td>";	
            } else {
              echo "<td><center><span class='label label-warning'>$r[nama_status_perbaikan]</span></center></td>";
            }
            echo"
          </tr>";
          $no++;
          }
  echo "
        </tbody>
        </table>
      </div>
      <div class='box-footer'>
        <a href=\"$excel\" class='btn btn-success'><i class='fa fa-file-excel-o'></i> Export Excel</a>
        <input type=button value=Kembali onclick=self.history.back() class='btn btn-danger'>
      </div>
      </div>
    </div>
  </div>
  </section>
  </div>";
}