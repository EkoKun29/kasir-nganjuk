<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="editForm">
                    @csrf
                    @include('components.input', [
                        'label' => 'Nomor Nota',
                        'name' => 'no_nota',
                        'type' => 'text',
                    ])
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'created_at',
                        'type' => 'date',
                    ])
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
                    <div class="mb-3">
                        <label for="Input" class="form-label">Nama Supplier</label>
                        <input list="nama_supliers" name="nama_suplier" id="nama_suplier"
                            class="form-control" placeholder="Nama Supplier" value="{{ isset($suppliers[0]->supplier) ? $suppliers[0]->supplier : '' }}" required>
                        <datalist id="nama_supliers">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->supplier }}"></option>
                            @endforeach
                        </datalist>
                    </div>
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
                      @include('components.input', [
                        'label' => 'Harga (Satuan/Ecer/PCS)',
                        'name' => 'harga',
                        'type' => 'number',
                    ])
                    {{-- @include('components.input', [
                        'label' => 'Tunai',
                        'name' => 'tunai',
                        'type' => 'number',
                        'value' => 0,
                    ]) --}}
                    {{-- @include('components.input', [
                        'label' => 'Hutang',
                        'name' => 'hutang',
                        'type' => 'number',
                        'value' => 0,
                    ]) --}}
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
