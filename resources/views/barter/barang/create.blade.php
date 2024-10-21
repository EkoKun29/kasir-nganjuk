<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Barter Via Cash</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('barter-cash.store') }}" method="post">
                    @csrf
                    @include('components.input', [
                        'label' => 'Nama Konsumen',
                        'name' => 'nama_konsumen',
                    ])
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
                        'attr' => 'minlength=8 maxlength=8',
                    ])
                    @include('components.input', [
                        'label' => 'Harga',
                        'name' => 'harga',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Qty',
                        'name' => 'qty',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'name' => 'cash',
                        'type' => 'hidden',
                        'value' => 0,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
