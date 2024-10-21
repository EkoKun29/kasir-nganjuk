<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Stock Awal</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('ambil-uang-ttb.store') }}" method="post">
                    @csrf
                    {{-- @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $barang,
                        '_item' => 'nama',
                        'isArray' => '',
                    ]) --}}
                    @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'tanggal',
                        'type' => 'date',
                    ])
                    @include('components.select', [
                        'label' => 'Dari Bank',
                        'name' => 'dari_bank',
                        '_data' => $bank,
                        '_item' => 'bank',
                        'isArray' => 'Yes',
                    ])
                    @include('components.input', [
                        'label' => 'Nominal',
                        'type' => 'number',
                        'name' => 'nominal',
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
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
