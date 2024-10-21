@extends('layouts.app')
@section('title')
    Pindah Stock In
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('in.pindah-stock.create')
        <x-alert />
        <table id="tbl_pindah_stock_in" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>Sales</th>
                    <th>Dibawa Oleh</th>
                    <th>Nomor</th>
                    <th>Barang Dari</th>
                    <th>Nama Barang</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('in.pindah-stock.delete')
    @include('in.pindah-stock.edit')
@stop
@push('js')
    <script>
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_pindah_stock_in').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('stock-in.show') }}",
            columns: [{
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
                    data: 'barang_dari',
                    name: 'barang_dari'
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
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'delete',
                url: `/stock-in/${_id}`,
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
                url: `/stock-in/edit/${_id}`,
            }).done(function(data) {
                $('#editModal').modal();
                $('#editForm').attr('action', `stock-in/update/${_id}`);
                $('input[name="nmr"]').val(data.data.nmr);
                $('input[name="sales"]').val(data.data.sales);
                $('input[name="yang_bawa_barang"]').val(data.data.yang_bawa_barang);
                $('input[name="barang_dari"]').val(data.data.barang_dari);
                $('input[name="qty"]').val(data.data.qty);
                $('select[name="nama_barang"]').val(data.data.nama_barang).trigger('change');
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
