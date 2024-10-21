@extends('layouts.app')
@section('title')
    Edit Penjualan Transfer
@stop
@section('content')
    <div class="card-body">
        <x-alert />
        @include('components.button-back', [
            'label' => 'Back',
            'url' => '/report-penjualan-tf',
        ])
        <form action="{{ route('penjualan-tf.update-induk', $head->id) }}" method="POST">
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
                    <th scope="col" width="30%">Nama Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <form action="{{ route('report-penjualan-tf.update', $item->id) }}" method="post">
                        @csrf
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <input list="nama_barang_dan_no_lots" name="nama_barang_dan_no_lot"
                                    id="nama_barang_dan_no_lot" class="form-control nama_konsumen"
                                    placeholder="Barang dan Lot" value="{{ $item->nama_barang_dan_no_lot }}" required>
                                <datalist id="nama_barang_dan_no_lots">
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->nama_barang_dan_no_lot }}">
                                    @endforeach
                                </datalist>
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
                                    'name' => 'diskon',
                                    'type' => 'number',
                                    'value' => $item->diskon,
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
