<?php
// class paging untuk halaman administrator
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "

<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1' ><< Awal</a>
	
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev' >< Sebelumnya</a> 
";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

// class paging untuk halaman administrator (pencarian berita)
class Paging9{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "
	
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=1&kata=$_GET[kata]' class='nextprev'><< Awal</a>
	
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$prev&kata=$_GET[kata]' class='nextprev'>< Sebelumnya</a> ";

}
else{ 
	$link_halaman .= "
	
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;'><< Awal</a>
	
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;'>< Sebelumnya</a> ";

}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&kata=$_GET[kata]>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i&kata=$_GET[kata]>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman&kata=$_GET[kata]>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$next&kata=$_GET[kata]>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$jmlhalaman&kata=$_GET[kata]>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

// class paging untuk halaman berita (menampilkan semua berita) FIX NEW LINK !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
class Paging2{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halberita'])){
$posisi=0;
$_GET['halberita']=1;
}
else{
$posisi = ($_GET['halberita']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
$prev = $halaman_aktif-1;
$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=news-1 class='nextprev'><< Awal</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=news-$prev class='nextprev'>< Sebelumnya</a>";
}
else{
$link_halaman .= "<span class='nextprev'>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'><< Awal</a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>< Sebelumnya</a>
";
}

// Link halaman 1,2,3, …
$angka = ($halaman_aktif > 3 ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>" : " ");
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
if ($i < 1)
continue;
$angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=news-$i>$i</a>  ";
}
$angka .= " <span class='current'><b>
<a style='color:#ffac4a; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' >$halaman_aktif</a></b></span>";

for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
if($i > $jmlhalaman)
break;
$angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=news-$i>$i</a>  ";
}
$angka .= ($halaman_aktif+2<$jmlhalaman ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='news-$jmlhalaman' class='nextprev'>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last)
if($halaman_aktif < $jmlhalaman){
$next = $halaman_aktif+1;
$link_halaman .= " 
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=news-$next class='nextprev'>Selanjutnya ></a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=news-$jmlhalaman class='nextprev'>Akhir >></a> ";
}
else{
$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Selanjutnya ></a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Akhir >></a>";
}
return $link_halaman;
}
}

// class paging untuk halaman kategori (menampilkan berita per kategori)
class Paging3{
function cariPosisi($batas){
if(empty($_GET['halkategori'])){
	$posisi=0;
	$_GET['halkategori']=1;
}
else{
	$posisi = ($_GET['halkategori']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halkategori-$_GET[id]-1.html><< First</a> | 
                    <a href=halkategori-$_GET[id]-$prev.html>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halkategori-$_GET[id]-$i.html>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halkategori-$_GET[id]-$i.html>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=halkategori-$_GET[id]-$jmlhalaman.html>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halkategori-$_GET[id]-$next.html>Next ></a> | 
                     <a href=halkategori-$_GET[id]-$jmlhalaman.html>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

// class paging untuk halaman agenda (menampilkan semua agenda) FIX NEW LINK !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
class Paging4{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halagenda'])){
	$posisi=0;
	$_GET['halagenda']=1;
}
else{
	$posisi = ($_GET['halagenda']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-1.html' class='nextprev'><< Awal</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-$prev.html' class='nextprev'>< Sebelumnya</a>";
}
else{ 
	$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'><< Awal</a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>< Sebelumnya</a>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-$i.html'>$i</a>  ";
  }
	  $angka .= "
<span class='current'><b>
<a style='color:#ffac4a; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' >$halaman_aktif</a></b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-$i.html'>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-$jmlhalaman.html' class='nextprev'>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-$next.html' class='nextprev'>Selanjutnya ></a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='agenda-$jmlhalaman.html'l class='nextprev'>Akhir >></a> ";
}
else{
	$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Selanjutnya ></a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Akhir >></a>";
}
return $link_halaman;
}
}

// class paging untuk halaman download (menampilkan semua download) 
class Paging5{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['haldownload'])){
	$posisi=0;
	$_GET['haldownload']=1;
}
else{
	$posisi = ($_GET['haldownload']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=download-1><< Awal</a> | 
                    <a href=download-$prev>< Sebelumnya</a> | ";
}
else{ 
	$link_halaman .= "<< Awal | < Sebelumnya | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=download-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=download-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=download-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=download-$next>Selanjutnya ></a> | 
                     <a href=download-$jmlhalaman>Akhir >></a> ";
}
else{
	$link_halaman .= " Selanjutnya > | Akhir >>";
}
return $link_halaman;
}
}

