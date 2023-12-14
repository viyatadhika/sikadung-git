<?php
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 1;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "viyatadhika@gmail.com";
$mail->Password = "pusdiklat01";
$mail->setFrom('viyatadhika@gmail.com', 'viyatadhika');
$mail->addAddress('pendek.kecil.item@gmail.com', 'aguspermana');
$mail->Subject = "coba kirim email";
$mail->msgHTML('<h1>Testing kirim email</h1><p>Pesan dengan format HTML</p>
    <table><tr><td>Penggunaan tabel</td></tr></table>');
if (!$mail->send()) {
    echo "Email gagal dikirim";
} else {
    echo "Email terkirim";
}
?>