@extends('layouts.app')
@section('title')
    Retur Penjualan Via Cash
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
                        <input type="text" class="form-control" value="TOKO NGANJUK" readonly>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">Konsumen</label>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="(Optional)" id="nama_konsumen">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">No Nota Penjualan</label>
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" id="no_nota_piutang">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">Tanggal Nota Penjualan</label>
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control" id="tgl_nota_piutang">
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
        @include('in.retur-penjualan.create')
        <table id="tbl_retur_penjualan" class="table table-bordered table-hover mb-5">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>SubTotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl_body_pembayaran_piutang_retur">
            </tbody>
        </table>
        {{-- Bottom --}}
        <div class="row text-right">
            <div class="col-3">
                <div class="row align-items-center mb-3">
                    <div class="col-5">
                        <label class="col-form-label">Minta Cash</label>
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" id="uang_keluar">
                    </div>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary" onclick="submitAll()">Simpan</button>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        var nama_konsumen = '';
        var totalPembayaran = 0;
        var uang_keluar = 0;
        var kembalian = 0;
        var no_nota_piutang = '';
        var tgl_nota_piutang = '';
        var sisa_piutang = 0;
        var globalData = [];

        // MENDAPATKAN NAMA KONSUMEN, UANG KELUAR, NO NOTA, TANGGAL NOTA, & SISA PIUTANG
        $('#nama_konsumen').change(function() {
            nama_konsumen = $('#nama_konsumen').val();
        });

        $('#uang_keluar').change(function() {
            uang_keluar = $('#uang_keluar').val();
        });

        $('#no_nota_piutang').change(function() {
            no_nota_piutang = $('#no_nota_piutang').val();
        });

        $('#tgl_nota_piutang').change(function() {
            tgl_nota_piutang = $('#tgl_nota_piutang').val();
        });

        $('#sisa_piutang').change(function() {
            sisa_piutang = $('#sisa_piutang').val();
        });

        // SUBMIT ALL WITH POST
        function submitAll() {
            if (kembalian < 0) {
                alert('Kembalian tidak boleh minus!');
            } else {
                $.ajax({
                    url: "{{ route('retur-penjualan.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        nama_konsumen: nama_konsumen,
                        total: totalPembayaran,
                        uang_keluar: uang_keluar,
                        kembalian: kembalian,
                        no_nota_piutang: no_nota_piutang,
                        tgl_nota_piutang: tgl_nota_piutang,
                        sisa_piutang: sisa_piutang,
                        data: globalData
                    },
                }).done(function(data) {
                    $('body').html(data);
                }).fail(function(data) {
                    alert('Kesalahan pada website. Hubungi IT!');
                });
            }
        }



        // MENGHAPUS ROW
        $("#tbl_retur_penjualan").on('click', '.btnDelete', function() {
            var data = $(this).closest('tr');
            var id = data.find('#no').text() - 1;
            data.remove();

            // Mendapatkan index
            let index = globalData.findIndex(function(field) {
                return field.id == id
            });

            // Hapus data pada globalData
            globalData.splice(index, 1);
            totalHarga();
        });

        // BERGUNA UNTUK MENENTUKAN TOTAL 
        function totalHarga() {
            totalPembayaran = globalData.reduce(function(acc, obj) {
                return acc + obj.subtotal;
            }, 0);
            $('#TotalPembayaran').text('Rp ' + totalPembayaran);
        }

        // MENDAPATKAN NILAI KEMBALIAN
        $("#uang_keluar").on("input", function() {
            uang_keluar = $(this).val();
            kembalian = uang_keluar - totalPembayaran;
            $('#kembalian').val(kembalian);
        });

        // CREATE PENJUALAN
        $('#createReturPenjualan').on("submit", function(event) {
            event.preventDefault();

            // Cek apakah nilai minus atau tidak
            var harga = $("[name='harga']").val();
            var qty = $("[name='qty']").val();
            var subtotal = 0;

            subtotal = (harga * qty);
            if (subtotal < 0) {
                alert('Subtotal tidak boleh lebih kecil dari 0')
                return false;
            }

            // Menyimpan data 
            var formReturPenjualan = $('#createReturPenjualan');
            var formData = formReturPenjualan.serializeArray();

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
            formReturPenjualan.trigger("reset");
            $('#createModal').modal('hide');

            // select the table body element
            var tableBody = $("#tbl_body_pembayaran_piutang_retur");

            // create a new table row element and append it to the table body
            var newRow = $("<tr>").append(
                $("<td id='no'>").text(formValues.id + 1),
                $("<td>").text(formValues.nama_barang),
                $("<td>").text(formValues.harga),
                $("<td>").text(formValues.qty),
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
