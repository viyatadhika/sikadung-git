<?php
include "config/koneksi.php";

if ($_SESSION['leveluser'] == 'admin') {
	echo "
	  	<div class='user-panel'>
			<div class='pull-left image'>
		  		<img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
			</div>
			<div class='pull-left info'>
		  		<p>$_SESSION[namalengkap]</p>
		  		<a href=''><i class='fa fa-circle text-success'></i> Online</a>
			</div>
	  	</div>
	  	<ul class='sidebar-menu'>
			<li class='header'>MAIN NAVIGATION</li>
			<li>
				<a href='?module=home'>
				<i class='fa fa-dashboard'></i> 
				<span>Dashboard</span>
				</a>
			</li>
			<li class='treeview'>
				<a href='#'>
				<i class='fa fa-laptop'></i>
				<span>Manajemen Sistem</span>
				<span class='pull-right-container'>
					<i class='fa fa-angle-left pull-right'></i>
				</span>
				</a>
					<ul class='treeview-menu'>
						<li><a href='?module=user'><i class='fa fa-circle-o'></i> Hak Akses User</a></li>
						<li><a href='?module=identitas'><i class='fa fa-circle-o'></i> Identitas Instansi</a></li>
					</ul>
			</li>
			<li class='treeview'>
				<a href='#'>
				<i class='fa fa-files-o'></i>
				<span>Manajemen Data</span>
				<span class='pull-right-container'>
					<i class='fa fa-angle-left pull-right'></i>
				</span>
				</a>
					<ul class='treeview-menu'>
						<li><a href='?module=gedung'><i class='fa fa-circle-o'></i> Gedung</a></li>
				<!--  <li><a href='?module=lantai'><i class='fa fa-circle-o'></i> Lantai</a></li>
						<li><a href='?module=ruangan'><i class='fa fa-circle-o'></i> Ruangan</a></li> -->
						<li><a href='?module=jenis_kerusakan'><i class='fa fa-circle-o'></i> Jenis Kerusakan</a></li>
					</ul>
			</li>
			<li>
				<a href='?module=kerusakan'><i class='fa fa-edit'></i> <span>Form Kerusakan</span></a>
			</li>
			<li>
				<a href='?module=perbaikan'><i class='fa fa-wrench'></i> <span>Perbaikan Kerusakan</span></a>
			</li>
			<li>
				<a href='?module=monitoring'><i class='fa fa-area-chart'></i> <span>Monitoring Kerusakan</span></a>
			</li>
			<li>
				<a href='logout.php'><i class='fa fa-power-off'></i> <span>Keluar</span></a>
			</li>
	  	</ul>";
} 
else if ($_SESSION['leveluser'] == 'teknisi') {
	echo "
	  	<div class='user-panel'>
			<div class='pull-left image'>
		  		<img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
			</div>
			<div class='pull-left info'>
		  		<p>$_SESSION[namalengkap]</p>
		  		<a href=''><i class='fa fa-circle text-success'></i> Online</a>
			</div>
	  	</div>
	  	<ul class='sidebar-menu'>
			<li class='header'>MAIN NAVIGATION</li>
			<li>
				<a href='?module=home'>
				<i class='fa fa-dashboard'></i> 
				<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href='?module=kerusakan'><i class='fa fa-edit'></i> <span>Form Kerusakan</span></a>
			</li>
			<li>
				<a href='?module=perbaikan'><i class='fa fa-wrench'></i> <span>Perbaikan Kerusakan</span></a>
			</li>
			<li>
				<a href='logout.php'><i class='fa fa-power-off'></i> <span>Keluar</span></a>
			</li>
	  	</ul>";
} 
else if ($_SESSION['leveluser'] == 'supervisor') {
	echo "
	  	<div class='user-panel'>
			<div class='pull-left image'>
		  		<img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
			</div>
			<div class='pull-left info'>
		  		<p>$_SESSION[namalengkap]</p>
		  		<a href=''><i class='fa fa-circle text-success'></i> Online</a>
			</div>
	  	</div>
	  	<ul class='sidebar-menu'>
			<li class='header'>MAIN NAVIGATION</li>
			<li>
				<a href='?module=home'>
				<i class='fa fa-dashboard'></i> 
				<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href='?module=kerusakan'><i class='fa fa-edit'></i> <span>Form Kerusakan</span></a>
			</li>
			<li>
				<a href='logout.php'><i class='fa fa-power-off'></i> <span>Keluar</span></a>
			</li>
	  	</ul>";
} 
else {
	echo "
	  	<div class='user-panel'>
			<div class='pull-left image'>
		  		<img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
			</div>
			<div class='pull-left info'>
		  		<p>$_SESSION[namalengkap]</p>
		  		<a href=''><i class='fa fa-circle text-success'></i> Online</a>
			</div>
	  	</div>
	  	<ul class='sidebar-menu'>
			<li class='header'>MAIN NAVIGATION</li>
			<li>
				<a href='?module=home'>
				<i class='fa fa-dashboard'></i> 
				<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href='?module=monitoring'><i class='fa fa-area-chart'></i> <span>Monitoring Kerusakan</span></a>
			</li>
			<li>
				<a href='logout.php'><i class='fa fa-power-off'></i> <span>Keluar</span></a>
			</li>
	  	</ul>";
}
?>
