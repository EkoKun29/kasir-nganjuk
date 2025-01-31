@extends('layouts.app')
@section('title')
    Edit Penjualan Cash
@stop
@section('content')
    <div class="card-body">
        <x-alert />
        @include('components.button-back', [
            'label' => 'Back',
            'url' => '/report-retur-penjualan',
        ])
        <form action="{{ route('retur-penjualan.update-induk', $head->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4">
                    <label>Tanggal</label>
                    @include('components.input', [
                        'name' => 'created_at',
                        'type' => 'text',
                        'value' => $head->created_at,
                    ])
                </div>
                <div class="col-4">
                    <label>Nama Konsumen</label>
                    @include('components.input', [
                        'name' => 'nama_konsumen',
                        'type' => 'text',
                        'value' => $head->nama_konsumen,
                    ])
                </div>
                <div class="col-4">
                    <label>No Nota Penjualan</label>
                    @include('components.input', [
                        'name' => 'no_nota_piutang',
                        'type' => 'text',
                        'value' => $head->no_nota_piutang,
                    ])
                </div>
                <div class="col-4">
                    <label>Tgl Nota Penjualan</label>
                    @include('components.input', [
                        'name' => 'tgl_nota_piutang',
                        'type' => 'date',
                        'value' => $head->no_nota_piutang,
                    ])
                </div>
                <div class="col-4">
                    <label>Minta Cash</label>
                    @include('components.input', [
                        'name' => 'uang_keluar',
                        'type' => 'number',
                        'value' => $head->uang_keluar,
                    ])
                </div>
                <div class="col-4">
                    <label>Ngurang Piutang</label>
                    @include('components.input', [
                        'name' => 'sisa_piutang',
                        'type' => 'number',
                        'value' => $head->sisa_piutang,
                    ])
                </div>
                <div class="col-4 mt-4 pt-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
        <hr>
        <table class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" width="30%">Nama Barang dan No Lot</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Hpp</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <form action="{{ route('report-retur-penjualan.update', $item->id) }}" method="post">
                        @csrf
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @include('components.select', [
                                    'name' => 'nama_barang_dan_no_lot',
                                    '_data' => $barang,
                                    '_item' => 'nama',
                                    'isArray' => '',
                                    'selected' => $item->nama_barang_dan_no_lot,
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
                            <td>@money($item->sub_total)</td>
                            <td>
                                @include('components.input', [
                                    'name' => 'hpp',
                                    'type' => 'number',
                                    'value' => $item->hpp,
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
