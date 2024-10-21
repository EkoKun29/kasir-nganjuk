<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjualan</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ATAS NAMA SALES</th>
                <th scope="col">YANG BAWA BARANG</th>
                <th scope="col">TGL</th>
                <th scope="col">NO NOTA</th>
                <th scope="col">NO NOTA GUDANG</th>
                <th scope="col">NAMA KONSUMEN</th>
                <th scope="col">NAMA BARANG DAN NO LOT</th>
                <th scope="col">NAMA BARANG</th>
                <th scope="col">HARGA JUAL</th>
                <th scope="col">DUZ</th>
                <th scope="col">BTL</th>
                <th scope="col">TOTAL QTY</th>
                <th scope="col">PENJUALAN</th>
                <th scope="col">CASH</th>
                <th scope="col">TF</th>
                <th scope="col">NAMA BANK</th>
                <th scope="col">POTONGAN CASH</th>
                <th scope="col">PIUTANG</th>
                <th scope="col">POTONGAN PIUTANG</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detailPenjualanCash as $p)
                <tr>
                    <td>TOKO NGANJUK</td>
                    <td>TOKO NGANJUK</td>
                    <th>{{ $p->tanggal }}</th>
                    <th>{{ $p->penjualanCash->id }}</th>
                    <th></th>
                    <td>{{ $p->penjualanCash->nama_konsumen }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>
                        @php
                            $value = $p->nama_barang_dan_no_lot;
                            $parts = explode(' // ', $value);
                        @endphp
                        {{ $parts[0] }}
                    </td>
                    <td>{{ $p->harga }}</td>
                    <td> </td>
                    <td> </td>
                    <td>{{ $p->qty }}</td>
                    <td> </td>
                    <td>{{ $p->sub_total }}</td>
                    <td> </td>
                    <td> </td>
                    <td>{{ $p->diskon }}</td>
                    <td> </td>
                    <td> </td>
                </tr>
            @endforeach
            @foreach ($detailPenjualanTf as $p)
                <tr>
                    <td>TOKO NGANJUK</td>
                    <td>TOKO NGANJUK</td>
                    <th>{{ $p->penjualanTf->tanggal }}</th>
                    <th>{{ $p->penjualanTf->id }}</th>
                    <th></th>
                    <td>{{ $p->penjualanTf->nama_konsumen }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>
                        @php
                            $value = $p->nama_barang_dan_no_lot;
                            $parts = explode(' // ', $value);
                        @endphp
                        {{ $parts[0] }}
                    </td>
                    <td>{{ $p->harga }}</td>
                    <td> </td>
                    <td> </td>
                    <td>{{ $p->qty }}</td>
                    <td> </td>
                    <td> </td>
                    <td>{{ $p->sub_total }}</td>
                    <td>{{ $p->penjualanTf->bank }}</td>
                    <td>{{ $p->diskon }}</td>
                    <td> </td>
                    <td> </td>
                </tr>
            @endforeach
            @foreach ($detailPenjualanPiutang as $p)
                <tr>
                    <td>TOKO NGANJUK</td>
                    <td>TOKO NGANJUK</td>
                    <th>{{ $p->tanggal }}</th>
                    <th>{{ $p->penjualanPiutang->no_nota }}</th>
                    <th></th>
                    <td>{{ $p->penjualanPiutang->nama_konsumen }}</td>
                    <td>{{ $p->nama_barang_dan_no_lot }}</td>
                    <td>
                        @php
                            $value = $p->nama_barang_dan_no_lot;
                            $parts = explode(' // ', $value);
                        @endphp
                        {{ $parts[0] }}
                    </td>
                    <td>{{ $p->harga }}</td>
                    <td> </td>
                    <td> </td>
                    <td>{{ $p->qty }}</td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td>{{ $p->sub_total }}</td>
                    <td>{{ $p->diskon }}</td>
                </tr>
            @endforeach
        </tbody>
</body>

</html>
