@extends('layouts.app')
@section('title')
    Ambil Uang di Bank ke TTB
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('ambil-uang-di-bank.ttb.create')
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th class="text-center" width="10%">#</th>
                    <th>Tanggal</th>
                    <th>Dari Bank</th>
                    <th>Nominal</th>
                    <th>Ke Akun</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td class="text-center">{{ $data->currentPage() * 10 - 10 + $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->dari_bank }}</td>
                        <td>{{ $item->nominal }}</td>
                        <td>{{ $item->ke_akun }}</td>
                        <td>{{ $item->keterangan }}</td>
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
                                @include('ambil-uang-di-bank.ttb.edit')
                                @include('ambil-uang-di-bank.ttb.delete')
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
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
        <span>Total Data : <b>{{ $total }}</b></span>
    </div>
@stop
