@extends('layouts.app')
@section('title')
    Pindah Stock Out
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('out.pindah-stock.create')
        <x-alert />
        <table id="tbl_pindah_stock_out" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>Sales</th>
                    <th>Dibawa Oleh</th>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Barang Ke</th>
                    <th>Nama Barang</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('out.pindah-stock.delete')
    @include('out.pindah-stock.edit')
@stop
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script>
        DataTable.datetime('D/M/YYYY');
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_pindah_stock_out').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('stock-out.show') }}",
            columns: [{
                    data: 'atas_nama_sales',
                    name: 'atas_nama_sales'
                },
                {
                    data: 'yang_bawa_barang',
                    name: 'yang_bawa_barang'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data, type, full, meta) {
                        // Mengubah format tanggal menggunakan moment.js
                        return moment(data).format('D/M/YYYY');
                    }
                },
                {
                    data: 'nmr',
                    name: 'nmr'
                },
                {
                    data: 'barang_ke',
                    name: 'barang_ke'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        // FUNGSI UNTUK MELAKUKAN DELETE
        let _id = '';

        function openModal($id) {
            _id = $id;
            $('#namaData').html($id);
            $('#deleteModal').modal();
        }

        $('#deleteModalForm').submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'delete',
                url: `/stock-out/${_id}`,
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

        // FUNGSI UNTUK MELAKUKAN EDIT
        function editModal($id) {
            _id = $id;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: `/stock-out/edit/${_id}`,
            }).done(function(data) {
                $('#editModal').modal();
                $('#editForm').attr('action', `stock-out/update/${_id}`);
                $('input[name="nmr"]').val(data.data.nmr);
                $('input[name="barang_ke"]').val(data.data.barang_ke);
                $('input[name="qty"]').val(data.data.qty);
                $('select[name="nama_barang"]').val(data.data.nama_barang).trigger('change');
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
