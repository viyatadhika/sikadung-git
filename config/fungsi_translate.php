<?php
function trans($dari){
if(isset($_COOKIE['lokolangs'])){
$qr = mysql_query("SELECT * FROM translate WHERE dari='$dari' AND kode_bhs='$_COOKIE[lokolangs]'");
if(mysql_num_rows($qr)>0){
$bhs = mysql_fetch_array($qr);
$arti = $bhs['ke'];
} else {
$qrbhs = mysql_query("SELECT * FROM bahasa");
while($r=mysql_fetch_array($qrbhs)){
mysql_query("INSERT INTO translate SET dari='$dari', ke='$dari', kode_bhs='$r[kode_bhs]'");
} 
$arti = $dari;
}
} else {
$arti = $dari;
}
return $arti;
}
?>