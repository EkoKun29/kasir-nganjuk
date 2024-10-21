<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retur Pembelian Na</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ATAS NAMA SALES </th>
                <th scope="col">YANG BAWA BARANG / UANG</th>
                <th scope="col">TGL RETUR</th>
                <th scope="col">NMR</th>
                <th scope="col">NAMA SUPPLIER</th>
                <th scope="col">NAMA BARANG DAN NO LOT</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">HARGA BELI </th>
                <th scope="col">DUS/ZAK </th>
                <th scope="col">BTL/BKS </th>
                <th scope="col">TOTAL RETUR </th>
                <th scope="col">RETUR NGURANG HUTANG</th>
                <th scope="col">RETUR MINTA CASH</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailReturPembelianNa as $p)
                <tr>
                    <td>{{ $p->returPembelianNa->atas_nama_sales }}</td>
                    <td>{{ $p->returPembelianNa->yang_bawa_barang }}</td>
                    <td>{{ $p->returPembelianNa->tgl_retur }}</td>
                    <td>{{ $p->returPembelianNa->nmr }}</td>
                    <td>{{ $p->returPembelianNa->nama_suplier }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->harga }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $p->qty }}</td>
                    <td>{{ $p->retur_ngurang_hutang }}</td>
                    <td>{{ $p->retur_minta_cash }}</td>
                </tr>
            @endforeach
        </tbody>
</body>

</html>
