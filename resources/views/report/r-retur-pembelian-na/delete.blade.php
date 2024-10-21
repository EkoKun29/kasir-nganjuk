<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
            </div>
            <div class="modal-body">
                <form id="deleteModalForm" action="#" method="post">
                    @csrf
                    <p>Anda yakin ingin menghapus Data ke-<strong id="namaData"></strong>?</p>
                    @include('components.button', ['submit' => 'yakin', 'close' => 'tidak'])
                </form>
            </div>
        </div>
    </div>
</div>
