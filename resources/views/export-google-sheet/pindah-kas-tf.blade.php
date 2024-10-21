<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pindah Kas Tf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">TANGGAL TRANSFER</th>
                <th scope="col">SALES</th>
                <th scope="col">NO. NOTA </th>
                <th scope="col">NOMINAL</th>
                <th scope="col">BANK</th>
                <th scope="col">KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pindahKasTf as $p)
                <tr>
                    <td>{{ $p->tanggal }}</td>
                    <td>{{ $p->sales }}</td>
                    <td>{{ $p->no_nota }}</td>
                    <td>{{ $p->nominal }}</td>
                    <td>{{ $p->bank }}</td>
                    <td>{{ $p->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
</body>

</html>
