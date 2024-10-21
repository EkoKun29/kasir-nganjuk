<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Tambah Barang</h5>
            </div>
            <div class="modal-body">
                <form id="createPembayaranPiutang" action="#" method="post" onsubmit="">
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
                        // 'attr' => 'minlength=8 maxlength=8',
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
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
