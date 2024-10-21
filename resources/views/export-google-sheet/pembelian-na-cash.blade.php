<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembelian NA</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ATAS NAMA SALES </th>
                <th scope="col">YANG BAWA BARANG / UANG</th>
                <th scope="col">TGL</th>
                <th scope="col">NOMER NOTA</th>
                <th scope="col">NAMA SUPPLIER</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">NAMA BARANG + NO LOT</th>
                <th scope="col">HARGA</th>
                <th scope="col">DUZ</th>
                <th scope="col">BTL/BKS</th>
                <th scope="col">TOTAL QTY PEMBELIAN</th>
                <th scope="col"></th>
                <th scope="col">TUNAI</th>
                <th scope="col">HUTANG</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelianNaCash as $p)
                <tr>
                    <td>{{ $p->atas_nama_sales }}</td>
                    <td>{{ $p->yang_bawa_barang }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->no_nota }}</td>
                    <td>{{ $p->nama_suplier }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>{{ round($p->cash / $p->qty) }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $p->qty }}</td>
                    <td></td>
                    <td>{{ $p->cash }}</td>
                    <td></td>
                </tr>
            @endforeach
            @foreach ($pembelianNaHutang as $p)
                <tr>
                    <td>{{ $p->atas_nama_sales }}</td>
                    <td>{{ $p->yang_bawa_barang }}</td>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->no_nota }}</td>
                    <td>{{ $p->nama_suplier }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>{{ round($p->hutang / $p->qty) }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $p->qty }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $p->hutang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
