@extends('layouts.app')
@section('title')
    Kas Keluar Operasional
@stop
@section('content')
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm d-block my-2 ml-auto" data-toggle="modal"
            data-target="#createModal">
            Tambah
        </button>
        @include('out.kas-keluar-operasional.create')
        <x-alert />
        <table id="tbl_kas_keluar_operasinal" class="table table-bordered table-hover bg-white">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keperluan</th>
                    <th>Keterangan</th>
                    <th>No Nota</th>
                    <th>Nominal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    @include('out.kas-keluar-operasional.delete')
    @include('out.kas-keluar-operasional.edit')
@stop
@push('js')
    <script>
        // MENAMPILKAN TABLE
        $table_data = $('#tbl_kas_keluar_operasinal').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kas-keluar-operasional.show') }}",
            columns: [{
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'keperluan',
                    name: 'keperluan'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
                url: `/kas-keluar-operasional/${_id}`,
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
                url: `/kas-keluar-operasional/edit/${_id}`,
            }).done(function(data) {
                $('#editModal').modal();
                $('#editForm').attr('action', `kas-keluar-operasional/update/${_id}`);
                $('input[name="tanggal"]').val(data.data.tanggal);
                $('select[name="keperluan"]').val(data.data.keperluan).trigger('change');
                $('input[name="keterangan"]').val(data.data.keterangan);
                $('input[name="no_nota"]').val(data.data.no_nota);
                $('input[name="nominal"]').val(data.data.nominal);
            }).fail(function(data) {
                alert('Kesalahan pada website. Hubungi IT!');
            });
        }
    </script>
@endpush
