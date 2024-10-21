<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran Piutang Cash</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ATAS NAMA SALES</th>
                <th scope="col">YANG BAWA BARANG / UANG</th>
                <th scope="col">TGL</th>
                <th scope="col">NO NOTA PELUNASAN</th>
                <th scope="col">TRANSAKSI PIUTANG</th>
                <th scope="col">PELUNASAN & TITIPAN CASH</th>
                <th scope="col">PELUNASAN & TITIPAN TF</th>
                <th scope="col">NAMA BANK</th>
                <th scope="col">POTONGAN HARGA</th>
                <th scope="col">BARTER</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembayaranPiutangCash as $p)
                <tr>
                    <th>{{ $p->toko }}</th>
                    <th>{{ $p->toko }}</th>
                    <th>{{ $p->tgl_bayar }}</th>
                    <th>{{ $p->id }}</th>
                    <th>{{ $p->nama_konsumen }} {{ \Carbon\Carbon::parse($p->tgl_nota_piutang)->format('dmy') }} NO {{ $p->no_nota_piutang }}</th>
                    <th>{{ $p->tunai }}</th>
                    <th>{{ $p->tf }}</th>
                    <th>{{ $p->bank }}</th>
                    <th></th>
                    <th></th>
                </tr>
            @endforeach
        </tbody>
</body>

</html>
