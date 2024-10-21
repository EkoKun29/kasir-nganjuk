<script>
    // FUNGSI UNTUK MELAKUKAN DELETE
    let _routeName = {{ $route_name }};

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
            url: `/${_routeName}/${_id}`,
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
</script>
