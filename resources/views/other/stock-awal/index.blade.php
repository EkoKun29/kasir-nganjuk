@extends('layouts.app')
@section('title')
    Barang
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('other.stock-awal.create')
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center" width="5%">#</th>
                    <th>Code</th>
                    <th>Nama Barang</th>
                    <th>No Lot</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>{{ $item->nama_barang_dan_no_lot }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->no_lot }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-sm btn-primary mr-1" data-toggle="modal"
                                    data-target="#editModal-{{ $item->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal-{{ $item->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @include('other.stock-awal.edit')
                                @include('other.stock-awal.delete')
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Barang Tidak Ada</td>
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
