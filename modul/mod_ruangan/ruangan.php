<?php
session_start();
	if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
		echo "<link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
	}
	else{
		$aksi="modul/mod_ruangan/aksi_ruangan.php";
		switch($_GET[act]){
	    default:
	      	echo "
				<div class='content-wrapper'>
				<section class='content-header'>
				  	<h1>
						Manajemen Data
						<small><b>S</b>istem <b>I</b>nforma<b>S</b>i <b>K</b>erusakan <b>A</b>srama</small>
				  	</h1>
				  	<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Ruangan</li>
				  	</ol>  
				</section>
				<section class='content'>
				<div class='row'>
	        		<div class='col-xs-12'>
	         			<div class='box'>
	            		<div class='box-header'>
							<input type=button value='Tambah Ruangan' class='btn btn-warning' onclick=\"window.location.href='?module=ruangan&act=tambahruangan';\">
						</div>
				    	<div class='box-body'>
				    		<table id='example1' class='table table-striped table-hover table-bordered'>
								<thead>
								<tr>
								<th width='1%'>No</th>
								<th>Nama Ruangan</th>
								<th>Gedung</th>
								<th>Lantai</th>
								<th>Aktif</th>
								<th width='6%'><center>Aksi</center></th>
								</tr>
								</thead>"; 
								if ($_SESSION[leveluser]=='admin'){
	      						$tampil = mysql_query("SELECT r.id_ruangan, r.nama_ruangan, gd.nama_gedung, l.nama_lantai, r.aktif
														FROM ruangan r 
														INNER JOIN gedung gd ON r.id_gedung = gd.id_gedung
														INNER JOIN lantai l ON r.id_lantai = l.id_lantai
														ORDER BY nama_ruangan, nama_gedung ASC");
							    $no=1;
								    while ($r=mysql_fetch_array($tampil)){
										echo "
											<tr>
											<td><center>$no</center></td>
										    <td>$r[nama_ruangan]</td>
										    <td>$r[nama_gedung]</td>
										    <td>$r[nama_lantai]</td>
											<td>$r[aktif]</td>
										    <td>
										    <a href=?module=ruangan&act=editruangan&id=$r[id_ruangan] class='btn btn-info'><i class='fa fa-pencil'></i></a>
										    <a href=\"$aksi?module=ruangan&act=hapus&id=$r[id_ruangan]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\" class='btn btn-info' ><i class='fa fa-close'></i></a>
										    </td>
										    </tr>";
								      $no++;
								    }
								}

					echo "
							</table>
						</div>
						</div>
					</div>
				</div>
				</div>
				</section>";
		break;
  
		case "tambahruangan":
		    if ($_SESSION[leveluser]=='admin'){
		    echo "
				<div class='content-wrapper'>
					<section class='content-header'>
			  		<h1>Manajemen Data
						<small><b>S</b>istem <b>I</b>nforma<b>S</b>i <b>K</b>erusakan <b>A</b>srama</small>
			  		</h1>
			  		<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Ruangan</li>
			  		</ol>  
					</section>
					<section class='content'>
					<div class='box box-default'>
						<div class='box-header with-border'>
							<h3 class='box-title'>Tambah Ruangan</h3>
						</div>
						<div class='box-body'>	
							<div class='row'>
								<form method=POST action='$aksi?module=ruangan&act=input'>											
								<div class='col-md-6'>								
									<div class='form-group'>
						                <label>Nama Ruangan</label>
						                <input type='text' name='nama_ruangan' class='form-control' placeholder='' required>
						            </div>
						            <div class='form-group'>
						                <label>Nama Gedung</label>
						                <select name='id_gedung' class='form-control' onchange='changeValue1(this.value)'>
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
						        </div>   
						        <div class='col-md-6'> 
						        	<div class='form-group'>
						                <label>Nama Lantai</label>
						                <select name='id_lantai' class='form-control' onchange='changeValue2(this.value)'>
											<option value=0 selected>- Pilih Lantai -</option>";
											$tampil=mysql_query("SELECT * FROM lantai WHERE aktif='Ya' ORDER BY id_lantai");
								            while($r=mysql_fetch_array($tampil)){
												if ($r[nama_lantai]==$_GET[nama_lantai]) {
									              	echo "<option value=$r[id_lantai] selected>$r[nama_lantai]</option>";
									            }
									            else{
												 	echo "<option value=$r[id_lantai]>$r[nama_lantai]</option>";
												}
											}
									echo "
										</select>
						            </div>
						            <div class='form-group'>
						                <label>Aktif</label>
						                <br>
										<label class='radio-inline'>
										<input type='radio' name='aktif' value='Ya' checked>Ya
										</label>
										<label class='radio-inline'>
										<input type='radio' name='aktif' value='Tidak'>Tidak
										</label>
						            </div>
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
			}
			else{
			echo "Anda tidak berhak mengakses halaman ini.";
			}
		break;
    
		case "editruangan":
			if ($_SESSION[leveluser]=='admin'){
		    	$edit=mysql_query("SELECT r.id_ruangan, r.nama_ruangan, gd.nama_gedung, l.nama_lantai, r.aktif
									FROM ruangan r 
									INNER JOIN gedung gd ON r.id_gedung = gd.id_gedung
									INNER JOIN lantai l ON r.id_lantai = l.id_lantai 
									WHERE id_ruangan='$_GET[id]'");
		    }

		    $r=mysql_fetch_array($edit);
		    
		    echo "
				<div class='content-wrapper'>
					<section class='content-header'>
			  		<h1>Manajemen Data
						<small><b>S</b>istem <b>I</b>nforma<b>S</b>i <b>K</b>erusakan <b>A</b>srama</small>
			  		</h1>
			  		<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Ruangan</li>
			  		</ol>  
					</section>
					<section class='content'>
					<div class='box box-default'>
						<div class='box-header with-border'>
							<h3 class='box-title'>Edit Ruangan</h3>
						</div>
						<div class='box-body'>	
							<div class='row'>
								<form method=POST action=$aksi?module=ruangan&act=update>
					  			<input type=hidden name=id value='$r[id_ruangan]'>											
								<div class='col-md-6'>
					  				<div class='form-group'>
						                <label>Nama Ruangan</label>
						                <input type='text' name='nama_ruangan' class='form-control' placeholder='' value='$r[nama_ruangan]'>
						            </div>
						            <div class='form-group'>
						                <label>Nama Gedung</label>
						                <select name='id_gedung' class='form-control' onchange='changeValue1(this.value)'>";
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
						        </div>
						        <div class='col-md-6'>
						            <div class='form-group'>
						                <label>Nama Lantai</label>
						                <select name='id_lantai' class='form-control' onchange='changeValue2(this.value)'>";
											$tampil=mysql_query("SELECT * FROM lantai WHERE aktif='Ya' ORDER BY id_lantai");
											if ($r['id_lantai']==null){
												echo "<option value=0 selected>- Pilih Lantai -</option>";
											} 
								            while($c=mysql_fetch_array($tampil)){
												if ($r[nama_lantai]==$c[nama_lantai]) {
									              	echo "<option value=$c[id_lantai] selected>$c[nama_lantai]</option>";
									            }
									            else{
												 	echo "<option value=$c[id_lantai]>$c[nama_lantai]</option>";
												}
											}
									echo "
										</select>
						            </div>";
						            if ($r[aktif]=='Ya'){
							        echo "  
							        	<div class='form-group'>
							            	<label>Aktif</label>
							                <br>
											<label class='radio-inline'>
											<input type='radio' name='aktif' value='Ya' checked>Ya
											</label>
											<label class='radio-inline'>
											<input type='radio' name='aktif' value='Tidak'>Tidak
											</label>
										</div>";		            	
    								}
    								else{
    								echo "	
    									<div class='form-group'>
	    									<label>Aktif</label>
							                <br>
											<label class='radio-inline'>
											<input type='radio' name='aktif' value='Ya'>Ya
											</label>
											<label class='radio-inline'>
											<input type='radio' name='aktif' value='Tidak' checked>Tidak
											</label>
						            	</div>";
   									}            
						    echo"    </div>							
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
		}
	}
?>
