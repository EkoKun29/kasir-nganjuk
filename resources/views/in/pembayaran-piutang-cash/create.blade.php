<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Pembayaran Piutang</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembayaran-piutang-cash.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            @include('components.input', [
                                'label' => 'Toko',
                                'name' => 'toko',
                                'value' => 'TOKO NGANJUK',
                                'attr' => 'readonly="true"',
                            ])
                        </div>
                        <div class="col">
                            <label class="col-form-label">Konsumen</label>
                            <select id="select-konsumen" name="nama_konsumen" placeholder="Nama Konsumen"
                            autocomplete="off" required>
                            <option value="" selected>Nama Konsumen</option>
                            @foreach ($konsumens as $konsumen)
                                <option value="{{ $konsumen->nama  }}">{{ $konsumen->nama  }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            
                            @include('components.input', [
                                'label' => 'No. Nota',
                                'name' => 'no_nota_piutang',
                                'type' => 'text',
                                'attr' => 'min="0"',
                            ])
                        </div>
                        <div class="col">
                            @include('components.input', [
                                'label' => 'Tanggal Nota',
                                'name' => 'tgl_nota_piutang',
                                'type' => 'date',
                            ])
                        </div>
                    </div>
                    @include('components.input', [
                        'label' => 'Tanggal Bayar',
                        'name' => 'tgl_bayar',
                        'type' => 'date',

                    ])
                    @include('components.select', [
                        'label' => 'Bank',
                        'name' => 'bank',
                        '_data' => $bank,
                        '_item' => 'bank',
                        'isArray' => 'Yes',
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
                    @include('components.select', [
                        'label' => 'Keterangan',
                        'name' => 'keterangan',
                        '_data' => $ket,
                        '_item' => 'keterangan',
                        'isArray' => 'Yes',
                    ])

                    <small class="form-text text-muted">
                        👉 Jika pembayaran <b>barter</b>, maka nominal taruh di <b>Cash</b> dan pilih keterangan <b>Barter</b>.<br>
                        👉 Jika selain barter, keterangan <b>tidak perlu diisi</b>.
                    </small>
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