// class paging untuk halaman galeri foto
class Paging6{
function cariPosisi($batas){
if(empty($_GET['halgaleri'])){
	$posisi=0;
	$_GET['halgaleri']=1;
}
else{
	$posisi = ($_GET['halgaleri']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halgaleri-$_GET[id]-1><< First</a> | 
                    <a href=halgaleri-$_GET[id]-$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halgaleri-$_GET[id]-$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halgaleri-$_GET[id]-$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=halgaleri-$_GET[id]-$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halgaleri-$_GET[id]-$next>Next ></a> | 
                     <a href=halgaleri-$_GET[id]-$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

// class paging untuk halaman komentar
class Paging7{
function cariPosisi($batas){
if(empty($_GET['halkomentar'])){
	$posisi=0;
	$_GET['halkomentar']=1;
}
else{
	$posisi = ($_GET['halkomentar']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=halkomentar-$_GET[id]-1.html><< First</a> | 
                    <a href=halkomentar-$_GET[id]-$prev.html>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=halkomentar-$_GET[id]-$i.html>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=halkomentar-$_GET[id]-$i.html>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=halkomentar-$_GET[id]-$jmlhalaman.html>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=halkomentar-$_GET[id]-$next.html>Next ></a> | 
                     <a href=halkomentar-$_GET[id]-$jmlhalaman.html>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ HALAMAN MODUL BUATAN SENDIRI ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~//

// class paging untuk halaman prestasi (menampilkan semua prestasi)
class Paging11{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halprestasi'])){
$posisi=0;
$_GET['halprestasi']=1;
}
else{
$posisi = ($_GET['halprestasi']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
$prev = $halaman_aktif-1;
$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=halprestasi-1.html class='nextprev'><< Awal</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=halprestasi-$prev.html class='nextprev'>< Sebelumnya</a>";
}
else{
$link_halaman .= "<span class='nextprev'>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'><< Awal</a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>< Sebelumnya</a>
";
}

// Link halaman 1,2,3, …
$angka = ($halaman_aktif > 3 ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>" : " ");
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
if ($i < 1)
continue;
$angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=halprestasi-$i.html>$i</a>  ";
}
$angka .= " <span class='current'><b>
<a style='color:#ffac4a; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' >$halaman_aktif</a></b></span>";

for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
if($i > $jmlhalaman)
break;
$angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=halprestasi-$i.html>$i</a>  ";
}
$angka .= ($halaman_aktif+2<$jmlhalaman ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halprestasi-$jmlhalaman.html' class='nextprev'>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last)
if($halaman_aktif < $jmlhalaman){
$next = $halaman_aktif+1;
$link_halaman .= " 
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=halprestasi-$next.html class='nextprev'>Selanjutnya ></a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href=halprestasi-$jmlhalaman.html class='nextprev'>Akhir >></a> ";
}
else{
$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Selanjutnya ></a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Akhir >></a>";
}
return $link_halaman;
}
}

// class paging untuk halaman karir (menampilkan semua karir) 
class Paging12{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halkarir'])){
	$posisi=0;
	$_GET['halkarir']=1;
}
else{
	$posisi = ($_GET['halkarir']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-1.html' class='nextprev'><< Awal</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-$prev.html' class='nextprev'>< Sebelumnya</a>";
}
else{ 
	$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'><< Awal</a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>< Sebelumnya</a>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-$i.html'>$i</a>  ";
  }
	  $angka .= "
<span class='current'><b>
<a style='color:#ffac4a; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' >$halaman_aktif</a></b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-$i.html'>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-$jmlhalaman.html' class='nextprev'>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-$next.html' class='nextprev'>Selanjutnya ></a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halkarir-$jmlhalaman.html'l class='nextprev'>Akhir >></a> ";
}
else{
	$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Selanjutnya ></a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Akhir >></a>";
}
return $link_halaman;
}
}

// class paging untuk halaman beasiswa (menampilkan semua beasiswa) 
class Paging13{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halbeasiswa'])){
	$posisi=0;
	$_GET['halbeasiswa']=1;
}
else{
	$posisi = ($_GET['halbeasiswa']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-1.html' class='nextprev'><< Awal</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-$prev.html' class='nextprev'>< Sebelumnya</a>";
}
else{ 
	$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'><< Awal</a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>< Sebelumnya</a>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-$i.html'>$i</a>  ";
  }
	  $angka .= "
<span class='current'><b>
<a style='color:#ffac4a; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' >$halaman_aktif</a></b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-$i.html'>$i</a>  ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>...</a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-$jmlhalaman.html' class='nextprev'>$jmlhalaman</a> " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= "
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-$next.html' class='nextprev'>Selanjutnya ></a>
<a onMouseOver=this.style.color='#ffac4a' onMouseOut=this.style.color='#c2bebe' style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' href='halbeasiswa-$jmlhalaman.html'l class='nextprev'>Akhir >></a> ";
}
else{
	$link_halaman .= "
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Selanjutnya ></a>
<a style='color:#c2bebe; font-weight: bold; margin: 4px 0; font-size:12px; text-decoration:none; font-family: 'Open Sans',Arial,Helvetica,sans-serif;' class='nextprev'>Akhir >></a>";
}
return $link_halaman;
}
}

// class paging untuk Manajemen Bahasa (MIMIN) 
class Paging14{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=1><< First</a> | 
                    <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=$prev>< Prev</a> | ";
}
else{ 
	$link_halaman .= "<< First | < Prev | ";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? " ... " : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=$i>$i</a> | ";
  }
	  $angka .= " <b>$halaman_aktif</b> | ";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=$i>$i</a> | ";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " ... | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=$jmlhalaman>$jmlhalaman</a> | " : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=$next>Next ></a> | 
                     <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=editbahasa&kode_bhs=$_GET[kode_bhs]&halaman=$jmlhalaman>Last >></a> ";
}
else{
	$link_halaman .= " Next > | Last >>";
}
return $link_halaman;
}
}

?>
