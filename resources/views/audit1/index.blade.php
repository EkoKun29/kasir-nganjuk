@extends('layouts.app')
@section('title')
    Audit 1
@stop
@section('content')
    <div class="card-body">
        {{-- <div style="text-align: right;">
            <a type="button" href="{{ route('stokglobal.index') }}" class="btn btn-success pull-right" >&nbsp;Kembali</a>
        </div>
        <br> --}}
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('audit1.create')
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    @if ($kategori == 1)
                    <th class="text-center" width="10%">No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Dus</th>
                    <th>Botol</th>
                    {{-- <th>Penyetok</th> --}}
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        @if ($kategori == 1)
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                        <td>{{ $item->nama_barang}}</td>
                        <td>{{ $item->duz }}</td>
                        <td>{{ $item->btl }}</td>
                        {{-- <td>{{ $item->penyetok }}</td> --}}
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Data Tidak Ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="my-3">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
        <span> <b> Total Data : {{$data->total() }}<b></span>
    </div>
@stop
