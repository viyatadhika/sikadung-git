<?php
session_start();

function home_base_url(){   
		// first get http protocol if http or https
		$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
		// get default website root directory
		$tmpURL = dirname(__FILE__);
		// when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",
		//convert value to http url use string replace, 
		// replace any backslashes to slash in this case use chr value "92"
		$tmpURL = str_replace(chr(92),'/',$tmpURL);
		// now replace any same string in $tmpURL value to null or ''
		// and will return value like /localhost/my_website/ or just /my_website/
		$tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
		// delete any slash character in first and last of value
		$tmpURL = ltrim($tmpURL,'/');
		$tmpURL = rtrim($tmpURL, '/');
		// check again if we find any slash string in value then we can assume its local machine
		if (strpos($tmpURL,'/')){
			// explode that value and take only first value
			$tmpURL = explode('/',$tmpURL);
			$tmpURL = $tmpURL[0];
		}
		// now last steps
		// assign protocol in first value
		if ($tmpURL !== $_SERVER['HTTP_HOST'])
		// if protocol its http then like this
		  $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL;
		else
		// else if protocol is https
		  $base_url .= $tmpURL;
		// give return value
		return $base_url; 
	}
  $website_url = home_base_url();
  error_reporting(0);

include "timeout.php";
include "config/koneksi.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}

if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
  if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
    echo "
      <link href='style.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br> <a href=index.php><b>LOGIN</b></a></center>";
  }
  else{
    echo "
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sistem Informasi Kerusakan Gedung</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel='stylesheet' href='bootstrap/css/bootstrap.min.css'>
    <link rel='stylesheet' href='plugins/datepicker/datepicker3.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='plugins/datatables/dataTables.bootstrap.css'>
    <link rel='stylesheet' href='css/AdminLTE.min.css'>
    <link rel='stylesheet' href='css/skins/_all-skins.min.css'>
    <link rel='stylesheet' href='css/animate.css'>
    <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    </head>
    <body class='hold-transition skin-black-light sidebar-mini'>
    <div id='main-wrapper'>
      <div class='wrapper'>
      <header class='main-header'>
        <a href='' class='logo'>
          <span class='logo-mini'>KG</span>
          <span class='logo-lg  bounceIn animated'>SIKADUNG</span>
        </a>
      <nav class='navbar navbar-static-top'>
        <a href='#' class='sidebar-toggle' data-toggle='offcanvas' role='button'>
          <span class='sr-only'>Toggle navigation</span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
        </a>
        <div class='navbar-custom-menu'>";
  		  if ($_SESSION['leveluser']=='admin'){	
  			echo "
          <ul class='nav navbar-nav'>         
            <li class='dropdown user user-menu'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                <img src='images/Mahkamah Agung.png' class='user-image' alt='User Image'>
                <span class='hidden-xs'>Administrator</span>
              </a>
              <ul class='dropdown-menu'>
                <li class='user-header'>
                  <img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
                  <p>Administrator</p>
                </li>
                <li class='user-footer'>
                  <div class='pull-left'>
                    <a href='?module=identitas' class='btn btn-default btn-flat'>Identitas Instansi</a>
                  </div>
                  <div class='pull-right'>
                    <a href='?module=user' class='btn btn-default btn-flat'>Hak Akses User</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>";
        }
  		  elseif ($_SESSION['leveluser']=='pimpinan'){	
  			echo "
          <ul class='nav navbar-nav'>         
            <li class='dropdown user user-menu'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                <img src='images/Mahkamah Agung.png' class='user-image' alt='User Image'>
                <span class='hidden-xs'>Pimpinan</span>
              </a>
              <ul class='dropdown-menu'>
                <li class='user-header'>
                  <img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
                  <p>$_SESSION[namalengkap]
                  <small>Pimpinan <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
                  </p>
                </li> 
              </ul>
            </li>
          </ul>";
        }
        elseif ($_SESSION['leveluser']=='teknisi'){  
        echo "
          <ul class='nav navbar-nav'>         
            <li class='dropdown user user-menu'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                <img src='images/Mahkamah Agung.png' class='user-image' alt='User Image'>
                <span class='hidden-xs'>Teknisi</span>
              </a>
              <ul class='dropdown-menu'>
                <li class='user-header'>
                  <img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
                  <p>$_SESSION[namalengkap]
                  <small>Teknisi <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
                  </p>
                </li>                
              </ul>
            </li>
          </ul>";
        }
        elseif ($_SESSION['leveluser']=='supervisor'){  
        echo "
          <ul class='nav navbar-nav'>         
            <li class='dropdown user user-menu'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                <img src='images/Mahkamah Agung.png' class='user-image' alt='User Image'>
                <span class='hidden-xs'>Supervisor</span>
              </a>
              <ul class='dropdown-menu'>
                <li class='user-header'>
                  <img src='images/Mahkamah Agung.png' class='img-circle' alt='User Image'>
                  <p>$_SESSION[namalengkap]
                  <small>Supervisor <b>S</b>istem <b>I</b>nformasi <b>K</b>erus<b>A</b>kan ge<b>DUNG</b></small>
                  </p>
                </li>
              </ul>
            </li>
          </ul>";
        }
        echo "
        </div>
      </nav>
    </header>";
  	echo "
    <aside class='main-sidebar'>
    	<section class='sidebar'>";
      ?>
        <?php include "menu.php"; ?>
    <?php 
    echo "
      </section>
  	</aside>"; 
    ?>
    <?php include "content.php"; ?>
    <?php include "buttom.php"; ?>
  <?php 

  $gedung = mysql_query("SELECT k.id_gedung, g.nama_gedung, COUNT(k.id_gedung) AS jumlah_kerusakan
                          FROM kerusakan k
                          INNER JOIN gedung g ON k.id_gedung = g.id_gedung 
                          GROUP BY id_gedung");
  while ($r=mysql_fetch_array($gedung)){
    $ged=$r['nama_gedung'];
    $nama_ged .= "'$ged'". ", ";
    //Mengambil nilai total dari database
    $jum=$r['jumlah_kerusakan'];
    $jumlah .= "$jum". ", ";
  }
  $jenis_kerusakan = mysql_query("SELECT k.id_jenis_kerusakan, jk.nama_kerusakan, COUNT(k.id_jenis_kerusakan) AS jumlah_kerusakan_jenis
                      FROM kerusakan k
                      INNER JOIN jenis_kerusakan jk ON k.id_jenis_kerusakan = jk.id_jenis_kerusakan 
                      GROUP BY id_jenis_kerusakan");
  while ($r=mysql_fetch_array($jenis_kerusakan)){
    $jen_ker=$r['nama_kerusakan'];
    $nama_ker .= "'$jen_ker'". ", ";
    //Mengambil nilai total dari database
    $jum_ker=$r['jumlah_kerusakan_jenis'];
    $jumlah_ker .= "$jum_ker". ", ";
  }
 
    echo "  
      <div class='control-sidebar-bg'></div>
  </div>
  </body>

  <div class='modal fade' id='logout' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel'>Logout</h4>
      </div>
      <div class='modal-body'>
        <p>Apakah Anda Yakin Ingin Logout? </p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Kembali</button>
        <a type='button' class='btn btn-danger' href='logout.php'>Ya, Logout</a>
      </div>
    </div>
  </div>
</div>
  

  <script src='plugins/jQuery/jquery-2.2.3.min.js'></script>
  <script src='jquery.mask.min.js'></script>
  <script src='terbilang.js'></script>
  <script src='bootstrap/js/bootstrap.min.js'></script>
  <script src='plugins/datepicker/bootstrap-datepicker.js'></script>
  <script src='plugins/datatables/jquery.dataTables.min.js'></script>
  <script src='plugins/datatable/js/jquery.dataTables.min.js'></script>
	<script src='plugins/datatable/js/dataTables.bootstrap5.min.js'></script>
  <script src='plugins/datatables/dataTables.bootstrap.min.js'></script>
  <script src='plugins/slimScroll/jquery.slimscroll.min.js'></script>
  <script src='plugins/fastclick/fastclick.js'></script>
  <script src='js/app.min.js'></script>
  <script src='js/demo.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js'></script>
  <script>
    $(function () {
      $('#example').DataTable();
      $('#example1').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true        
      });
    });
  </script>
  <script>
  $(function () {
    $('#example').DataTable();
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true        
    });
  });
