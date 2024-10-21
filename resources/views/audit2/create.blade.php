<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Barang</h5>
            </div>
            <div class="modal-body">
                <form id="{{ route('audit2.create') }}" method="post">
                    @csrf
                    @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $barang,
                        '_item' => 'nama',
                        'isArray' => '',
                    ])
                    @include('components.input', [
                        'label' => 'Duz',
                        'name' => 'duz',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Botol',
                        'name' => 'btl',
                        'type' => 'number',
                    ])
                    {{-- @include('components.select', [
                        'label' => 'Penyetok',
                        'name' => 'penyetok',
                        '_data' => $item,
                        '_item' => 'penyetok',
                        'isArray' => 'Yes',
                    ]) --}}
                    @include('components.input', [
                        'name' => 'kategori',
                        'type' => 'hidden',
                        'value' => '2',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
