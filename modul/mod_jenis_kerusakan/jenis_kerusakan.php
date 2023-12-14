<?php
session_start();
	if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
		echo "<link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br><a href=../../index.php><b>LOGIN</b></a></center>";
	}
	else{
		$aksi="modul/mod_jenis_kerusakan/aksi_jenis_kerusakan.php";
		switch($_GET[act]){
	    default:
	      	echo "
				<div class='content-wrapper'>
				<section class='content-header'>
				  	<h1>
						Jenis Kerusakan
						<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
				  	</h1>
				  	<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Manajemen Data</li>
						<li>Jenis Kerusakan</li>
				  	</ol>  
				</section>
				<section class='content'>
				<div class='row pulse animated'>
	        		<div class='col-xs-12'>
	         			<div class='box'>
	            		<div class='box-header'>
							<input type=button value='Tambah Jenis Kerusakan' class='btn btn-warning' onclick=\"window.location.href='?module=jenis_kerusakan&act=tambahjenis_kerusakan';\">
						</div>
				    	<div class='box-body'>
				    		<table id='example1' class='table table-striped table-hover table-bordered'>
								<thead>
								<tr>
								<th width='1%'>No</th>
								<th>Nama Kerusakan</th>
								<th>Aktif</th>
								<th width='6%'><center>Aksi</center></th>
								</tr>
								</thead>"; 
								if ($_SESSION[leveluser]=='admin'){
	      						$tampil = mysql_query("SELECT * FROM jenis_kerusakan ORDER BY id_jenis_kerusakan");
							    $no=1;
								    while ($r=mysql_fetch_array($tampil)){
										echo "
											<tr>
											<td><center>$no</center></td>
										    <td>$r[nama_kerusakan]</td>
											<td>$r[aktif]</td>
										    <td>
										    <a href=?module=jenis_kerusakan&act=editjenis_kerusakan&id=$r[id_jenis_kerusakan] class='btn btn-info'><i class='fa fa-pencil'></i></a>
										    <a href=\"$aksi?module=jenis_kerusakan&act=hapus&id=$r[id_jenis_kerusakan]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\" class='btn btn-info' ><i class='fa fa-close'></i></a>
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
  
		case "tambahjenis_kerusakan":
		    if ($_SESSION[leveluser]=='admin'){
		    echo "
				<div class='content-wrapper'>
					<section class='content-header'>
						<h1>
							Jenis Kerusakan
							<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
						</h1>
						<ol class='breadcrumb'>
							<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
							<li>Manajemen Data</li>
							<li>Jenis Kerusakan</li>
						</ol>  
					</section>
					<section class='content'>
					<div class='box box-default'>
						<div class='box-header with-border'>
							<h3 class='box-title'>Tambah Jenis Kerusakan</h3>
						</div>
						<div class='box-body'>	
							<div class='row'>											
								<div class='col-md-6'>
								<form method=POST action='$aksi?module=jenis_kerusakan&act=input'>
									<div class='form-group'>
						                <label>Nama Kerusakan</label>
						                <input type='text' name='nama_kerusakan' class='form-control' placeholder='' required>
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
    
		case "editjenis_kerusakan":
			if ($_SESSION[leveluser]=='admin'){
		    	$edit=mysql_query("SELECT * FROM jenis_kerusakan WHERE id_jenis_kerusakan='$_GET[id]'");
		    }

		    $r=mysql_fetch_array($edit);
		    
		    echo "
				<div class='content-wrapper'>
					<section class='content-header'>
						<h1>
							Jenis Kerusakan
							<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
						</h1>
						<ol class='breadcrumb'>
							<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
							<li>Manajemen Data</li>
							<li>Jenis Kerusakan</li>
						</ol>  
					</section>
					<section class='content'>
					<div class='box box-default'>
						<div class='box-header with-border'>
							<h3 class='box-title'>Edit Jenis Kerusakan</h3>
						</div>
						<div class='box-body'>	
							<div class='row'>											
								<div class='col-md-6'>
					  			<form method=POST action=$aksi?module=jenis_kerusakan&act=update>
					  			<input type=hidden name=id value='$r[id_jenis_kerusakan]'>
									<div class='form-group'>
						                <label>Nama Kerusakan</label>
						                <input type='text' name='nama_kerusakan' class='form-control' placeholder='' value='$r[nama_kerusakan]'>
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
