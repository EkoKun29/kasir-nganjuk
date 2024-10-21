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
                                'label' => 'Tanggal Pembayaran',
                                'name' => 'tgl_bayar',
                                'type' => 'date',
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('components.input', [
                                'label' => 'Toko',
                                'name' => 'toko',
                                'value' => 'TOKO WINONG',
                                'attr' => 'readonly="true"',
                            ])
                        </div>
                        <div class="col">
                            <label class="col-form-label">Konsumen</label>
                            <input list="nama_konsumenS" name="nama_konsumen" id="nama_konsumen" class="form-control"
                                placeholder="Nama Konsumen" required>
                            <datalist id="nama_konsumenS">
                                @foreach ($konsumens as $konsumen)
                                    <option value="{{ $konsumen->nama }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            @include('components.input', [
                                'label' => 'No Nota Piutang',
                                'name' => 'no_nota_piutang',
                                'type' => 'text',
                                'attr' => 'min="0"',
                            ])
                        </div>
                        <div class="col">
                            @include('components.input', [
                                'label' => 'Tanggal Nota Piutang',
                                'name' => 'tgl_nota_piutang',
                                'type' => 'date',
                            ])
                        </div>
                    </div>
                    @include('components.select', [
                        'label' => 'Bank',
                        'name' => 'bank',
                        '_data' => $bank,
                        '_item' => 'bank',
                        'isArray' => 'Yes',
                    ])
                    @include('components.input', [
                        'label' => 'Sisa Piutang',
                        'name' => 'sisa_piutang',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Tunai',
                        'name' => 'tunai',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Transfer',
                        'name' => 'tf',
                        'type' => 'number',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
