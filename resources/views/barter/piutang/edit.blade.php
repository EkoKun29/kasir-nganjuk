<div class="modal fade" id="editModal-{{ $item->id }}" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('barter-piutang.update', $item) }}" method="post">
                    @csrf
                    @method('put')
                    @include('components.input', [
                        'label' => 'Nama Konsumen',
                        'name' => 'nama_konsumen',
                        'value' => $item->nama_konsumen,
                    ])
                    @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $barang,
                        '_item' => 'nama',
                        'isArray' => 'Yes',
                        'selected' => $item->nama_barang,
                    ])
                    @include('components.input', [
                        'label' => 'Nomor Lot',
                        'name' => 'no_lot',
                        'attr' => 'minlength=8 maxlength=8',
                        'value' => $item->no_lot,
                    ])
                    @include('components.input', [
                        'label' => 'Harga',
                        'name' => 'harga',
                        'type' => 'number',
                        'value' => $item->harga,
                    ])
                    @include('components.input', [
                        'label' => 'Qty',
                        'name' => 'qty',
                        'type' => 'number',
                        'value' => $item->qty,
                    ])
                    @include('components.input', [
                        'label' => 'Piutang',
                        'name' => 'piutang',
                        'type' => 'number',
                        'value' => $item->piutang,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
