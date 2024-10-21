<div class="modal fade" id="editModal-{{ $item->id }}" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('stock-awal.update', $item) }}" method="post">
                    @csrf
                    @method('put')
                    @include('components.input', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        'value' => $item->nama_barang,
                        'attr' => 'readonly',
                    ])
                    @include('components.input', [
                        'label' => 'Nomor Lot',
                        'name' => 'no_lot',
                        'attr' => 'minlength=8 maxlength=8',
                        'value' => $item->no_lot,
                    ])
                    @include('components.input', [
                        'label' => 'Quantity',
                        'name' => 'qty',
                        'type' => 'number',
                        'value' => $item->qty,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
