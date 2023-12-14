<?php
$aksi="modul/mod_identitas/aksi_identitas.php";
switch($_GET[act]){
  default:
    $sql  = mysql_query("SELECT * FROM identitas");
    $r    = mysql_fetch_array($sql);

    echo "
	<div class='content-wrapper'>
	<section class='content-header'>
	  <h1>
		Identitas Instansi
		<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
	  </h1>
	  <ol class='breadcrumb'>
		<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
		<li>Manajemen Sistem</li>
		<li>Identitas Instansi</li>
	  </ol>  
	</section>
	<section class='content'>
	<div class='box box-default pulse animated'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Update Identitas Instansi</h3>
        </div>
        <div class='box-body'>  
          	<div class='row'>
	            <div class='col-md-6'>
				<form method=POST enctype='multipart/form-data' action=$aksi?module=identitas&act=update>
					<input type=hidden name=id value=$r[id_identitas]>
					<div class='form-group'>
						<label>Kementerian/Lembaga</label>
						<input type=text name='kementerian' class='form-control' placeholder='' value='$r[kementerian]'>
					</div>
					<div class='form-group'>
						<label>Satuan Kerja</label>
						<input type=text name='satker' class='form-control' placeholder='' value='$r[satker]'>
					</div>
					
	            </div>
	            <div class='col-md-6'>
					<div class='form-group'>
						<label>Instansi</label>
						<input type=text name='instansi' class='form-control' placeholder='' value='$r[instansi]'>
					</div>
					<div class='form-group'>
						<label>Alamat Satker/Instansi</label>
						<input type=text name='alamat_instansi' class='form-control' placeholder='' value='$r[alamat_instansi]'>
					</div>
			   	</div>
			</div>
		</div>
	   	<div class='panel-footer'><input type=submit value=Update class='btn btn-primary'> 
	  		<input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
	  	</div>
	</div>
	</section>
	</div>";
    break;  
}
?>
