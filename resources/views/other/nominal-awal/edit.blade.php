<div class="modal fade" id="editModal-{{ $item->id }}" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('nominal-awal.update', $item) }}" method="post">
                    @csrf
                    @method('put')
                    @include('components.input', [
                        'label' => 'Kas',
                        'name' => 'kas',
                        'type' => 'number',
                        'value' => $item->kas,
                    ])
                    @include('components.input', [
                        'label' => 'Saldo Bank',
                        'name' => 'saldo_bank',
                        'type' => 'number',
                        'value' => $item->saldo_bank,
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
