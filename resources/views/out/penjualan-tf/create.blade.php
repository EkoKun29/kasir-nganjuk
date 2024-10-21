<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Tambah Barang</h5>
            </div>
            <div class="modal-body">
                <form id="createPenjualanTF" action="#" method="post" onsubmit="">
                    @csrf
                    <label class="col-form-label">Barang</label>
                    <select id="select-barang" name="nama_barang_dan_no_lot" placeholder="Nama Barang"
                            autocomplete="off" required>
                            <option value="" selected>Nama Barang</option>
                            @foreach ($data as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
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
                        'label' => 'Diskon',
                        'name' => 'diskon',
                        'type' => 'number',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
