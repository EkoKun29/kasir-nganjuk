<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Nota Pembayaran Utang Via Cash/TF</title>
    <style>
        * {
            font-size: 8px;
            font-family: 'Times New Roman';
        }
        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }
        td.description,
        th.description {
            width: 65px;
            padding: 5px 0;
            max-width: 65px;
        }
        td.price,
        th.price {
            width: 85px;
            max-width: 95px;
            text-align: right;
            word-break: break-all;
        }
        .centered {
            text-align: center;
            align-content: center;
        }
        .ticket {
            width: 155px;
            max-width: 155px;
        }
        img {
            max-width: inherit;
            width: inherit;
        }
        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <p class="centered"><b>TOKO NGANJUK</b>
        <br>
        <b>NOTA PEMBAYARAN PIUTANG</b> 
        </p>
        <p> 
            <hr>
            <br>TANGGAL TITIPAN: <?php echo $_GET["TANGGAL"] ?>
            <br>NAMA KONSUMEN: <?php echo $_GET["NAMA_KONSUMEN"] ?> 
            <br>NO NOTA PIUTANG: <?php echo $_GET["NO_NOTA_PIUTANG"] ?>
            <br>TANGGAL NOTA PIUTANG: <?php echo $_GET["TANGGAL_NOTA_PIUTANG"] ?>
            <br>SISA PIUTANG: <?php echo rupiah($_GET["SISA_PIUTANG"])  ?>
        </p>
        <p class="centered"><b>TITIPAN</b>
        </p>
        <hr>
        <p>
            <br>TUNAI: <?php echo rupiah($_GET["TUNAI"])  ?>
            <br>TRANSFER: <?php echo rupiah($_GET["TF"])  ?>
            <br>BANK: <?php echo $_GET["BANK"] ?> 
        </p>
        <hr>
        <p class="centered"><b>** TERIMAKASIH **</b>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>