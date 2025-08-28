<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Form Pembelian Ke KANTOR ALIANSYAH</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('pembelian-tele.store') }}" method="post">
                    @csrf
                    {{-- @include('components.input', [
                        'label' => 'No Nota',
                        'name' => 'no_nota',
                        'type' => 'text',
                    ]) --}}
                    <label for="Input" class="form-label">No Nota</label>
                    <select name="no_nota" id="select5" data-dropdown-parent="{{ $ddp ?? '#createModal' }}" >
                        <option selected disabled>Surat Gudang</option>
                        @foreach($surat as $h)
                            <option value="{{$h->nomor_surat}}">{{$h->nomor_surat}}</option>
                        @endforeach
                    </select>

                    {{-- @include('components.input', [
                        'label' => 'Tanggal',
                        'name' => 'tanggal',
                        'type' => 'date',
                    ]) --}}
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
                    @include('components.input', [
                        'label' => 'Nama Supplier',
                        'name' => 'nama_suplier',
                        'value' => 'KANTOR ALIANSYAH',
                        'attr' => 'readonly="true"',
                    ])
                    @include('components.select', [
                        'label' => 'Nama Barang',
                        'name' => 'nama_barang',
                        '_data' => $data,
                        '_item' => 'nama',
                        'isArray' => '',
                    ])
                    {{-- <label class="col-form-label">Metode Pembayaran</label>
                    <select id="select2" class="form-control" name="pembayaran">
                        <option selected disabled>Pilih Pembayaran</option>
                            <option value="CASH">CASH</option>
                            <option value="HUTANG">HUTANG</option>
                    </select> --}}
                    <label class="col-form-label">Metode Pembayaran</label>
                    <input type="text" class="form-control" name="pembayaran" value="HUTANG" readonly="true">
                    <br>
                    {{-- @include('components.input', [
                        'label' => 'Harga (Satuan/Ecer/PCS)',
                        'name' => 'harga',
                        'type' => 'number',
                    ]) --}}
                    <label for="Input" class="form-label" >HPP</label>
                    <select  name="harga" id="select4" data-dropdown-parent="{{ $ddp ?? '#createModal' }}" id="selectInput">
                        <option selected>Barang + Hpp</option>
                        @foreach($hpp as $h)
                            <option value="{{$h->harga}}">{{$h->kode}}</option>
                        @endforeach
                    </select>
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
