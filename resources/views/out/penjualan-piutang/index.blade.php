@extends('layouts.app')
@section('title')
    Penjualan Piutang
@stop
@section('content')
    <div class="card-body ">
        <x-alert />
        {{-- Top --}}
        <div class="row">
            <div class="col-7">
                {{-- Left --}}
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">No Nota<span
                            class="text-danger">*</span></label>
                    </div>
                    <div class="col-6">
                        <input type="number" class="form-control" name="no_nota" id="no_nota" min="0">
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">Toko<span
                            class="text-danger">*</span></label>
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" value="TOKO NGANJUK" readonly>
                    </div>
                </div>
                <div class="row align-items-center mb-3">
                    <div class="col-2">
                        <label class="col-form-label">Konsumen<span
                            class="text-danger">*</span></label>
                    </div>
                    <div class="col-6">
                        <select id="nama_konsumen" name="customer" placeholder="Nama Konsumen"
                            autocomplete="off" required>
                            <option value="" selected>Nama Konsumen</option>
                            @foreach ($konsumens as $konsumen)
                                <option value="{{ $konsumen->nama  }}">{{ $konsumen->nama  }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{-- Right --}}
                <p>Total Pembayaran</p>
                <h1 class="font-weight-bold" id="TotalPembayaran">Rp 0</h1>
            </div>
        </div>
        {{-- Table --}}
        <button type="button" class="btn btn-primary btn-sm d-block mt-3 mb-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('out.penjualan-piutang.create')
        <table id="tbl_penjualan_piutang" class="table table-bordered table-hover mb-5">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th width="30%">Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Diskon</th>
                    <th>SubTotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbl_body_penjualan_piutang">
            </tbody>
        </table>
        {{-- Bottom --}}
        <div class="row">
            <div class="col-5">
            </div>
            <div class="col-5">
                <div class="row align-items-center mb-3">
                    <div class="col-3">
                        <label class="col-form-label">Piutang</label>
                    </div>
                    <div class="col-8">
                        <input type="number" class="form-control" id="bayar" disabled>
                    </div>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary" onclick="submitAll(this)">Submit</button>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        // USE SELECT 2
        $('.select2').select2({
            theme: 'bootstrap4',
        });
        new TomSelect("#nama_konsumen", {
    create: false,
});
    </script>
    <script>
        var no_nota = '';
        var nama_konsumen   = '';
        var totalPembayaran = 0;
        var globalData = [];
        var data_barang = <?php echo json_encode($data); ?>; // Menyimpan data NAMA_BARANG_DAN NO_LOT DAN QTY

        // NO NOTA
        $(`#no_nota`).change(function() {
            no_nota = $(this).val();
        });

        // MENDAPATKAN NAMA KONSUMEN
        $(`#nama_konsumen`).change(function() {
            nama_konsumen = $(this).val();
        });

        // SUBMIT ALL WITH POST
        function submitAll(element) {
            $(element).prop('disabled', true);
            if (globalData) {
                $.ajax({
                    url: "{{ route('penjualan-piutang.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        no_nota: no_nota,
                        nama_konsumen: nama_konsumen,
                        total: totalPembayaran,
                        data: globalData
                    },
                }).done(function(data) {
                    $('body').html(data);
                }).fail(function(data) {
                    alert('Kesalahan pada website. Hubungi IT!');
                });
            } else {
                alert('Data tidak boleh kosong')
            }
        }

        // MENGHAPUS ROW
        $("#tbl_penjualan_piutang").on('click', '.btnDelete', function() {
            var data = $(this).closest('tr');
            var id = data.find('#no').text() - 1;
            data.remove();

            // Mendapatkan index
            let index = globalData.findIndex(function(field) {
                // Mengembalikan nilai ke data_barang
                data_barang = data_barang.map(function(obj) {
                    if (obj.nama_barang_dan_no_lot === field.nama_barang_dan_no_lot) {
                        return {
                            nama_barang_dan_no_lot: obj.nama_barang_dan_no_lot,
                            qty: obj.qty + parseInt(field.qty)
                        };
                    }
                    return obj;
                });
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
            $('#TotalPembayaran').text(formatRupiah(totalPembayaran));
            $('#bayar').val(totalPembayaran);
        }

        // CREATE PENJUALAN
        $('#createPenjualanPiutang').on("submit", function(event) {
            event.preventDefault();

            // Cek apakah nilai minus atau tidak
            var harga = $("[name='harga']").val();
            var qty = $("[name='qty']").val();
            var diskon = $("[name='diskon']").val();
            var subtotal = 0;

            subtotal = (harga * qty);
            // subtotal = (harga * qty) - diskon;
            if (subtotal < 0) {
                alert('Subtotal tidak boleh lebih kecil dari 0')
                return false;
            }

            // Cek apakah qty kurang dari persediaan barang
            // var barang = $("[name='nama_barang_dan_no_lot']").val();
            // var pilihan = data_barang.find(function(item) {
            //     return item.nama_barang_dan_no_lot === barang;
            // });

            // if (qty > pilihan.qty) {
            //     alert('Qty lebih dari stock')
            //     return false;
            // }

            // data_barang = data_barang.map(function(obj) {
            //     if (obj.nama_barang_dan_no_lot === barang) {
            //         return {
            //             nama_barang_dan_no_lot: obj.nama_barang_dan_no_lot,
            //             qty: obj.qty - qty
            //         };
            //     }
            //     return obj;
            // });

            // Menyimpan data 
            var formPenjualanPiutang = $('#createPenjualanPiutang');
            var formData = formPenjualanPiutang.serializeArray();

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
            formPenjualanPiutang.trigger("reset");
            $('#createModal').modal('hide');

            // select the table body element
            var tableBody = $("#tbl_body_penjualan_piutang");

            // create a new table row element and append it to the table body
            var newRow = $("<tr>").append(
                $("<td id='no'>").text(formValues.id + 1),
                $("<td>").text(formValues.nama_barang_dan_no_lot),
                $("<td>").text(formValues.harga),
                $("<td>").text(formValues.qty),
                $("<td>").text(formValues.diskon),
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
