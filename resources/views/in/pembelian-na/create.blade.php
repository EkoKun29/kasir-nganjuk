<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Pembelian Hutang</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembelian-na.store') }}" method="post">
                    @csrf
                    @include('components.input', [
                        'label' => 'Nomor Nota',
                        'name' => 'no_nota',
                        'type' => 'text',
                    ])
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'tanggal',
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
                        <select id="select-supplier" name="nama_suplier" placeholder="Nama Supplier" autocomplete="off"
                            required>
                            <option selected value="">Pilih Nama Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->supplier }}">{{ $supplier->supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Nama Barang</label>
                        <select id="select-barang" name="nama_barang" placeholder="Nama Barang"
                        autocomplete="off" required>
                        <option value="" selected>Nama Barang</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    </div>
                     @include('components.input', [
                        'label' => 'Harga (Satuan/Ecer/PCS)',
                        'name' => 'harga',
                        'type' => 'number',
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
