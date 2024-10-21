@extends('layouts.app')
@section('title')
    Buku Hutang
@stop
@section('content')
    <div class="card-body">

        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center" width="5%">#</th>
                    <th>Toko Supplier</th>
                    <th width="35%">Nama Barang & No Lot</th>
                    <th>Qty</th>
                    <th>Hutang</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>{{ $item->atas_nama_sales }}</td>
                        <td>{{ $item->nama_barang_dan_no_lot }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>@money($item->hutang)</td>
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
