@extends('layouts.app')
@section('title')
    Retur Pembelian Via Cash
@stop
@section('content')
    <div class="card-body ">
        {{-- Top --}}
        <div class="row">
            {{-- Left --}}
            <div class="col">
                <div class="row align-items-center mb-3">
                    <div class="col-3">
                        <label class="col-form-label">Nama Supplier</label>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" id="nama_suplier">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-3">
                        <label class="col-form-label">Tanggal Pembelian</label>
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control" id="tgl_retur">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-3">
                        <label class="col-form-label">No Nota Pembelian</label>
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" id="nmr">
                    </div>
                </div>
            </div>
            {{-- Right --}}
            <div class="col">
                <div class="row align-items-center mb-3">
                    <div class="col-3">
                        <label class="col-form-label">Toko</label>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" value="TOKO NGANJUK" readonly>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-3">
                        <label class="col-form-label">Dibawa Oleh</label>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" id="yang_bawa_barang">
                    </div>
                </div>
            </div>
        </div>
        {{-- Table --}}
        <button type="button" class="btn btn-primary btn-sm d-block mt-3 mb-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('out.retur-pembelian-cash.create')
        <table id="tbl_retur_pembelian_na" class="table table-bordered table-hover mb-5">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="20%">Nama Barang & No Lot</th>
                    <th>Nama Barang</th>
                    <th>No Lot</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Retur Minta Cash</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl_body_retur_pembelian_na">
            </tbody>
        </table>
        <button type="button" class="btn btn-success btn-sm d-block mt-3 mb-2 ml-auto
        " onclick="submitAll()">
            Kirim Data
        </button>
    </div>
@stop
@push('js')
    <script>
        var nama_suplier = '';
        var tgl_retur = '';
        var nmr = '';
        var yang_bawa_barang = '';

        var subtotal = 0;
        var globalData = [];

        // MENDAPATKAN DATA TOP
        $('#nama_suplier').change(function() {
            nama_suplier = $('#nama_suplier').val();
        });
        $('#tgl_retur').change(function() {
            tgl_retur = $('#tgl_retur').val();
        });
        $('#nmr').change(function() {
            nmr = $('#nmr').val();
        });
        $('#yang_bawa_barang').change(function() {
            yang_bawa_barang = $('#yang_bawa_barang').val();
        });

        // SUBMIT ALL WITH POST
        function submitAll() {
            $.ajax({
                url: "{{ route('retur-pembelian-na.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    nama_suplier: nama_suplier,
                    tgl_retur: tgl_retur,
                    nmr: nmr,
                    yang_bawa_barang: yang_bawa_barang,
                    data: globalData
                },
            }).done(function(data) {
                $('body').html(data);
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }

        // MENGHAPUS ROW
        $("#tbl_retur_pembelian_na").on('click', '.btnDelete', function() {
            var data = $(this).closest('tr');
            var id = data.find('#no').text() - 1;
            data.remove();

            // Mendapatkan index
            let index = globalData.findIndex(function(field) {
                return field.id == id
            });

            // Hapus data pada globalData
            globalData.splice(index, 1);
        });

        // CREATE PENJUALAN
        $('#createReturPembelianNa').on("submit", function(event) {
            event.preventDefault();

            // Cek apakah nilai minus atau tidak
            var harga = $("[name='harga']").val();
            var qty = $("[name='qty']").val();
            var retur_minta_cash = $("[name='retur_minta_cash']").val();
            var retur_ngurang_hutang = $("[name='retur_ngurang_hutang']").val();
            var subtotal = 0;

            subtotal = (harga * qty);
            if (subtotal < 0) {
                alert('Subtotal tidak boleh lebih kecil dari 0')
                return false;
            }

            // Menyimpan data 
            var formPenjualanCash = $('#createReturPembelianNa');
            var formData = formPenjualanCash.serializeArray();

            var formValues = {};

            $.each(formData, function(index, field) {
                formValues[field.name] = field.value;
            });

            // Add subtotal
            formValues['subtotal'] = subtotal;
            formValues['id'] = globalData.length;

            // Push ke global data
            globalData.push(formValues);

            // Reset form input dan tutup modal
            formPenjualanCash.trigger("reset");
            $('#createModal').modal('hide');

            // select the table body element
            var tableBody = $("#tbl_body_retur_pembelian_na");

            // create a new table row element and append it to the table body
            var newRow = $("<tr>").append(
                $("<td id='no'>").text(formValues.id + 1),
                $('<td>').text(formValues.nama_barang + ' // ' + formValues.no_lot),
                $("<td>").text(formValues.nama_barang),
                $("<td>").text(formValues.no_lot),
                $("<td>").text(formValues.harga),
                $("<td>").text(formValues.qty),
                
                $("<td>").text(formValues.retur_minta_cash),
                $("<td>").text(formValues.subtotal),
                $("<td>").html(
                    '<button class="btn btn-sm btn-danger btnDelete" ><i class="fas fa-trash"></i></button>')
            );

            tableBody.append(newRow);

            // change total harga
            totalHarga();

        });
    </script>
@endpush
