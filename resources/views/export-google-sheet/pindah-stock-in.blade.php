<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pindah Stock In</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ATAS NAMA SALES</th>
                <th scope="col">YANG BAWA BARANG / UANG</th>
                <th scope="col">TANGGAL</th>
                <th scope="col">NMR</th>
                <th scope="col">DAPAT BARANG DARI</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">NO LOT</th>
                <th scope="col">NAMA BARANG & NO LOT</th>
                <th scope="col">DUZ</th>
                <th scope="col">BTL</th>
                <th scope="col">TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pindahStockIn as $p)
                <tr>
                    <td>{{ $p->atas_nama_sales }}</td>
                    <td>{{ $p->yang_bawa_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $p->nmr }}</td>
                    <td>{{ $p->barang_dari }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->no_lot }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $p->qty }}</td>
                </tr>
            @endforeach
        </tbody>
</body>

</html>
