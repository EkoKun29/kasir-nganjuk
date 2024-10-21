<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Stock Awal</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('stock-awal.store') }}" method="post">
                    @csrf
                    @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $barang,
                        '_item' => 'nama',
                        'isArray' => '',
                    ])
                    @include('components.input', [
                        'label' => 'Nomor Lot',
                        'name' => 'no_lot',
                    ])
                    @include('components.input', [
                        'label' => 'Quantity',
                        'name' => 'qty',
                        'type' => 'number',
                        'value' => 0,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
