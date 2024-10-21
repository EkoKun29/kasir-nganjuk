<div class="modal fade" id="deleteModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('stock-awal.delete', $item) }}" method="post">
                    @csrf
                    @method('delete')
                    <p>Anda yakin ingin menghapus Data <strong>{{ $item->nama_barang_dan_no_lot }}</strong>?</p>
                    @include('components.button', ['submit' => 'yakin', 'close' => 'tidak'])
                </form>
            </div>
        </div>
    </div>
</div>
