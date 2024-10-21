<div class="modal fade" id="editModal-{{ $item->id }}" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('ambil-uang-ttb.update', $item) }}" method="post">
                    @csrf
                    @method('put')
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'tanggal',
                        'type' => 'date',
                        'value' => $item->tanggal,
                    ])
                    @include('components.select', [
                        'label' => 'Dari Bank',
                        'name' => 'dari_bank',
                        '_data' => $bank,
                        '_item' => 'bank',
                        'isArray' => 'Yes',
                        'selected' => $item->dari_bank,
                    ])
                    @include('components.input', [
                        'label' => 'Nominal',
                        'name' => 'nominal',
                        'type' => 'number',
                        'value' => $item->nominal,
                    ])
                    @include('components.input', [
                        'label' => 'Ke Akun',
                        'name' => 'ke_akun',
                        'value' => 'TTB',
                        'attr' => 'readonly',
                    ])
                    @include('components.input', [
                        'label' => 'Keterangan',
                        'name' => 'keterangan',
                        'value' => $item->keterangan,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
