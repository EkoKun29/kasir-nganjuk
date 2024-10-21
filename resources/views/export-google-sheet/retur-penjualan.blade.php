<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Retur Penjualan</title>
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ATAS NAMA SALES </th>
                <th scope="col">YANG BAWA BARANG / UANG</th>
                <th scope="col">TGL RETUR</th>
                <th scope="col">NMR</th>
                <th scope="col">TGL SAAT PENJUALAN</th>
                <th scope="col">NAMA KONSUMEN</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">NO LOT</th>
                <th scope="col">NAMA BARANG DAN NO LOT </th>
                <th scope="col">HARGA JUAL</th>
                <th scope="col">HPP</th>
                <th scope="col">DUS/ZAK</th>
                <th scope="col">BTL/BKS</th>
                <th scope="col">TOTAL RETUR</th>
                <th scope="col">RETUR NGURANG PIUTANG</th>
                <th scope="col">RETUR MINTA CASH</th>
                <th scope="col">TOTAL HARGA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailReturPenjualan as $p)
                <tr>
                    <td>TOKO NGANJUK</td>
                    <td>TOKO NGANJUK</td>
                    <td>{{ $p->returPenjualan->tanggal }}</td>
                    <td>{{ $p->returPenjualan->no_nota_piutang }}</td>
                    <td>{{ $p->returPenjualan->tgl_nota_piutang }}</td>
                    <td>{{ $p->returPenjualan->nama_konsumen }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->no_lot }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ $p->hpp }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $p->qty}}</td>
                    <td>
                        @if ($p->returPenjualan->sisa_piutang != 0)
                            {{ $p->sub_total }}
                            
                        @endif
                    </td>
                    <td>
                        @if ($p->returPenjualan->uang_keluar != 0)
                            {{ $p->sub_total }}
                        @endif
                    </td>
                    <td>{{ $p->sub_total}}</td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>
