@extends('layouts.app')
@section('title')
    Barang
@stop
@section('content')
    <div class="card-body">
        <x-alert />
        <a href="{{ route('barang.update') }}" type="button" class="mb-3 btn btn-primary btn-sm my-2 ml-auto">
            Sinkronisasi Barang
        </a>

        <table class="table table-bordered table-hover bg-white" id="myTable">
            <thead>
                <tr>
                    <th class="text-center" width="10%">#</th>
                    <th>Nama Barang</th>
                    <th>Isi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->isi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@push('js')
    <script>
        let table = new DataTable('#myTable', {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endpush
