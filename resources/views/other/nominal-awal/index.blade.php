@extends('layouts.app')
@section('title')
    Nominal
@stop
@section('content')
    <div class="card-body">
        @if ($data->total() == 0)
            <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
                data-target="#createModal">
                Tambah
            </button>
            @include('other.nominal-awal.create')
        @endif

        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center" width="10%">#</th>
                    <th>Kas</th>
                    <th>Saldo Bank</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>@money($item->kas)</td>
                        <td>@money($item->saldo_bank)</td>
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
                                @include('other.nominal-awal.edit')
                                @include('other.nominal-awal.delete')
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Data Tidak Ada</td>
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
