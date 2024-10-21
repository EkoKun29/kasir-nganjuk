<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Pindah Kas Cash</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pindah-kas-cash.store') }}" method="post">
                    @csrf
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'tanggal',
                        'type' => 'date',
                    ])
                    @include('components.input', [
                        'label' => 'Sales',
                        'name' => 'sales',
                        'value' => 'TOKO NGANJUK',
                        'attr' => 'readonly="true"',
                    ])
                    @include('components.input', [
                        'label' => 'Nomor Nota',
                        'name' => 'no_nota',
                    ])
                    @include('components.input', [
                        'label' => 'Nominal',
                        'name' => 'nominal',
                        'type' => 'number',
                    ])
                    @include('components.select', [
                        'label' => 'Pindah ke',
                        'name' => 'pindah_ke',
                        '_data' => $data,
                        '_item' => 'kas',
                        'isArray' => 'Yes',
                    ])
                    @include('components.input', [
                        'label' => 'Keterangan',
                        'name' => 'keterangan',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
