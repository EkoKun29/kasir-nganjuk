<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Nominal Awal</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('nominal-awal.store') }}" method="post">
                    @csrf
                    @include('components.input', [
                        'label' => 'Kas',
                        'name' => 'kas',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Saldo Bank',
                        'name' => 'saldo_bank',
                        'type' => 'number',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
