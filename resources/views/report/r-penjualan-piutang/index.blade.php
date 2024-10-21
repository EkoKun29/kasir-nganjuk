@extends('layouts.app')
@section('title')
    Report Penjualan Piutang
@stop
@section('content')
    <div class="card-body">
        <x-alert />
        <table id="tbl_report_penjualan_piutang" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Nota</th>
                    <th>Tanggal</th>
                    <th>Toko</th>
                    <th>Nama Konsumen</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('report.r-penjualan-piutang.show')
    @include('report.r-penjualan-piutang.delete')
@stop
@push('js')
    <script>
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_report_penjualan_piutang').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('report-penjualan-piutang.show') }}",
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'no_nota',
                    name: 'no_nota'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'toko',
                    name: 'toko'
                },
                {
                    data: 'nama_konsumen',
                    name: 'nama_konsumen'
                },
                {
                    data: 'total',
                    name: 'total',
                    render: function(data, type, row) {
                        return formatRupiah(data);
                    }
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
                url: `/report-penjualan-piutang/delete/${_id}`,
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
                url: `/report-penjualan-piutang/table/${_id}`,
            }).done(function(data) {
                $('#body_detail').empty();
                var detail = data.data;
                for (var i = 0; i < detail.length; i++) {
                    var row = '<tr>';
                    row += '<td>' + (i + 1) + '</td>';
                    row += '<td>' + detail[i].nama_barang_dan_no_lot + '</td>';
                    row += '<td>' + detail[i].harga + '</td>';
                    row += '<td>' + detail[i].qty + '</td>';
                    row += '<td>' + detail[i].sub_total + '</td>';
                    row += '<td>' + detail[i].diskon + '</td>';
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
                url: `/report-penjualan-piutang/reprint/${_id}`,
            }).done(function(data) {
                $('body').html(data);
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
