<html moznomarginboxes mozdisallowselectionprint>

<head>
    <title>
        Print Label
    </title>
    <style type="text/css">

        .content {
            width: 80mm;
            font-size: 10px;
            padding: 20px;
        }

        .content .title {
            text-align: center;
            padding-bottom: 13px
        }

        .content .separate {
            margin-top: 5px;
            margin-bottom: 5px;
            border-top: 1px dashed #000;
        }

        .content .transaction-table {
            width: 100%;
            font-size: 10px;
        }

        .content .transaction-table .text-right {
            text-align: right;
        }

        .content .transaction-table .text-center {
            text-align: center;
        }


        .content .transaction-table tr td {
            vertical-align: top;
        }

        .content .transaction-table .table-tr td {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .content .transaction-table .border-line {
            height: 1px;
            border-top: 1px dashed #000;
        }

        .content .closing {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <table class="transaction-table" cellspacing="0" cellpadding="0">
            <tr>
                <td>
                    <div style="margin-right: 10px" id="qrcode"></div>
                </td>
                <td>
                    <div style="font-size: 26px; margin-right: -80px;">
                        <b>
                            <p>{{ $label->nama_barang }}</p> <br>
                            Harga: @money($label->harga )<br>
                            <div style="font-size: 20px;">
                                {{ $label->tanggal }}
                            </div>
                        </b>
                    </div>
                </td>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"
    integrity="sha512-NFUcDlm4V+a2sjPX7gREIXgCSFja9cHtKPOL1zj6QhnE0vcY695MODehqkaGYTLyL2wxe/wtr4Z49SvqXq12UQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    jQuery('#qrcode').qrcode({
        width: 200,
        height: 200,
        text: "dada"
    });
</script>
<script type="text/javascript">
    this.print();
</script>
</html>
