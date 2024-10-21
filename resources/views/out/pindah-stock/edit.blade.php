<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editForm">
                    @csrf
                    <div class="row">
                        <div class="col">
                            @include('components.input', [
                                'label' => 'Sales',
                                'name' => 'atas_nama_sales',
                                'value' => 'TOKO NGANJUK',
                                'attr' => 'readonly="true"',
                            ])
                        </div>
                        <div class="col">
                            @include('components.input', [
                                'label' => 'Dibawa Oleh',
                                'name' => 'yang_bawa_barang',
                                'value' => 'TOKO NGANJUK',
                                'attr' => 'readonly="true"',
                            ])
                        </div>
                    </div>
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'created_at',
                        'type' => 'date',
                    ])
                    @include('components.input', [
                        'label' => 'Nomor',
                        'name' => 'nmr',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Barang ke',
                        'name' => 'barang_ke',
                    ])
                    @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $data,
                        '_item' => 'nama',
                        'isArray' => '',
                        'ddp' => '#editModal',
                    ])
                    @include('components.input', [
                        'label' => 'Quantity',
                        'name' => 'qty',
                        'type' => 'number',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
