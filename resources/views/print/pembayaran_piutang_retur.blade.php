<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Nota Pembayaran Utang Via Retur</title>
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
            <br>NO: {{ $new_data->id }}
            <br>TANGGAL TITIPAN: {{ $new_data->created_at }}
            <br>NAMA KONSUMEN: {{ $new_data->nama_konsumen }}
            <br>NO NOTA PIUTANG: {{ $new_data->no_nota_piutang }}
            <br>TANGGAL NOTA PIUTANG: {{ $new_data->tgl_nota_piutang }}
        </p>
        <table>
            <thead>
                <tr>
                    <th class="description">BARANG</th>
                    <th class="description">HARGA</th>
                    <th class="description">QTY</th>
                    <th class="description">SUB TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $item)
                    <tr>
                        <td class="description">{{ $item->nama_barang }}</td>
                        <td class="description">{{ $item->harga }}</td>
                        <td class="description">{{ $item->qty }}</td>
                        <td class="description">{{ $item->sub_total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <p class="centered"><b>** TERIMAKASIH **</b>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
