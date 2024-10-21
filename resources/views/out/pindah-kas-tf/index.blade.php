@extends('layouts.app')
@section('title')
    Pindah Kas TF
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('out.pindah-kas-tf.create')
        <x-alert />
        <table id="tbl_pindah_kas_tf" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Sales</th>
                    <th>Nomor Nota</th>
                    <th>Nominal</th>
                    <th>Bank</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('out.pindah-kas-tf.delete')
    @include('out.pindah-kas-tf.edit')
@stop
@push('js')
    <script>
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_pindah_kas_tf').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pindah-kas-tf.show') }}",
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'sales',
                    name: 'sales'
                },
                {
                    data: 'no_nota',
                    name: 'no_nota'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'bank',
                    name: 'bank'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
                url: `/pindah-kas-tf/${_id}`,
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
                url: `/pindah-kas-tf/edit/${_id}`,
            }).done(function(data) {
                $('#editModal').modal();
                $('#editForm').attr('action', `pindah-kas-tf/update/${_id}`);
                $('input[name="tanggal"]').val(data.data.tanggal);
                $('input[name="sales"]').val(data.data.sales);
                $('input[name="no_nota"]').val(data.data.no_nota);
                $('input[name="nominal"]').val(data.data.nominal);
                $('select[name="bank"]').val(data.data.bank).trigger('change');
                $('input[name="keterangan"]').val(data.data.keterangan);
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
