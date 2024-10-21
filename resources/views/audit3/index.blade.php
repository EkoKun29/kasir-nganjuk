@extends('layouts.app')
@section('title')
    Audit 3
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
        @include('audit3.create')
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    @if($kategori ==3)
                    <th class="text-center" width="10%">No</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Duz</th>
                    <th>Botol</th>
                    {{-- <th>Total</th> --}}
                    {{-- <th>Penyetok</th> --}}
                    {{-- <th>Action</th> --}}
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        @if($kategori ==3)
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                        <td>{{ $item->nama_barang}}</td>
                        <td>{{ $item->duz}}</td>
                        <td>{{ $item->btl }}</td>
                        {{-- <td>{{ $item->total }}</td> --}}
                        {{-- <td>{{ $item->penyetok }}</td> --}}
                        {{-- <td>
                            <div class="d-flex">
                                <button class="btn btn-sm btn-danger mr-1" data-toggle="modal"
                                    data-target="#editModal-{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal-{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @include('audit3.edit')
                                @include('audit3.delete')
                            </div>
                        </td> --}}
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
