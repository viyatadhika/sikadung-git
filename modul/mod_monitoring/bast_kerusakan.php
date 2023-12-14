
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>BAST Kerusakan</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css'>
<style>
    @page { size: A4 }
  
    h1 {
        font-weight: bold;
        font-size: 20pt;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 13px;
    }

    table.kop{
        text-align: center;
        width: 100%;
    }

    th.kop {
        text-align: center;
        font-size: 16px;
    }

    td.kop {
        text-align: center;
        font-size: 14px;
    }

    table.garis{
        text-align: center;
        width: 100%;
    }

    th.garis {
        text-align: center;
        font-size: 16px;
    }

    td.garis {
        text-align: center;
        font-size: 14px;
    }
  
    .table th {
        padding: 8px 8px;
        border:1px solid #000000;
        text-align: center;
    }
  
    .table td {
        padding: 3px 3px;
        border:1px solid #000000;
    }
  
    p{
        text-align: justify;
        font-size: 13px;
    }
    .nomor{
    text-align: center;
    }
</style>
</head>
<body class='A4'>
    <section class='sheet padding-10mm'>
    	<?php include "cetak_bast_kerusakan.php"; ?>
    </section>
</body>
</html>
 
    