</script>
  <script>
    $(function () {
  	$('#example').DataTable();
      $('#example3').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'scrollX': true
      });
    });
  </script>
  <script>
    $(function () {
  	$('#example').DataTable();
      $('#example4').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'scrollX': true
      });
    });
  </script>
  <script>
    $(function () {
  	$('#example').DataTable();
      $('#example5').DataTable({
        'paging': true,
        'lengthChange': false,
        'buttons': [ 'copy', 'excel', 'pdf', 'print'],
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'scrollX': true
      });
    });
  </script>
  <script type='text/javascript'>
   $(function(){
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker1').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker2').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
   });
  </script>
  <script type='text/javascript'>
    function inputTerbilang() {
      //membuat inputan otomatis jadi mata uang
      $('.mata-uang').mask('0.000.000.000', {reverse: true});

      //mengambil data uang yang akan dirubah jadi terbilang
       var input = document.getElementById('terbilang-input').value.replace(/\./g, '');

       //menampilkan hasil dari terbilang
       document.getElementById('terbilang-output').value = terbilang(input).replace(/  +/g, ' ');
       document.getElementById('terbilang-output1').value = terbilang(input).replace(/  +/g, ' ');
    } 

    function inputTerbilangTermin() {
      //membuat inputan otomatis jadi mata uang
      $('.mata-uang').mask('0.000.000.000', {reverse: true});

      //mengambil data uang yang akan dirubah jadi terbilang
       var input = document.getElementById('terbilang-input-termin').value.replace(/\./g, '');

       //menampilkan hasil dari terbilang
       document.getElementById('terbilang-output-termin').value = terbilang(input).replace(/  +/g, ' ');
       document.getElementById('terbilang-output1-termin').value = terbilang(input).replace(/  +/g, ' ');
    } 
  </script>
  <script>
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: [$nama_ged],
				datasets: [{
					label: 'Total Kerusakan Per Gedung',
					data: [$jumlah],
					backgroundColor: [
            'rgb(0, 255, 254)',
            'rgb(210, 145, 188)',
            'rgb(254, 200, 216)',
            'rgb(255, 223, 211)',
            'rgb(253, 207, 179)',
            'rgb(206, 200, 228)',
            'rgb(249, 247, 232)',
            'rgb(190, 215, 209)',
            'rgb(247, 235, 195)',
            'rgb(251, 214, 198)',
            'rgb(248, 225, 231)',
            'rgb(248, 209, 224)',
            'rgb(254, 203, 165)'
            ],
          borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
      options: {
        legend: {
          display: true,
          position: 'right'
        }
      }
		});
	</script>
  <script>
		var ctx = document.getElementById('myChart1').getContext('2d');
		var myChart1 = new Chart(ctx, {
			type: 'horizontalBar',
			data: {
				labels: [$nama_ker],
				datasets: [{
					label: 'Jenis Kerusakan',
					data: [$jumlah_ker],
          backgroundColor: 'rgb(217,83,79)',
					borderWidth: 1
				}]
			},
      options: {
        legend: {
          display: false,
        },
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
  </body>
  </html>";
  ?>
<?php 
  }
}
?>