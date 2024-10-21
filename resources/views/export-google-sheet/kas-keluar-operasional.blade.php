<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kas Keluar Operasional</title>
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">TANGGAL</th>
                <th scope="col">KEPERLUAN </th>
                <th scope="col">KETERANGAN KEPERLUAN </th>
                <th scope="col">NO. NOTA </th>
                <th scope="col">NOMINAL UANG</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kasKeluarOperasional  as $p)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $p->keperluan }}</td>
                    <td>{{ $p->keterangan }}</td>
                    <td>{{ $p->no_nota }}</td>
                    <td>{{ $p->nominal }}</td>
                </tr>
            @endforeach
        </tbody>
</body>

</html>
