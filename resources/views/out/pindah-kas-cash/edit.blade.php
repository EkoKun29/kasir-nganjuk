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
                        'ddp' => '#editModal',
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
