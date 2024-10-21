@extends('layouts.app')
@section('title')
    Retur Pembelian ke Gudang
@stop
@section('content')
    <div class="card-body ">
        {{-- Top --}}
        <div class="row">
            <div class="col-7">
                {{-- Left --}}
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">Toko</label>
                    </div>
                    <div class="col-6">
                        <input class="form-control" id="toko" value="TOKO NGANJUK" readonly>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">Gudang</label>
                    </div>
                    <div class="col-6">
                        <select id="select2" class="form-control" name="gudang">
                            <option selected disabled>Pilih Gudang</option>
                            <option value="punokawan">Punokawan</option>
                            <option value="abimanyu">Abimanyu</option>
                            <option value="jember">Jember</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
        </div>
        {{-- Table --}}
        <button type="button" class="btn btn-primary btn-sm d-block mt-3 mb-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('in.retur-pembelian-gudang.create')
        <table id="tbl_retur_gudang" class="table table-bordered table-hover mb-5">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="33%">Nama Barang & No Lot</th>
                    <th>Nama Barang</th>
                    <th>No Lot</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl_body_retur_gudang">
            </tbody>
        </table>
        <button class="btn btn-success btn-sm d-block mt-3 mb-2 ml-auto" onclick="submitAll()">
            Kirim Data
        </button>
    </div>
@stop
@push('js')
    <script>
        var gudang = '';
        var globalData = [];
        var toko = "Toko NGANJUK"

        // MENDAPATKAN NAMA GUDANG
        $('select[name="gudang"]').change(function() {
            gudang = $(this).val();
        });

        // SUBMIT ALL WITH POST
        function submitAll() {
            $.ajax({
                url: "{{ route('retur-pembelian-gudang.store') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: {
                    toko: toko,
                    gudang: gudang,
                    data: globalData
                },
            }).done(function(data) {
                $('body').html(data);
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }

        // MENGHAPUS ROW
        $("#tbl_retur_gudang").on('click', '.btnDelete', function() {
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
        $('#createReturGudang').on("submit", function(event) {
            event.preventDefault();

            // Menyimpan data 
            var formReturGudang = $('#createReturGudang');
            var formData = formReturGudang.serializeArray();

            var formValues = {};

            $.each(formData, function(index, field) {
                formValues[field.name] = field.value;
            });

            // Add subtotal
            formValues['id'] = globalData.length;

            // Push ke global data
            globalData.push(formValues);

            // Reset form input dan tutup modal
            formReturGudang.trigger("reset");
            $('#createModal').modal('hide');

            // select the table body element
            var tableBody = $("#tbl_body_retur_gudang");

            // create a new table row element and append it to the table body
            var newRow = $("<tr>").append(
                $("<td id='no'>").text(formValues.id + 1),
                $("<td>").text(formValues.nama_barang + ' // ' + formValues.no_lot),
                $("<td>").text(formValues.nama_barang),
                $("<td>").text(formValues.no_lot),
                $("<td>").text(formValues.qty),
                $("<td>").html(
                    '<button class="btn btn-sm btn-danger btnDelete" ><i class="fas fa-trash"></i></button>')
            );

            tableBody.append(newRow);

        });
    </script>
@endpush
