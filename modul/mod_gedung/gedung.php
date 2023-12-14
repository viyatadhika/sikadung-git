<?php
session_start();
	if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
		echo "<link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
	}
	else{
		$aksi="modul/mod_gedung/aksi_gedung.php";
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
						<li>Gedung</li>
				  	</ol>  
				</section>
				<section class='content'>
				<div class='row pulse animated'>
	        		<div class='col-xs-12'>
	         			<div class='box'>
	            		<div class='box-header'>
							<input type=button value='Tambah Gedung' class='btn btn-warning' onclick=\"window.location.href='?module=gedung&act=tambahgedung';\">
						</div>
				    	<div class='box-body'>
				    		<table id='example1' class='table table-striped table-hover table-bordered'>
								<thead>
								<tr>
								<th width='1%'>No</th>
								<th>Nama Gedung</th>
								<th>Aktif</th>
								<th width='6%'><center>Aksi</center></th>
								</tr>
								</thead>"; 
								if ($_SESSION[leveluser]=='admin'){
	      						$tampil = mysql_query("SELECT * FROM gedung ORDER BY id_gedung");
							    $no=1;
								    while ($r=mysql_fetch_array($tampil)){
										echo "
											<tr>
											<td><center>$no</center></td>
										    <td>$r[nama_gedung]</td>
											<td>$r[aktif]</td>
										    <td>
										    <a href=?module=gedung&act=editgedung&id=$r[id_gedung] class='btn btn-info'><i class='fa fa-pencil'></i></a>
										    <a href=\"$aksi?module=gedung&act=hapus&id=$r[id_gedung]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\" class='btn btn-info' ><i class='fa fa-close'></i></a>
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
  
		case "tambahgedung":
		    if ($_SESSION[leveluser]=='admin'){
		    echo "
				<div class='content-wrapper'>
					<section class='content-header'>
			  		<h1>Manajemen Data
						<small><b>S</b>istem <b>I</b>nforma<b>S</b>i <b>K</b>erusakan <b>A</b>srama</small>
			  		</h1>
			  		<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Gedung</li>
			  		</ol>  
					</section>
					<section class='content'>
					<div class='box box-default'>
						<div class='box-header with-border'>
							<h3 class='box-title'>Tambah Gedung</h3>
						</div>
						<div class='box-body'>	
							<div class='row'>											
								<div class='col-md-6'>
								<form method=POST action='$aksi?module=gedung&act=input'>
									<div class='form-group'>
						                <label>Nama Gedung</label>
						                <input type='text' name='nama_gedung' class='form-control' placeholder='' required>
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
    
		case "editgedung":
			if ($_SESSION[leveluser]=='admin'){
		    	$edit=mysql_query("SELECT * FROM gedung WHERE id_gedung='$_GET[id]'");
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
						<li>Gedung</li>
			  		</ol>  
					</section>
					<section class='content'>
					<div class='box box-default'>
						<div class='box-header with-border'>
							<h3 class='box-title'>Edit Gedung</h3>
						</div>
						<div class='box-body'>	
							<div class='row'>											
								<div class='col-md-6'>
					  			<form method=POST action=$aksi?module=gedung&act=update>
					  			<input type=hidden name=id value='$r[id_gedung]'>
									<div class='form-group'>
						                <label>Nama Gedung</label>
						                <input type='text' name='nama_gedung' class='form-control' placeholder='' value='$r[nama_gedung]'>
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
