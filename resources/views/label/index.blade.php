@extends('layouts.app')
@section('title')
    Cetak Label Harga
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('label.create')
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center" width="10%">#</th>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($label as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>Rp @money($item->harga)</td>
                        <td>
                            <div class="d-flex">
                                <a class="btn btn-sm btn-info mr-1" href="{{ route('label.print', $item->id) }}"><i class="fas fa-print"></i></a>
                                {{-- <button class="btn btn-sm btn-primary mr-1" data-toggle="modal"
                                    data-target="#editModal-{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal-{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @include('label.edit')
                                @include('label.delete') --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data Tidak Ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="my-3">
            {{ $label->links('pagination::bootstrap-4') }}
        </div>
    </div>
@stop

@push('js')
    
@endpush
