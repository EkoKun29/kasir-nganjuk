@extends('layouts.app')
@section('title')
    Report Retur Pembelian NA
@stop
@section('content')
    <div class="card-body">
        <x-alert />
        <table id="tbl_report_retur_pembelian_na" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Sales</th>
                    <th>Yang Bawa Barang</th>
                    <th>Nomor</th>
                    <th>Tanggal Retur</th>
                    <th>Nama Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('report.r-retur-pembelian-na.delete')
    @include('report.r-retur-pembelian-na.show')
@stop
@push('js')
    <script>
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_report_retur_pembelian_na').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('report-retur-pembelian-na.show') }}",
            columns: [{
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'atas_nama_sales',
                    name: 'atas_nama_sales'
                },
                {
                    data: 'yang_bawa_barang',
                    name: 'yang_bawa_barang'
                },
                {
                    data: 'nmr',
                    name: 'nmr'
                },
                {
                    data: 'tgl_retur',
                    name: 'tgl_retur'
                },
                {
                    data: 'nama_suplier',
                    name: 'nama_suplier'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        var _id = '';

        // FUNGSI UNTUK MELAKUKAN DELETE
        function deleteModal($id) {
            _id = $id;
            $('#namaData').html($id);
            $('#deleteModal').modal();
        }

        $('#deleteModalForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'delete',
                url: `/report-retur-pembelian-na/delete/${_id}`,
            }).done(function(data) {
                $('#deleteModal').modal('hide');
                $table_data.ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil dihapus',
                    showConfirmButton: false,
                    timer: 1000
                })
            }).fail(function(data) {
                $('#deleteModal').modal('hide');
                alert('Kesalahan pada website. Hubungi IT!');
            });
        });

        // FUNGSI UNTUK MELAKUKAN SHOW
        function showModal($id) {
            _id = $id;
            $('#showModal').modal();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: `/report-retur-pembelian-na/table/${_id}`,
            }).done(function(data) {
                $('#body_detail').empty();
                var detail = data.data;
                for (var i = 0; i < detail.length; i++) {
                    var row = '<tr>';
                    row += '<td>' + (i + 1) + '</td>';
                    row += '<td>' + detail[i].nama_barang + '</td>';
                    row += '<td>' + detail[i].no_lot + '</td>';
                    row += '<td>' + detail[i].harga + '</td>';
                    row += '<td>' + detail[i].qty + '</td>';
                    row += '<td>' + detail[i].retur_ngurang_hutang + '</td>';
                    row += '<td>' + detail[i].retur_minta_cash + '</td>';
                    row += '<td>' + detail[i].sub_total + '</td>';
                    row += '</tr>';
                    $('#body_detail').append(row);
                }
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }

        // FUNGSI UNTUK MELAKUKAN DOWNLOAD STRUK
        function downloadButton($id) {
            _id = $id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: `/report-retur-pembelian-na/reprint/${_id}`,
            }).done(function(data) {
                $('body').html(data);
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
