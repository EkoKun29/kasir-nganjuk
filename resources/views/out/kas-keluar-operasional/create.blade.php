<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Kas Keluar Operasional</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('kas-keluar-operasional.store') }}" method="post">
                    @csrf
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'tanggal',
                        'type' => 'date',
                    ])
                    @include('components.select', [
                        'label' => 'Keperluan',
                        'name' => 'keperluan',
                        '_data' => $data,
                        '_item' => 'type',
                        'isArray' => 'No',
                    ])
                    @include('components.input', [
                        'label' => 'Keterangan',
                        'name' => 'keterangan',
                    ])
                    @include('components.input', [
                        'label' => 'Nomor Nota',
                        'name' => 'no_nota',
                        'type' => 'number',
                    ])
                    @include('components.input', [
                        'label' => 'Nominal',
                        'name' => 'nominal',
                        'type' => 'number',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
