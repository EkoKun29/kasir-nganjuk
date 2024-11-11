@extends('layouts.app')
@section('title')
    Pembayaran Piutang Cash
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('in.pembayaran-piutang-cash.create')
        <x-alert />
        <table id="tbl_pembayaran-piutang-cash" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>Toko</th>
                    <th>Tanggal Bayar</th>
                    <th>Konsumen</th>
                    <th>No. Nota</th>
                    <th>Tanggal Nota</th>
                    <th>Tunai</th>
                    <th>Transfer</th>
                    <th>Bank</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('in.pembayaran-piutang-cash.delete')
    @include('in.pembayaran-piutang-cash.edit')
@stop
@push('js')
<script>
    new TomSelect("#select-konsumen", {
        create: false,
    });
    new TomSelect("#name-konsumen", {
        create: false,
    });
    </script>
    <script>
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_pembayaran-piutang-cash').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pembayaran-piutang-cash.show') }}",
            columns: [{
                    data: 'toko',
                    name: 'toko'
                },
                {
                    data: 'tgl_bayar',
                    name: 'tgl_bayar'
                },
                {
                    data: 'nama_konsumen',
                    name: 'nama_konsumen'
                },
                {
                    data: 'no_nota_piutang',
                    name: 'no_nota_piutang'
                },
                {
                    data: 'tgl_nota_piutang',
                    name: 'tgl_nota_piutang'
                },
                {
                    data: 'tunai',
                    name: 'tunai'
                },
                {
                    data: 'tf',
                    name: 'tf'
                },
                {
                    data: 'bank',
                    name: 'bank'
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
                url: `/pembayaran-piutang-cash/${_id}`,
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
                url: `/pembayaran-piutang-cash/edit/${_id}`,
            }).done(function(data) {
                $('#editModal').modal();
                $('#editForm').attr('action', `pembayaran-piutang-cash/update/${_id}`);
                $('input[name="toko"]').val(data.data.toko);
                $('input[name="nama_konsumen"]').val(data.data.nama_konsumen);
                $('select[name="no_nota_piutang"]').val(data.data.no_nota_piutang).trigger('change');
                $('input[name="tgl_nota_piutang"]').val(data.data.tgl_nota_piutang);
                $('input[name="sisa_piutang"]').val(data.data.sisa_piutang);
                $('input[name="tunai"]').val(data.data.tunai);
                $('input[name="tf"]').val(data.data.tf);
                $('select[name="bank"]').val(data.data.bank).trigger('change');
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
