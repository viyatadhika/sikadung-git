<?php
	session_start();
	session_destroy();
	/*if ($_SESSION['leveluser']=='admin'){
		echo "<script>alert('Anda Telah Keluar dari Halaman Administrator'); window.location = 'https://pusdiklatit.000webhostapp.com'</script>";
	}
	else if ($_SESSION['leveluser']=='teknisi'){
		echo "<script>alert('Anda Telah Keluar dari Halaman Teknisi'); window.location = 'https://pusdiklatit.000webhostapp.com'</script>";
	}
	else if ($_SESSION['leveluser']=='supervisor'){
		echo "<script>alert('Anda Telah Keluar dari Halaman Supervisor'); window.location = 'https://pusdiklatit.000webhostapp.com'</script>";
	}else {
		echo "<script>alert('Anda Telah Keluar dari Halaman Pimpinan'); window.location = 'https://pusdiklatit.000webhostapp.com'</script>";
	}*/

	if ($_SESSION['leveluser']=='admin'){
		echo "<script>alert('Anda Telah Keluar dari Halaman Administrator'); window.location = '/sikadung'</script>";
	}
	else if ($_SESSION['leveluser']=='teknisi'){
		echo "<script>alert('Anda Telah Keluar dari Halaman Teknisi'); window.location = '/sikadung'</script>";
	}
	else if ($_SESSION['leveluser']=='supervisor'){
		echo "<script>alert('Anda Telah Keluar dari Halaman Supervisor'); window.location = '/sikadung'</script>";
	}else {
		echo "<script>alert('Anda Telah Keluar dari Halaman Pimpinan'); window.location = '/sikadung'</script>";
	}
?>
 
