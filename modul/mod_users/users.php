<?php
session_start();
	if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
		echo "<link href='style.css' rel='stylesheet' type='text/css'>
			<center>Untuk mengakses modul, Anda harus login <br>";
	  	echo "<a href=../../index.php><b>LOGIN</b></a></center>";
	}
	else{
		$aksi="modul/mod_users/aksi_users.php";
		switch($_GET[act]){
		    default:
		    if ($_SESSION[leveluser]=='admin'){
		    $tampil = mysql_query("SELECT * FROM users ORDER BY username");
		    echo "
				<div class='content-wrapper'>
				<section class='content-header'>
					<h1>
						Hak Akses User
						<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
					</h1>
					<ol class='breadcrumb'>
							<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
							<li>Manajemen Sistem</li>
							<li>Hak Akses User</li>
					</ol>  
				</section>
				<section class='content'>
				<div class='row pulse animated'>
	        		<div class='col-xs-12'>
	         			<div class='box'>
	            		<div class='box-header'>
							<input type=button value='Tambah User' class='btn btn-warning' onclick=\"window.location.href='?module=user&act=tambahuser';\">
						</div>";
		    }
		    else{
	      	$tampil=mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
  			echo "
				<div class='content-wrapper'>
				<section class='content-header'>
					<h1>
						Hak Akses User
						<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
					</h1>
					<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Manajemen Sistem</li>
						<li>Hak Akses User</li>
					</ol>  
				</section>
				<section class='content'>
				<div class='row'>
	        		<div class='col-xs-12'>
	         			<div class='box'>
	            		<div class='box-header'>";
   			}	 
   			echo "   
		    	<div class='box-body'>
		    		<table id='example1' class='table table-striped table-hover table-bordered'>
						<thead>
						<tr>
							<th width='1%'><center>No</center></th>
							<th><center>Nama Lengkap</center></th>
							<th><center>Blokir</center></th>
							<th width='6%'><center>Aksi</center></th>
						</tr>
						</thead>";
						$no=1;
						while ($r=mysql_fetch_array($tampil)){	
			echo "			<tr>
							<td><center>$no</center></td>
							<td>$r[nama_lengkap]</td>
							<td><center>$r[blokir]</center></td>
							<td><center>
								<a href=?module=user&act=edituser&id=$r[id_session] class='btn btn-info'><i class='fa fa-pencil'></i></a>
								<a href=\"$aksi?module=user&act=delete&id=$r[id_session]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\" class='btn btn-info' >
								<i class='fa fa-close'></i></a>
								</center></td>
						</tr>";
						$no++;
						}
		   
		    echo"		</table>
		    	</div>
				</div>
				</div>
				</div>
				</div>
				</section>";
		break;
  
  		case "tambahuser":
    	if ($_SESSION[leveluser]=='admin'){
    	echo "
			<div class='content-wrapper'>
			<section class='content-header'>
				<h1>
					Hak Akses User
					<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
				</h1>
				<ol class='breadcrumb'>
					<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
					<li>Manajemen Sistem</li>
					<li>Hak Akses User</li>
				</ol>  
				</section>
				<section class='content'>
				<div class='box box-default'>
					<div class='box-header with-border'>
						<h3 class='box-title'>Tambah User</h3>
					</div>
					<div class='box-body'>	
						<div class='row'>	
						<form method=POST action='$aksi?module=user&act=input'>										
							<div class='col-md-6'>
								<div class='form-group'>
					                <label>Username</label>
					                <input type='text' name='username' class='form-control' placeholder='' required>
						        </div>
						        <div class='form-group'>
					                <label>Password</label>
					                <input type='text' name='password' class='form-control' placeholder='' required>
						        </div>
						        <div class='form-group'>
					                <label>Nama Lengkap</label>
					                <input type='text' name='nama_lengkap' class='form-control' placeholder='' required>
						        </div>
						    </div>
					        <div class='col-md-6'>
					        	<div class='form-group'>
					                <label>Email</label>
					                <input type='text' name='email' class='form-control' placeholder=''>
						        </div>
						        <div class='form-group'>
					                <label>No. Telepon</label>
					                <input type='text' name='no_telp' class='form-control' placeholder=''>
						        </div>
						        <div class='form-group'>
					                <label>Level Akses</label>
					                <br>
									<label class='radio-inline'>
									<input type='radio' name='level' value='admin' checked>Admin
									</label>
									<label class='radio-inline'>
									<input type='radio' name='level' value='cleaning_service'>Cleaning Service
									</label>
									<label class='radio-inline'>
									<input type='radio' name='level' value='teknisi'>Teknisi
									</label>
									<label class='radio-inline'>
									<input type='radio' name='level' value='supervisor'>Supervisor
									</label>
									<label class='radio-inline'>
									<input type='radio' name='level' value='pimpinan'>Pimpinan
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
    
  		case "edituser":
    	$edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
   		$r=mysql_fetch_array($edit);
    	if ($_SESSION[leveluser]=='admin'){
    	echo "
			<div class='content-wrapper'>
				<section class='content-header'>
					<h1>
						Hak Akses User
						<small><b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
					</h1>
					<ol class='breadcrumb'>
						<li><a href='?module=home'><i class='fa fa-dashboard'></i> Dashboard</a></li>
						<li>Manajemen Sistem</li>
						<li>Hak Akses User</li>
					</ol>  
				</section>
				<section class='content'>
				<div class='box box-default'>
					<div class='box-header with-border'>
						<h3 class='box-title'>Edit User</h3>
					</div>
					<div class='box-body'>	
						<div class='row'>											
			  				<form method=POST action=$aksi?module=user&act=update>
			  				<input type=hidden name=id value='$r[id_session]'>
			  				<div class='col-md-6'>
								<div class='form-group'>
					                <label>Username</label>
					                <input type='text' name='username' class='form-control' value='$r[username]'>
						        </div>
						        <div class='form-group'>
					                <label>Password</label>
					                <input type='text' name='password' class='form-control' placeholder=''>
						        </div>
						        <div class='form-group'>
					                <label>Nama Lengkap</label>
					                <input type='text' name='nama_lengkap' class='form-control' value='$r[nama_lengkap]'>
						        </div>
						    </div>
					        <div class='col-md-6'>
					        	<div class='form-group'>
					                <label>Email</label>
					                <input type='text' name='email' class='form-control' value='$r[email]'>
						        </div>
						        <div class='form-group'>
					                <label>No. Telepon</label>
					                <input type='text' name='no_telp' class='form-control' value='$r[no_telp]'>
						        </div>";
    							if ($r[blokir]=='Y'){
							    echo "
							    	<div class='form-group'>
						                <label>Blokir</label>
						                <br>
										<label class='radio-inline'>
										<input type='radio' name='blokir' value='Y' checked>Ya
										</label>
										<label class='radio-inline'>
										<input type='radio' name='blokir' value='N'>Tidak
										</label>
						        	</div>";
							    }
							    else{
							    echo "
							    	<div class='form-group'>
						                <label>Blokir</label>
						                <br>
										<label class='radio-inline'>
										<input type='radio' name='blokir' value='Y'>Ya
										</label>
										<label class='radio-inline'>
										<input type='radio' name='blokir' value='N' checked>Tidak
										</label>
						        	</div>";
							    }
								if ($r[level]=='cleaning_service'){
							    echo "
							    	<div class='form-group'>
						                <label>Level Akses</label>
						                <br>
										<label class='radio-inline'>
										<input type='radio' name='level' value='admin'>Admin
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='cleaning_service' checked>Cleaning Service
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='teknisi'>Teknisi
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='supervisor'>Supervisor
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='pimpinan'>Pimpinan
										</label>
						        	</div>";
							    }
							    else if ($r[level]=='teknisi'){
							    echo "
							    	<div class='form-group'>
						                <label>Level Akses</label>
						                <br>
										<label class='radio-inline'>
										<input type='radio' name='level' value='admin'>Admin
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='cleaning_service'>Cleaning Service
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='teknisi' checked>Teknisi
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='supervisor'>Supervisor
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='pimpinan'>Pimpinan
										</label>
						        	</div>";
							    } 
							    else if ($r[level]=='supervisor'){
							    echo "
							    	<div class='form-group'>
						                <label>Level Akses</label>
						                <br>
										<label class='radio-inline'>
										<input type='radio' name='level' value='admin'>Admin
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='cleaning_service'>Cleaning Service
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='teknisi'>Teknisi
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='supervisor' checked>Supervisor
										</label>
										<label class='radio-inline'>
										<input type='radio' name='level' value='pimpinan'>Pimpinan
										</label>
						        	</div>";
							    }    else if ($r[level]=='pimpinan'){
									echo "
										<div class='form-group'>
											<label>Level Akses</label>
											<br>
											<label class='radio-inline'>
											<input type='radio' name='level' value='admin'>Admin
											</label>
											<label class='radio-inline'>
											<input type='radio' name='level' value='cleaning_service'>Cleaning Service
											</label>
											<label class='radio-inline'>
											<input type='radio' name='level' value='teknisi'>Teknisi
											</label>
											<label class='radio-inline'>
											<input type='radio' name='level' value='supervisor'>Supervisor
											</label>
											<label class='radio-inline'>
											<input type='radio' name='level' value='pimpinan' checked>Pimpinan
											</label>
										</div>";
									}   
    							echo "<p></p>*) Apabila password tidak diubah, dikosongkan saja.<br/>**) Username tidak bisa diubah.
		  					</div>
		  				</div>
		  			</div>
		  			<div class='box-footer'>
						<input type=submit value=Update class='btn btn-warning'> 
						<input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
					</div>
				</div>
				</section>	
			</div>";	
	    }
    	break;  
	}
}
?>
