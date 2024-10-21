<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Tambah Barang</h5>
            </div>
            <div class="modal-body">
                <form id="createReturPembelianNa" action="#" method="post" onsubmit="">
                    @csrf
                    @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $data,
                        '_item' => 'nama',
                        'isArray' => '',
                    ])
                    @include('components.input', [
                        'label' => 'Nomor Lot',
                        'name' => 'no_lot',
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
                        'label' => 'Retur Minta Cash',
                        'name' => 'retur_minta_cash',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'name' => 'retur_ngurang_hutang',
                        'type' => 'number',
                        'attr' => 'hidden',
                        'value' => 0,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
