@extends('layouts.app')
@section('title')
    Buku Piutang
@stop
@section('content')
    <x-alert />
    <div class="card-body">
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center" width="5%">#</th>
                    <th>Tanggal</th>
                    <th>No Nota</th>
                    <th>Toko Supplier</th>
                    <th>Konsumen</th>
                    <th>Nominal</th>
                    <th>Sisa</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>{{ $item->no_nota }}</td>
                        <td>{{ $item->toko }}</td>
                        <td>{{ $item->nama_konsumen }}</td>
                        <td>@money($item->total)</td>
                        <td>@money($item->sisa)</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data Tidak Ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="my-3">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
        <span>Total Barang : <b>{{ $total }}</b></span>
    </div>
@stop
