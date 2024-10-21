@extends('layouts.app')
@section('title')
    Edit Retur Pembelian ke Distributor (NA)
@stop
@section('content')
    <div class="card-body">
        @include('components.button-back', [
            'label' => 'Back',
            'url' => '/report-retur-pembelian-na',
        ])
        <x-alert />
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">No Lot</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Retur Ngurang Hutang</th>
                    <th scope="col">Retur Minta Cash</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <form action="{{ route('report-retur-pembelian-na.update', $item->id) }}" method="post">
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
                                    'name' => 'harga',
                                    'type' => 'number',
                                    'value' => $item->harga,
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
                                @include('components.input', [
                                    'name' => 'retur_ngurang_hutang',
                                    'type' => 'number',
                                    'value' => $item->retur_ngurang_hutang,
                                ])
                            </td>
                            <td>
                                @include('components.input', [
                                    'name' => 'retur_minta_cash',
                                    'type' => 'number',
                                    'value' => $item->retur_minta_cash,
                                ])
                            </td>
                            <td>
                                @include('components.input', [
                                    'name' => 'sub_total',
                                    'type' => 'number',
                                    'value' => $item->sub_total,
                                    'attr' => 'readonly',
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
