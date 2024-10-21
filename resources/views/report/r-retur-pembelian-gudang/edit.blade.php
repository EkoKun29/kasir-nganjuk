@extends('layouts.app')
@section('title')
    Edit Retur Pembelian ke Gudang
@stop
@section('content')
    <div class="card-body">
        @include('components.button-back', [
            'label' => 'Back',
            'url' => '/report-retur-pembelian-gudang',
        ])
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">No Lot</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <form action="{{ route('report-retur-pembelian-gudang.update', $item->id) }}" method="post">
                        @csrf
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @include('components.select', [
                                    'name' => 'nama_barang',
                                    '_data' => $barang,
                                    '_item' => 'nama',
                                    'isArray' => '',
                                    'selected' => $item->nama_barang,
                                ])
                            </td>
                            <td>
                                @include('components.input', [
                                    'name' => 'no_lot',
                                    'attr' => 'minlength=8 maxlength=8',
                                    'value' => $item->no_lot,
                                ])
                            </td>
                            <td>
                                @include('components.input', [
                                    'name' => 'qty',
                                    'type' => 'number',
                                    'value' => $item->qty,
                                ])
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary btn-sm ">
                                        <i class="fas fa-save"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
